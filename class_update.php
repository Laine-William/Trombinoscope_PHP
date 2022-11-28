<?php

require_once('./inc/header.php');
require_once ('./functions.php');

$db = db_connect();

session_start();

/* Vérifie et modifie les données de la table classe */
if (isset($_POST['class_id']) & isset($_POST['class_name']) & isset($_POST['class_localisation']) & isset($_FILES['class_image']) & isset($_POST['class_year']) & isset($_POST['class_number_pupils']) & isset($_POST['class_cat_id']) & isset($_POST['user_id'])){
    
    try {

        $class_id = $_POST['class_id'];
        $class_name = $_POST['class_name'];
        $class_localisation = $_POST['class_localisation'];

        $class_image = $_FILES['class_image']['name'];
        
        $class_year = $_POST['class_year'];
        $class_number_pupils = $_POST['class_number_pupils'];
        $class_cat_id = $_POST['class_cat_id'];
        $user_id = $_POST['user_id'];

        $target_image = './upload_image/' . $class_image;

        move_uploaded_file($_FILES['class_image']['tmp_name'], $target_image);
       
        $sth = $db->prepare("UPDATE `classes` SET `class_name`=:class_name, `class_localisation`=:class_localisation, `class_image`=:class_image, `class_year`=:class_year, `class_number_pupils`=:class_number_pupils, `class_cat_id`=:class_cat_id, `user_id`=:user WHERE `class_id`=:class_id");
        
        $sth->bindParam(':class_id', $class_id);
        $sth->bindParam(':class_name', $class_name);
        $sth->bindParam(':class_localisation', $class_localisation);
        $sth->bindParam(':class_image', $class_image);
        $sth->bindParam(':class_year', $class_year);
        $sth->bindParam(':class_number_pupils', $class_number_pupils);
        $sth->bindParam(':class_cat_id', $class_cat_id);
        $sth->bindParam(':user', $user_id);
        
        $sth->execute();
       
        header('location: class.php');

    }
    
    catch (PDOException $e){
        
        print "Erreur !: " . $e->getMessage() . "<br/>";
    }
} else {

    echo "";
}

$users = get_classes_categories ();
?>

<!-- Formulaire d'insertion pour la classe -->
<div class="container col-lg-12 block">
    <form action="" method ="POST" class="form-horizontal">
        <div class="row col-xs-6 block2 bg--primary center">
            <div class="form-group" >
                <label class="control-label col-sm-3" for="class_id"><a>class_id</a></label>
                <div class="col-sm-8 col-xs-12">
                    <input type="number" placeholder="Modifier le numero de la classe" name="class_id" required="true" class="form-control"></input></br>
                </div>
            </div> 

            <div class="form-group" >
                <label class="control-label col-sm-3" for="user_id"><a>user_id</a></label>
                <div class="col-sm-8 col-xs-12">
                    <input type="number" placeholder="Modifier le numero de l'utilisateur" name="user_id" required="true" class="form-control"></input></br>
                </div>
            </div>   

            <div class="form-group" >
                <label class="control-label col-sm-3" for="class_name"><a>class_name</a></label>
                <div class="col-sm-8 col-xs-12">
                    <input type="text" placeholder="Modifier le nom de l'etablissement" name="class_name" required="true" class="form-control"></input></br>
                </div>
            </div> 

            <div class="form-group" >
                <label class="control-label col-sm-3" for="class_localisation"><a>class_localisation</a></label>
                <div class="col-sm-8 col-xs-12">
                    <input type="text" placeholder="Modifier la localisation de l'etablissement" name="class_localisation" required="true" class="form-control"></input></br>
                </div>
            </div> 

            <div class="form-group" >
                <label class="control-label col-sm-3" for="class_image"><a>class_image</a></label>
                <div class="col-sm-8 col-xs-12">
                    <input type="file" placeholder="Choissisez une autre image" name="class_image" required="true" class="form-control"></input></br>
                </div>
            </div> 

            <div class="form-group" >
                <label class="control-label col-sm-3" for="class_localisation"><a>class_year</a></label>
                <div class="col-sm-8 col-xs-12">
                    <input type="date" placeholder="Selectionner une date" name="class_year" required="true" class="form-control"></input></br>
                </div>
            </div>

            <div class="form-group" >
                <label class="control-label col-sm-3" for="class_number_pupils"><a>class_number_pupils</a></label>
                <div class="col-sm-8 col-xs-12">
                    <input type="number" placeholder="Modifier le nombre d'eleve" name="class_number_pupils" required="true" class="form-control"></input></br>
                </div>
            </div>

            <div class="form-group" >
                <label class="control-label col-sm-3" for="class_cat_id"><a>class_cat_id</a></label>
                <div class="col-sm-8 col-xs-12">
                    <select name="class_cat_id" required="true" class="form-control">
                        <option value="class_cat_id">Modifier la categorie de la classe</option>
                        
                        <?php foreach ($users as $user) : ?>

                            <option value="<?php echo $user['class_cat_id']; ?>">
                            <?php echo $user['class_cat_name']; ?>
                        </option>

                        <?php endforeach; ?>
                    </select>
                </br>
                </div>
            </div> 
            
            <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-8"> 
                <button class="btn btn-light" type="submit">Modification</button>
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