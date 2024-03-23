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
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['form'] == 'searchTweet') {
        if (!empty($_POST['search'])) {
            $searchTerm = '%' . $_POST['search'] . '%';
            $requete = $database->prepare("SELECT * FROM tweet INNER JOIN user ON tweet.user_id =user.id WHERE contenu LIKE :search ORDER BY tweet.id DESC");
            $requete->execute(['search' => $searchTerm]);
            $tweets = $requete->fetchAll(PDO::FETCH_ASSOC);
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
        }
    }

    ?>
</body>
</html>