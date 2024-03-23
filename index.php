<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>twiter</title>
</head>
<body>

    <main>
        <form id="signIn" action="database.php" method="POST">
        <fieldset>
            <legend>S'enregister</legend>
            <input type="hidden" name="form" value="ajoutuser">

            <label for nom="Nom">Nom</label>
            <input type="text" name=nom id="nom">
            
            <label for= "email">Email</label>
            <input type="email" name="email" id="email">

            <label for="password">Password</label>
            <input type="password" name="password" id="password">

            <label for="password">Confirmer Password</label>
            <input type="password" name="passwordVerif" id="passwordVerif">

            <button type="submit">Envoyer</button>
        </fieldset>
    <br>
    <p>Vous avez un compte ? Connectez vous <span id="showLogIn" style="cursor: pointer;
    color: blue;">ici</span></p>
    </form>

    <form id="logIn" action="database.php" method="POST">

        <fieldset>
            <legend>Connection</legend>

            <input type="hidden" name="form" value="connexion">
        
            <label for= "email">Email</label>
            <input type="text" name="emailConnexion" id="emailConnexion">

            <label for="password">Password</label>
            <input type="password" name="passwordConnexion" id="passwordConnexion">

            <button type="submit">Envoyer</button>
        </fieldset>
        
    <br>
    <p>Vous n'avez pas de compte ? Crée en un <span id="showSignIn" style="cursor: pointer;
    color: blue;">ici</span></p>
    </form>


    </main>
    <script src="script.js"></script>
</body>
</html>