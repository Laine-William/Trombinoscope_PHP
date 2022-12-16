<?php

require_once ('./libraries/db.php');

    if (isset($_POST['submit'])) {

        $db = db_connect ();
        
        $search = mysqli_real_escape_string($db, trim(htmlentities($_POST['search'])));

        if ($db->connect_error) {
            echo "Erreur connexion";
            exit();
        }

        if ($search === "" || !ctype_alnum($search) || $search < 3) {
            echo "Mauvaise recherche";
            exit();
        }

        $search = "%$search%";

        $sql = "SELECT * FROM `classes` WHERE class_name LIKE ?";

        $search_stmt = $db->prepare($sql);
        $search_stmt->bind_param('s', $search);
        $search_stmt->execute();

        $result = $search_stmt->get_result();

        if ($result->num_rows === 0) {

            echo "Aucun resultat";

            exit();

        }
    }
?>