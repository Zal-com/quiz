<?php
class LogOffController
{
    private $_db;

    public function __construct($db){
        $this->_db =$db;
    }

    public function run()
    {


        if (!isset($_SESSION['auth'])) {
            header('Location: index.php?action=accueil');
        }

        session_destroy();
        header('Location: index.php?action=accueil');

    } //End of run

} //End of Class
?>
