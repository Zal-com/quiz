<section>
    <?php foreach ($quizList as $quiz) { ?>
        <div id="<?= 'quiz' . $quiz['id'] ?>" class="quiz" onclick="window.location.href='?action=quiz&id=<?= $quiz['id'] ?>'" style="cursor: pointer">
            <h3><?= $quiz['titre'] ?></h3>
            <p><?= $quiz['description'] ?></p>
            <img src="<?= $quiz['illustration'] ?>" width="200px">
            <ul>
              <?php foreach ($questions as $question){
                  if($question['quiz_id'] === $quiz['id']){ ?>
                  <li><?= $question['titre'] ?></li>
             <?php }
              } ?>
            </ul>
            <p>Ajouté le <?= substr($quiz['dateDebutPublication'], 0, 10) ?></p>
            <?php if(isset($_SESSION['auth'])){
                //Afficher les étoiles
                //TODO
                echo 'Evaluation';
            } ?>
        </div>
    <?php } ?>
</section>
