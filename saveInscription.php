<?php
require_once('collection.php');
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Formulaire</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
    <body>
		<header>
		<a href="pageAccueil.php" style="text-decoration:none"><h1>EmuRétroWorld</h1></a>
		</header>
		<?php
			if (isset($_POST['Nom'])  
			&& isset($_POST['Prenom']) 
			&& isset($_POST['Bdate'])
			&& isset($_POST['Mail']) 
			&& isset($_POST['Pseudo']) 
			&& isset($_POST['Sex']) 
			&& $_POST['Prenom']!='' 
			&& $_POST['Nom']!='' 
			&& $_POST['Bdate']!='' 
			&& $_POST['Mail']!='@' 
			&& $_POST['Bdate']!='jj/mm/aaaa' 
			&& $_POST['Pseudo']!=''){
				$u=htmlspecialchars($_POST['Pseudo'], ENT_QUOTES);
				$cursor = $collection->find(array('username'=>$u));
				if(!$cursor->hasNext()){
					require_once('generatepassword.php');
					$mdpass=generatepassword();
					//haché de la base de données(on la stock dans la base de données pour plus de sécurité):créer une chaîne de caractère à partir de laquelle il es très dur de retrouver le mdp, 
					$hmdp=SHA1($mdpass);
					//Stockage des données
					$c=htmlspecialchars($_POST['Nom'], ENT_QUOTES);
					$d=htmlspecialchars($_POST['Prenom'], ENT_QUOTES);
					$e=htmlspecialchars($_POST['Sex'], ENT_QUOTES);
					$f=htmlspecialchars($_POST['Bdate'], ENT_QUOTES);
					$g=htmlspecialchars($_POST['Mail'], ENT_QUOTES);
					$h=htmlspecialchars($_POST['Pseudo'], ENT_QUOTES);
					$i=htmlspecialchars($hmdp);
					
					$collection->save(array('nom'=>$c,'prenom'=>$d,'sex'=>$e,'bdate'=>$f,'mail'=>$g,'username'=>$h,'hachepassword'=>$i));
					//Affichage du message
					echo "<section id='secmdp'>";
					echo "<p id='p' class='b'>Bravo. Vous êtes inscrit correctement</p>";
					echo "<p class='b'>Voici votre mot de passe </p> ";
					echo "<p id='pmdp' class='b''>".$mdpass."</p>";
					echo "<p class='b'>Il est important de le conserver et surtout de ne pas l'oublier</p>";
					echo "</section>";
					//echo "<nav id='mdplink'>";
					echo "<a href='pageAccueil.php' ><p class='b'>Retournez à la page d'accueil</p></a>";
					//echo "</nav>";
				}
			}
			else{
				echo "<section id='secmdp'>";
				echo "<br /><br />";
				echo "<p class='b'>Bonjour vous n'êtes pas inscrit</p>";
				echo "</section>";
				echo "<nav id='mdplink'>";
				echo "<a href='inscription.php' > <p class='b'>Créez votre compte</p></a>";	
				echo "</nav>";
			}

		?>
	</body>
</html>