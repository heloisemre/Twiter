<?php

require 'database.php';

if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['form'] == 'supprimer'){
    $userASupprimer = [
        'id' => $_POST['suppr']
    ];

    $requete = $database->prepare('DELETE FROM user WHERE id = :id');
    $requete->execute($userASupprimer);
}