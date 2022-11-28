<?php

require_once ('./functions.php');

/* Vérifie et récupère l'identifiant de l'utilisateur */
if(empty($_GET['user_id'])){

    header('users.php');
    
    exit();
}

$user_id = (int) $_GET['user_id'];

$users = get_pupils($user_id);

require_once ('./inc/header.php');

?>

<!-- Carte pour l'eleve affichés avec une boucle forEach -->
<main class="site-content mt-3 container">
    <section>
    <h1 class="text-center">Ensemble des eleves de la classe</h1>
          <tbody>
                
                <?php foreach ($users as $user) : ?>
                
                <div class="col-sm-6">
                    <div class="card mb-3" text-center style="width: 18rem;">
                        <img class="card-img-top" img src="upload_image/<?= $user['pupil_image'] ?>" width="80" alt="Card image">
                        <div class="card-body">
                            <h5 class="card-title"><?= $user['user'] ?></h5>
                            <a href="pupil_infos.php?user_id=<?= $user['user_id'] ?>" class="btn btn-secondary">Information sur l'eleve</a>
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