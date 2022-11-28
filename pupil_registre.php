<?php

require_once('./inc/header.php');
require_once ('./functions.php');

$db = db_connect();

session_start();

/* Vérifie et modifie les données de la table eleve */
if (isset($_POST['pupil_first_name']) & isset($_POST['pupil_last_name']) & isset($_POST['pupil_age']) & isset($_FILES['pupil_image']) & isset($_POST['class_cat_id']) & isset($_POST['class_id']) & isset($_POST['user_id'])){
    
    try {

        $pupil_first_name = $_POST['pupil_first_name'];
        $pupil_last_name = $_POST['pupil_last_name'];

        $pupil_image = $_FILES['pupil_image'];
        
        $pupil_age = $_POST['pupil_age'];
        $class_cat_id = $_POST['class_cat_id'];
        $class_id = $_POST['class_id'];
        $user_id = $_POST['user_id'];

        $target_image = './upload_image/' . $pupil_image;

        move_uploaded_file($_FILES['pupil_image']['tmp_name'], $target_image);
       
        $sth = $db->prepare("INSERT INTO `pupils` (`pupil_first_name`, `pupil_last_name`, `pupil_age`, `pupil_image`, `class_cat_id`, `class_id`, `user_id`) VALUES (:pupil_first_name, :pupil_last_name, :pupil_age, :class_cat_id, :class_id, :user)");
        
        $sth->bindParam(':pupil_first_name', $pupil_first_name);
        $sth->bindParam(':pupil_last_name', $pupil_last_name);
        $sth->bindParam(':pupil_age', $pupil_age);
        $sth->bindParam(':pupil_image', $pupil_image);
        $sth->bindParam(':class_cat_id', $class_cat_id);
        $sth->bindParam(':class_id', $class_id);
        $sth->bindParam(':user', $user_id);
        
        $sth->execute();
       
        header('location: pupil.php');

    }
    
    catch (PDOException $e){
        
        print "Erreur !: " . $e->getMessage() . "<br/>";
    }
} else {

    echo "";
}

$users = get_classes_categories ();
?>

<!-- Formulaire d'insertion pour l'eleve -->
<div class="container col-lg-12 block">
    <form action="" method ="POST" class="form-horizontal">
        <div class="row col-xs-6 block2 bg--primary center">

            <div class="form-group" >
                <label class="control-label col-sm-3" for="user_id"><a>user_id</a></label>
                <div class="col-sm-8 col-xs-12">
                    <input type="number" placeholder="Entrer le numero de l'utilisateur" name="user_id" required="true" class="form-control"></input></br>
                </div>
            </div>   

            <div class="form-group" >
                <label class="control-label col-sm-3" for="pupil_first_name"><a>pupil_first_name</a></label>
                <div class="col-sm-8 col-xs-12">
                    <input type="text" placeholder="Entrer le prenom de l'eleve" name="pupil_first_name" required="true" class="form-control"></input></br>
                </div>
            </div> 

            <div class="form-group" >
                <label class="control-label col-sm-3" for="pupil_last_name"><a>pupil_last_name</a></label>
                <div class="col-sm-8 col-xs-12">
                    <input type="text" placeholder="Entrer le nom de l'eleve" name="pupil_last_name" required="true" class="form-control"></input></br>
                </div>
            </div> 

            <div class="form-group" >
                <label class="control-label col-sm-3" for="pupil_age"><a>pupil_age</a></label>
                <div class="col-sm-8 col-xs-12">
                    <input type="number" placeholder="Entrer un age" name="pupil_age" required="true" class="form-control"></input></br>
                </div>
            </div> 

            <div class="form-group" >
                <label class="control-label col-sm-3" for="pupil_image"><a>pupil_image</a></label>
                <div class="col-sm-8 col-xs-12">
                    <input type="file" placeholder="Choisissez une image" name="pupil_image" required="true" class="form-control"></input></br>
                </div>
            </div>

            <div class="form-group" >
                <label class="control-label col-sm-3" for="class_cat_id"><a>class_cat_id</a></label>
                <div class="col-sm-8 col-xs-12">
                    <select name="class_cat_id" required="true" class="form-control">
                        <option value="class_cat_id">Entrer la categorie de la classe</option>
                        
                        <?php foreach ($users as $user) : ?>

                            <option value="<?php echo $user['class_cat_id']; ?>">
                            <?php echo $user['class_cat_name']; ?>
                        </option>

                        <?php endforeach; ?>
                    </select>
                </br>
                </div>
            </div> 

            <div class="form-group" >
                <label class="control-label col-sm-3" for="class_id"><a>class_id</a></label>
                <div class="col-sm-8 col-xs-12">
                    <input type="number" placeholder="Entrer le numero de la classe" name="class_id" required="true" class="form-control"></input></br>
                </div>
            </div>
            
            <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-8"> 
                <button class="btn btn-light" type="submit">Inscription</button>
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