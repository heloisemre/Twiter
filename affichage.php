<?php
require 'database.php';

$requete =$database->prepare('SELECT * FROM tweet INNER JOIN user ON tweet.user_id =user.id');
 $requete->execute();
$tweets = $requete->fetchALL(PDO::FETCH_ASSOC);

foreach($tweets as $tweet){
    echo 'pseudo : '.$tweet['nom'].': '.$tweet['contenu'];
    
}