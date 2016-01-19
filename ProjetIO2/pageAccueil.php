<?php
session_start();
require_once('collection.php');
?>
<!DOCTYPE html>
<html lang='fr'>
	<head>
		<meta charset='UTF-8'>
		<title>EmuRétroWorld</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<style>
			h1 {text-align:center;}
		</style>
	</head>
	<body>
		<header>
		<h1>EmuRétroWorld</h1>
		<h2>Le journal participatif pour aider la nouvelle<br> génération à rencontrer les vieux pixels</h2>
		</header>
		<?php
			echo "<nav id='lien'>";
			//On vérifie si l'utilisateur a bien entré les données
			//On vérifie si les données existes
			if(!isset($_SESSION['User']) && !isset($_SESSION['Hpassword'])){
				if(!isset($_POST['User']) || !isset($_POST['Password'])){
					require('connexion.php');
				}
				else{
				//Les données existes 
				//On vérifie si les données entrées correspondent bien à celle stockées dans la base de données
					$a=htmlspecialchars($_POST['User'], ENT_QUOTES);
					$b=htmlspecialchars(SHA1($_POST['Password']), ENT_QUOTES);
					$cursor = $collection->find(array('username'=>$a,'hachepassword'=>$b));
					if(!$cursor->hasNext()){
						require('connexion.php');
					}
					else{
					//Les données sont valides
					//On vérifie si l'utilisateur ne s'est pas déjà connecté pour cela on vérifie la session existe
						if(!isset($_SESSION['User']) && !isset($_SESSION['Hpassword'])){
							$_SESSION['User']=$a;
							$_SESSION['Hpassword']=$b;
						}
						//else{
						//if(isset($_SESSION['User']) && isset($_SESSION['Hpassword'])){
						echo "<table class='in'><tr><td><p class='tab'>Bienvenue ".$_SESSION['User']." </p></td></tr><tr><td>";
						if($_SESSION['User']=='admin'){
							echo "<form action=''pageAdmin.php' method='post' style='display:inline;'>";
							echo "<button type='submit' formtarget='_parent'>Profil</button>";
							}
						else{
							echo "<form action='profil.php' method='post' style='display:inline;'>";
							echo "<button type='submit' formtarget='_parent'>Profil</button>";
							}
						echo "</form>";
						echo "<form action='deconnexion.php' method='post' style='display:inline;'>";
						echo "<button type='submit' formtarget='_parent'>Déconnexion</button>";
						echo "</form></td></tr>";
						echo "</table>";
						
					}
				}
			}
			else{
				echo "<table class='in'>";
				echo "<tr><td><p class='tab'>Bienvenue ".html_entity_decode($_SESSION['User'])." </p></td></tr>";
				echo "<tr><td>";
				if($_SESSION['User']=='admin'){
					echo "<form action='pageAdmin.php' method='post' style='display:inline;'>";
					echo "<button type='submit' formtarget='_parent'>Profil</button>";
				}
				else{
					echo "<form action='profil.php' method='post' style='display:inline;'>";
					echo "<button type='submit' formtarget='_parent'>Profil</button>";
					
				}
				echo "</form>";
				echo "<form action='deconnexion.php' method='post' style='display:inline;'>";
				echo "<button type='submit' formtarget='_parent'>Déconnexion</button>";
				echo "</form></td></tr>";
				echo "</table>";
			
			}
			//Recherche d'articles
			require('barreRecheche.php');
			echo "<ul>";
			echo "<li><form action='pageArticlesToday.php' method='post'>";
			echo "<button type='submit' formtarget='_parent'>Articles d'une semaine</button>";
			echo "</form></li>";
			echo "<li><form action='pageArticlesYesterday.php' method='post'>";
			echo "<button type='submit' formtarget='_parent'>Articles de 2 semaines </button>";
			echo "</form></li>";
			echo "<li><form action='pageArticlesOtherdays.php' method='post'>";
			echo "<button type='submit' formtarget='_parent'>Articles des autres semaines</button>";
			echo "</form></li>";
			echo "</ul>";
			echo "</nav>";
		?>
	</body>
</html>
