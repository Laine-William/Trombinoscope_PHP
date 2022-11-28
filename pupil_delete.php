<?php

require_once('./inc/header.php');
require_once ('./functions.php');

$db = db_connect();

session_start();

/* Vérifie et récupère la donnée de la table des eleves pour la supprimer */
if (isset($_POST['pupil_id'])){

    try {

        $pupil_id = $_POST['pupil_id'];

        $sth = $db->prepare("DELETE FROM `pupils` WHERE `pupil_id`=:pupil_id");

        $sth->bindParam(':pupil_id', $pupil_id);

        $sth->execute();

        header('location: home.php');

    }
    
    catch (PDOException $e){
    
        print "Erreur !: " . $e->getMessage() . "<br/>";
    }
} else {

    echo "";
}

?>

<!-- Formulaire de suppression pour les dépenses -->
<div class="container col-lg-12 block">
    <form action="" method ="POST" class="form-horizontal">
        <div class="row col-xs-6 block2 bg--primary center">
            <div class="form-group" >
                <label class="control-label col-sm-3" for="pupil_id"><a>pupil_id</a></label>
                <div class="col-sm-8 col-xs-12">
                        <input type="number" placeholder="Numéro de l'eleve à supprimer" name="pupil_id" required="true" class="form-control"></input></br>
                </div>
            </div>  
   
            <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-8"> 
                <button class="btn btn-light" type="submit">Suppression</button>
                <button class="btn btn-light" type="reset">Annuler</button>
            </div>
            <div class="container col-lg-12 spacer"></div>
        </div>
    </form>
</div>
</div>

<?php

require_once('./inc/footer.php');

?>