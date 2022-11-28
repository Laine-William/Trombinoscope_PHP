<?php

require_once ('./functions.php');

$users = get_users();

require_once('./inc/header.php');

?>

<main role="main" class="container mt-3 site-content" id="home">
    <nav>
        <ul>

        <?php foreach ($users as $user) : ?>

            <li>
                <a href="pupil.php?user_id=<?= $user['user_id'] ?>">
                    <span>Voir l'eleve</span>   
                </a>
            </li>
  
            <li>
                <a href="class.php?user_id=<?= $user['user_id'] ?>">
                    <span>Voir la classe</span>                    
                </a>
            </li>

            <?php endforeach; ?>

        </ul>
    </nav>
</main>

<?php

require_once('./inc/footer.php');

?>