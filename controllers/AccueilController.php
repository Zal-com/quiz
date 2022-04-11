<?php
class AccueilController{
    private $_db;

    public function __construct($db)
    {
        $this->_db = $db;
    }

    public function run(){
        $quizList = $this->_db->quizList();
        $questions = $this->_db->getQuestions();

        require_once(CHEMIN_VUES . 'accueil.php');

    } // End of run()

} //End of class
