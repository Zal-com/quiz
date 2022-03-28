<?php
/*
// list of quiz
require '../controllers/quizList.inc.php';

// functions
require '../controllers/quiz.func.php';

    if (isset($_GET['titre'])) {
        $quizToDisplay = $_GET['titre'];
    } elseif (isset($_GET['filtre'])) {
        $filtre = $_GET['filtre'];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
</head>
<body>
    <header style="max-width: max-content">
        <img src="./images/quiz-logo.png" alt="logo">
        <a href="index.php"><h1>Titre du site</h1></a>
    </header>
    <div>
        <a href="admin.php">Administration</a>
    </div>
    <hr>
    <div>
        <form action="#" method="get">
            <label>
                Filtre :
                <input name="filtre" type="text" placeholder="<?= $filtre ?? 'Recherche' ?>">
            </label>
        </form>
        <a href="index.php" style="color: darkmagenta">Effacer filtre</a>
    </div>
    <hr>
    <div id="quiz-display" style="max-width: 500px; margin: auto">
    <?php
            $cpt = 0;
            foreach ($list as $quiz) {
                $titre = $quiz['Titre'];

                if(isset($quizToDisplay)) {

                    if ($quiz['Titre'] == $quizToDisplay) {
                        quizDisplayer($quiz['Titre'], $quiz['Illustration'], $quiz['Auteur'], $quiz['Questions']);
                    }
                } else {
                    if (isset($filtre)) {
                        if (str_contains($titre, $filtre) || str_contains(strtolower($titre), $filtre)) {
                            quizDisplayer($quiz['Titre'], $quiz['Illustration'], $quiz['Auteur'], $quiz['Questions']);
                            $cpt++;
                        }
                    } elseif (!isset($filtre)) {
                        quizDisplayer($quiz['Titre'], $quiz['Illustration'], $quiz['Auteur'], $quiz['Questions']);
                    }
                }
            }

            if (isset($filtre) && $cpt == 0) { ?>
                <h3>Pas de résultat !</h3>
            <?php } ?>
    </div>
    <footer>
        MON FOOTER, PAS LE TIEN &copy;
        <a href="#">Conditions d'utilisation</a>
    </footer>
</body>
</html>
*/
# Prise du temps actuel au début du script
session_start();
$time_start = microtime(true);

# Variables globales du site
define('CHEMIN_MODELS','models/');
define('CHEMIN_VUES','views/');
define('CHEMIN_CONTROLEURS','controllers/');
define('EMAIL','guillaume.stordeur@student.epfc.eu');
define('DBHOST', 'localhost');
define('DBNAME','quiz');
define('DBLOGIN', 'root');
define('DBPASS', '');
$date = date("j/m/Y");

# Require des classes automatisé
function chargerClasse($classe) {
    require 'models/' . $classe . '.class.php';
}

# Connexion a la database
require_once (CHEMIN_MODELS . 'Db.php');
$db = Db::getInstance();

spl_autoload_register('chargerClasse');

# Ecrire ici le header de toutes pages HTML
require_once(CHEMIN_VUES . 'header.php');

# Tester si une variable GET 'action' est précisée dans l'URL index.php?action=...
$action = (isset($_GET['action'])) ? htmlentities($_GET['action']) : 'default';
# Quelle action est demandée ?
switch($action) {
    case 'login':
        require_once('controllers/LoginController.php');
        $controller = new LoginController($db);
        break;
    case 'admin':
        require_once('controllers/AdminController.php');
        $controller = new AdminController($db);
        break;
    case 'sign_in':
        require_once('controllers/SigninController.php');
        $controller = new SigninController($db);
        break;
    case 'log_off':
        require_once('controllers/LogOffController.php');
        $controller = new LogOffController($db);
        break;
    case 'quizzAdd':
        require_once('controllers/QuizAddController.php');
        $controller = new QuizAddController($db);
        break;
    default: # Par défaut, le contrôleur de l'accueil est sélectionné
        require_once('controllers/AccueilController.php');
        $controller = new AccueilController($db);
        break;
}
# Exécution du contrôleur correspondant à l'action demandée
$controller->run();

$time_end = microtime(true);
$time = number_format(($time_end - $time_start)*1000,6);
# Ecrire ici le footer du site de toutes pages HTML
require_once(CHEMIN_VUES . 'footer.php');

?>
