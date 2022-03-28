<?php
class Db
{

    private static $instance = null;
    private $_db;

    private function __construct()
    {
        try {
            $this->_db = new PDO('mysql:host=' . DBHOST . ';dbname=' . DBNAME, DBLOGIN, DBPASS);
        } catch (PDOException $e) {
            die('Erreur de connexion à la base de données : ' . $e->getMessage());
        }
    }

    # Pattern Singleton
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new Db();
        }
        return self::$instance;
    }

    public function login($user, $pwd)
    {
        $query = 'SELECT password FROM user WHERE username = ?';
        $ps = $this->_db->prepare($query);
        $ps->execute(array($user));

        $pass = $ps->fetch()[0];
        if(password_verify($pwd, $pass)){
            return 1;
        }
        else return 0;
    }

    public function insert_user($username, $email, $pwd, $sexe){
        $hash_pwd = password_hash($pwd, CRYPT_BLOWFISH);
        $query = "INSERT INTO `user` (`username`, `password`, `type`, `activated`) values(?, ?, 1, 1)";
        $ps = $this->_db->prepare($query);

        if($ps->execute(array($username, $hash_pwd))){

            //fetch freshly created user's ID
            $id = $this->getId($username);
            //insert in user_meta table
            $query = "INSERT INTO `user_meta` (`id`, `email`, `sexe`, `dateInscription`) values(?,?,?, DATE(NOW()))";
            $ps = $this->_db->prepare($query);

            if($ps->execute(array($id, $email, $sexe))){
                return 1;
            }
            return 0;
        }
        return 0;
    }

    public function getId($username){
        $query = $this->_db->prepare('SELECT id FROM user WHERE username = ?');
        $query->execute(array($username));

        return $query->fetch()[0];
    }

    public function fetchInfos($user){
        $id = $this->getId($user);
        $query = 'SELECT * FROM user WHERE id = ?';
        $ps = $this->_db->prepare($query);
        $ps->execute(array($id));

       return $tabInfos = $ps->fetch(PDO::FETCH_ASSOC);
    }

} //End of class

/*
    public function display_users() {
        # Solution d'INSERT avec prepared statement
        $query = 'SELECT id_member, username, email, is_admin, activate FROM members';
        $ps = $this->_db->prepare($query);
        $ps->execute();

        $tab_users = $ps->fetchAll(PDO::FETCH_OBJ);

        return $tab_users;
    }
*/
?>