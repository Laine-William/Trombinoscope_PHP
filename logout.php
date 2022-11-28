<?php

/* Déconnexion de l'utilisateur */
session_start();

session_unset ();

session_destroy();

header('Location: registre.php');

?>