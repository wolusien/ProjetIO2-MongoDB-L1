<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset='utf-8'>
        <title>Formulaire</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<style>form	{	background-color:#FFFFFF;
						width:20%;
						margin:-right:40%;
						margin-left:40%;
						margin-top:1%;
					}
		</style>
    </head>
    <body>
		<header>
		<a href="pageAccueil.php" style="text-decoration:none"><h1>EmuRétroWorld</h1></a>
		</header>
		<h2>Inscription</h2>
		<form action='saveInscription.php' method='post'>
			<fieldset>
			<legend>Inscription :</legend>
			<label for='nom'>Nom : </label><input type='text' name='Nom' id='nom' value=''><br /><br />
			<label for='prenom'>Prénom : </label><input type='text' name='Prenom' id='prenom' value=''><br /><br />
			<label for='male'>Homme</label><input type='radio' name='Sex' id='male' value='male'><br />
			<label for='female'>Femme</label><input type='radio' name='Sex' id='female' value='female'><br /><br />
			<label for='daten'>Date de naissance : </label><input type='date' name='Bdate' id='daten' value=''><br /><br />
			<label for='mail'>Votre adresse e-mail : </label><input type='email' name='Mail' id='mail' value=''><br /><br />
			<label for='user'>Votre nom d'utilisateur : </label><input type='text' name='Pseudo' id='user' value=''><br /><br />
			<input type='submit' value='Envoyer'>
			<input type='reset' value='Réinitialiser'>
			</fieldset>
		</form>
    </body>
</html>
