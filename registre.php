<?php

require_once('./inc/header.php');
require_once ('./functions.php');

$db = db_connect();

session_start();

/* Vérifie et récupère les données de la table utilisateur de l'utilisateur pour l'inscrire */
if (isset($_POST['user_nickname']) & isset($_POST['user_password'])){

    try {

        $user_nickname = $_POST['user_nickname'];
        $user_password = $_POST['user_password'];

        $sth = $db->prepare("INSERT INTO `users`(`user_nickname`, `user_password`) VALUES (:user_nickname, :user_password)");

        $sth->bindParam(':user_nickname', $user_nickname);
        $sth->bindParam(':user_password', $user_password);

        $sth->execute();

        header('location: login.php');

    }
    
    catch (PDOException $e){
    
        print "Erreur !: " . $e->getMessage() . "<br/>";
    }
}

else {
    
    echo "";
}

?>

<!-- Formulaire d'inscription de l'utilisateur -->
<div class="container col-lg-12 spacer"></div>
<div class="container col-lg-12 block">
    <form action="" method ="POST" class="form-horizontal">
        <div class="row col-xs-6 block2 bg--primary center">
            <div class="form-group" >
                <label class="control-label col-sm-3"  for="user_nickname"><a>user_nickname</a></label>
                <div class="col-sm-8 col-xs-12">
                    <input type="text" placeholder="Entrer un surnom" name="user_nickname" required="true" class="form-control"></input></br>
                </div>
            </div> 

            <div class="form-group" >
                <label class="control-label col-sm-3"  for="user_password"><a>user_password</a></label>
                <div class="col-sm-8 col-xs-12">
                    <input type="password" placeholder="Entrer un mot de passe" name="user_password" required="true" class="form-control"></input></br>
                </div>
            </div> 
            
            <div class="form-group"> 
                <div class="col-sm-offset-2 col-sm-8"> 
                <button class="btn btn-light" type="submit">Inscription</button>
                <button class="btn btn-light" type="reset">Annuler</button>
            </div>
        </div>
    </form>    
</div>
</div>

<?php

require_once('./inc/footer.php');

?>
