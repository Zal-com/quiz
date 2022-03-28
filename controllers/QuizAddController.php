<?php

class QuizAddController{
    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }

    public function run(){

        if($_SESSION['type'] != 2){
            header('Location : index.php?action=accueil');
        }
        //TODO


        require_once(CHEMIN_VUES . 'quizAdd.php');
    }

}
