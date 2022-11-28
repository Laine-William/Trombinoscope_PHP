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

<!-- Tableau pour les eleves affichés avec une boucle forEach -->
<main class="site-content mt-3 container">
    <section>
        <h1 class="text-center">Information sur l'eleve <?= $users[0]['user']; ?></h1>
            <tbody>

                <?php foreach ($users as $user) : ?>
                
                    <ul class="list-group mb-3" text-center style="width: 30rem;">
                        <li class="list-group-item">Image de l'eleve : <img src="upload_image/<?= $user['pupil_image'] ?>" width="80" alt="Card image"/></li>
                        <li class="list-group-item">Identifiant de l'eleve : <?= $user['pupil_id'] ?></li>
                        <li class="list-group-item">Prenom de l'eleve : <?= $user['pupil_first_name'] ?></li>
                        <li class="list-group-item">Nom de l'eleve : <?= $user['pupil_last_name'] ?></li>
                        <li class="list-group-item">Age de l'eleve : <?= $user['pupil_age'] ?></li>
                        <li class="list-group-item">Identifiant de la classe : <?= $user['class_id'] ?></li>
                        <li class="list-group-item">Identifiant de la categorie de la classe : <?= $user['class_cat_id'] ?></li>
                        <li class="list-group-item" align="center"><a class="text-decoration-none" href="home1.php"><button class="btn btn-secondary"> Retour</button></a></li>
                    </ul>
                
                <?php endforeach; ?>
            
            </tbody>
        </table>
    </section>
</main>

<?php

require_once ('./inc/footer.php');

?>