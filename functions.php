<?php

require_once ('./libraries/db.php');

/* Utilisateur : requête paramétrée et utilisation de la méthode prépare avec des paramètres nommés */
function get_users() {

    $db = db_connect();

    $sql = <<<EOD
    SELECT
        `user_id`,
        `user_nickname`,
        `user_password`
    FROM
        `users`
    LIMIT 10
    EOD;

    $usersStmt = $db->query($sql);

    $users = $usersStmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $users;
}

/* Classe : requête paramétrée et utilisation de la méthode prépare avec des paramètres nommés */
function get_classes($user_id) {

    $db = db_connect();

    $sql = <<<EOD
    SELECT 
        `class_id`,
        `class_name`,
        `class_localisation`,
        `class_image`,
        `class_number_pupils`,
        `class_year`,
        u.`user_id`,
        cc.`class_cat_id`
    FROM
        `classes` AS c
    INNER JOIN 
        `users` AS u 
    ON
        c.`user_id` = u.`user_id`
    INNER JOIN 
        `classes_categories` AS cc 
    ON 
        c.`class_cat_id` = cc.`class_cat_id`
    WHERE 
        u.`user_id` =:user_id
    ORDER BY 
        `class_name`
    LIMIT 
        10
    EOD;

    $classDetailsStmt = $db->prepare($sql);

    $classDetailsStmt->bindValue(':user_id', $user_id);

    $classDetailsStmt->execute();
    
    $classdetails = $classDetailsStmt->fetchAll(PDO::FETCH_ASSOC);

    return $classdetails;
}

/* Categorie de la classe : requête paramétrée et utilisation de la méthode prépare avec des paramètres nommés */
function get_classes_categories() {

    $db = db_connect();

    $sql = <<<EOD
    SELECT 
        `class_cat_id`,
        `class_cat_name`
    FROM
        `classes_categories`
    LIMIT 20
    EOD;

    $classCategoriesStmt = $db->query($sql);

    $classCategories = $classCategoriesStmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $classCategories;
}

/* Eleve d'une classe : requête paramétrée et utilisation de la méthode prépare avec des paramètres nommés */
function get_pupils($user_id){

    $db = db_connect();

    $sql = <<<EOD
    SELECT
        `pupil_id`,
        `pupil_first_name`,
        `pupil_last_name`,
        `pupil_age`,
        `pupil_image`,
        u.`user_id`,
        c.`class_id`,
        cc.`class_cat_id`,
        CONCAT(`pupil_first_name`, ' ', `pupil_last_name`) AS user
    FROM
        `pupils` AS p
    INNER JOIN 
        `users` AS u 
    ON
        p.`user_id` = u.`user_id`
    INNER JOIN 
        `classes` AS c 
    ON 
        p.`class_id` = c.`class_id`

    INNER JOIN 
        `classes_categories` AS cc 
    ON 
        p.`class_cat_id` = cc.`class_cat_id`
    WHERE
        u.`user_id` = :user_id
    ORDER BY 
        `pupil_last_name`
    LIMIT 
        10
    EOD;

    $pupilDetailsStmt = $db->prepare($sql);

    $pupilDetailsStmt->bindValue(':user_id', $user_id);

    $pupilDetailsStmt->execute();
    
    $pupildetails = $pupilDetailsStmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $pupildetails;
}