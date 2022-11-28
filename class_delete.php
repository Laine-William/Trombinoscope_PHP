<?php

require_once('./inc/header.php');
require_once ('./functions.php');

$db = db_connect();

session_start();

/* Vérifie et récupère la donnée de la table classe pour la supprimer */
if (isset($_POST['class_id'])){

    try {

        $class_id = $_POST['class_id'];
        
        $sth = $db->prepare("DELETE FROM `classes` WHERE `class_id`=:class_id");
        
        $sth->bindParam(':class_id', $class_id);
        
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
<div class="container col-lg-12 spacer"></div>
<div class="container col-lg-12 block">
    <form action="" method ="POST" class="form-horizontal">
        <div class="row col-xs-6 block2 bg-primary center">
            <div class="form-group" >
                <label class="control-label col-sm-3" for="class_id"><a>class_id</a></label>
                <div class="col-sm-8 col-xs-12">
                        <input type="number" placeholder="Numero de classe à supprimer" name="class_id" required="true" class="form-control"></input></br>
                </div>
            </div>  
   
            <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-8"> 
                <button type="submit">Suppression</button>
                <button type="reset">Annuler</button>
            </div>
        </div>
    </form>
</div>
</div>

<?php

require_once('./inc/footer.php');

?>