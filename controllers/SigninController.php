<?php
class SigninController{

    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }

    public function run(){

        if(isset($_SESSION['auth'])){
            header('Location: index.php?action=accueil');
        }

        if(isset($_POST['submit_sign'])){
            $username = $_POST['username'];
            $_SESSION['username'] = $username;
            $email = $_POST['email'];
            $pwd = $_POST['password'];
            $sexe = $_POST['sexe'];
            //TODO verifications champs vides (JS ?)
            $status = $this->_db->insert_user($username, $email, $pwd, $sexe);

            if($status == 1){
                print_r('ALL GOOD');
            }
            else print_r('NOK');
        }

        require_once(CHEMIN_VUES . 'signIn.php');
    }
}

?>