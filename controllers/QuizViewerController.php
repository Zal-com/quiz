<?php

class QuizViewerController{

    private $_db;

    public function __construct($_db)
    {
        $this->_db = $_db;
    }

    public function run(){

        $quiz = $this->_db->getQuiz($_GET['id']);
        print_r($quiz);

        require_once(CHEMIN_VUES . 'quizViewer.php');
    } // End of run
} //End of class
