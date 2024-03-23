<?php
    session_start();
try{


$database = new PDO('mysql:host=localhost;dbname=Twitter','root','');
}catch (PDOException $e) {
    die('Site indisponible');
}
 $requete =$database->prepare('SELECT nom, id, email FROM user');
 $requete->execute();
$users = $requete->fetchALL(PDO::FETCH_ASSOC);
// var_dump($users);

// foreach($users as$user) {
//     echo $user ['nom'];
// }

if($_SERVER['REQUEST_METHOD']== 'POST' && $_POST['form']== 'ajoutuser') {
   
    if($_POST['nom'] !='' && $_POST['email']!='' && $_POST['password'] != '') {
        if ($_POST['password'] == $_POST['passwordVerif']) {
            $nouvelUser = [
            'nom' => $_POST['nom'],
            'email' => $_POST['email'],
            'password' => $_POST['password']
            ];
            $requete = $database->prepare("INSERT INTO user (nom, email, password) VALUES (:nom, :email, :password)");
            if ($requete ->execute($nouvelUser)) {
                echo 'User bien ajouté';
                $_SESSION['user'] = $nouvelUser['email'];
                $_SESSION['nom']  = $nouvelUser['nom'];
                header('Location: home.php');
                exit();
            }else {
                echo 'Erreur lors de lajout';
            }
        } else {
            echo 'les password ne coresponde pas';
        }
    } else {
        echo "Formulaire imcomplet";
    }
}

if($_SERVER['REQUEST_METHOD']== 'POST' && $_POST['form']== 'connexion') {
   
    if($_POST['emailConnexion']!='' && $_POST['passwordConnexion']) {

        $findUser = [
        'email' => $_POST['emailConnexion']
        ];
        $requete = $database->prepare("SELECT * FROM user WHERE email=:email");
        if ($requete ->execute($findUser)) {
            echo "done";
            $users = $requete->fetchALL(PDO::FETCH_ASSOC);
            var_dump($users[0]['password']);
            echo'-----';
            var_dump($_POST['passwordConnexion']);
            if ($_POST['passwordConnexion'] == $users[0]['password']) {
                $_SESSION['user'] = $_POST['emailConnexion'];
                $_SESSION['nom'] = $users[0]['nom'];
                header('Location: home.php');
                exit();
            } else {
                echo 'wrong password';
            }
        } else {
            echo "not done";
        }
        

    } else {
        echo "Formulaire imcomplet";
    }
}

if($_SERVER['REQUEST_METHOD']== 'POST' && $_POST['form']== 'makeTweet') {
   
    if($_POST['contenu']!='') {

        $findUser = ['email'=> $_SESSION['user']];
        $requete = $database->prepare("SELECT * FROM user WHERE email=:email");
        if ($requete ->execute($findUser)) {
            echo "done";
            echo'-----';
            $users = $requete->fetchALL(PDO::FETCH_ASSOC);
            var_dump($users[0]['id']);

        $stockTweet =  [
            'contenu'=> $_POST['contenu'],
            'user_id'=> $users[0]['id']
        ];
        $requete = $database->prepare("INSERT INTO tweet (contenu, user_id) VALUE (:contenu, :user_id)");
            if ($requete ->execute($stockTweet)) {
                header('Location: home.php');
                exit();
            } else {
                echo 'sql request probleme';
            }
        } else {
            echo "not done";
        }
        

    } else {
        echo "Formulaire imcomplet";
    }
}

if($_SERVER['REQUEST_METHOD']== 'POST' && $_POST['form']== 'deleteTweet') {
    $toDelete = [
        'contenu'=> $_POST['contenu'],
        'id' => $_POST['id']
    ];
    var_dump($_POST['id']);
    $requete = $database->prepare("DELETE FROM tweet WHERE user_id = :id AND contenu = :contenu");
    $requete ->execute($toDelete);
    header("Location: home.php");
    exit();
}