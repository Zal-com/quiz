<section>
    <form method="post" action="?action=quizzAdd" enctype="multipart/form-data">
        <!--
        titre
        description
        dateCreate -> date de soumission (NOW)
        dateDebutPublication -> date de soumission si activated == 1 SINON date de passage en activated == 1
        dateFinPublication -> date de passade de activated from 1 to 0
        prive
        activated
        illustration
        -->
        <label>
            Titre :
            <input type="text" name="title" placeholder="tapez ici">
        </label>
        <label>
            Description:
            <input type="text" name="desc" placeholder="tapez ici">
        </label>
        <label>
            Nombre de questions :
            <input type="text" name="nbreQuestions" placeholder="ex. 42">
        </label>
        <!-- Possibilité de JS pour ajouter des champs avec les questions -->
        <!--
        <label>
            Privé ?
            <input type="checkbox" name="prive">
        </label>
        -->
        <label>
            Illustration :
            <input type="hidden" accept="image/png" MAX_FILE_SIZE=300000000>
            <input type="file">
        </label>
        <input type="submit" value="Soumettre" name="quiz_submit">
    </form>



</section>
