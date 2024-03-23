<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    require 'database.php';
    if ($_SESSION['user'] == null ) {
        header('Location: index.php');
        exit();
    } else {
        echo 'Bienvenue à toi ' . $_SESSION['nom'];
    }
    ?>
    <button><a href="logout.php">Log out</a></button>
    <br>
    <h2>Recherche sur un sujet</h2>
    <form id="searchTweet" action="search.php" method="POST">

            <input type="hidden" name="form" value="searchTweet">
        
            <input type="text" name="search" id="search">


            <button type="submit">Rechercher</button>
    </form>
    <br>
    <h2>Faire un tweet</h2>
    <form id="makeTweet" action="database.php" method="POST">

            <input type="hidden" name="form" value="makeTweet">
        
            <input type="text" name="contenu" id="contenu">


            <button type="submit">Publier</button>
    </form>
    <br>
    <h1>Actualiter</h1>
    <?php


$requete =$database->prepare("SELECT * FROM tweet INNER JOIN user ON tweet.user_id =user.id ORDER BY tweet.id DESC");
 $requete->execute();
$tweets = $requete->fetchALL(PDO::FETCH_ASSOC);
foreach($tweets as $tweet){
    if ($_SESSION['nom'] == $tweet['nom']) {
        echo "<p class='tweet'>".$tweet['contenu']." By: ".$tweet['nom']."</p>";
        echo '<br>';
        echo '
            <form id="deleteTweet" action="database.php" method="POST">
                    <input type="hidden" name="form" value="deleteTweet">
                    <input type="hidden" name="contenu" value="'. $tweet["contenu"] .'">
                    <input type="hidden" name="id" value="'. $tweet["id"] .'">
                    <button type="submit">suprimer mon tweet</button>
            </form>
        ';
        echo '<hr>';
    } else {
        echo "<p class='tweet'>".$tweet['contenu']." By: ".$tweet['nom']."</p>";
        echo '<br>';
        echo '<hr>';
    }
}
?>
</body>
</html>