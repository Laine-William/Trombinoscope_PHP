<?php

require_once ('./functions.php');

/* Vérifie et récupère l'identifiant de l'utilisateur */
if(empty($_GET['user_id'])){

    header('users.php');
    
    exit();
}

$user_id = (int) $_GET['user_id'];

$users = get_classes($user_id);

require_once ('./inc/header.php');

?>

<!-- Carte pour la classe affichés avec une boucle forEach -->
<main class="site-content mt-3 container">
    <section>
    <h1 class="text-center">Ensemble des classes</h1>
          <tbody>
                
                <?php foreach ($users as $user) : ?>
                
                <div class="col-sm-6">
                    <div class="card mb-3" text-center style="width: 18rem;">
                        <img class="card-img-top" img src="upload_image/<?= $user['class_image'] ?>" width="80" alt="Card image">
                        <div class="card-body">
                            <h5 class="card-title"><?= $user['class_name'] ?></h5>
                            <a href="class_infos.php?user_id=<?= $user['user_id'] ?>" class="btn btn-secondary">Information sur la classe</a>
                        </div>
                    </div>
                </div>

                <?php endforeach; ?>
            </tbody>
    </section>
</main>

<?php

require_once ('./inc/footer.php');

?>