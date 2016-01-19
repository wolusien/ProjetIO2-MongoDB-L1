<?php
session_start();
require_once('collection.php');
?>
<!DOCTYPE html>
<html lang='fr'>
	<head>
		<meta charset='UTF-8'>
		<title>Commentaire</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<a href="pageAccueil.php" style="text-decoration:none"><h1>EmuRétroWorld</h1></a>
		<header></header>
		<h2>Commentaire</h2>
		<?php
			if(isset($_POST['Commentaire']) && $_POST['Commentaire']!='Ecrivez ici le texte de votre commentaire' && $_POST['Commentaire']!=''){
				$n=htmlspecialchars($_POST['Titlearticle'], ENT_QUOTES);
				$p=htmlspecialchars($_POST['Commentaire'], ENT_QUOTES);
				if(isset($_SESSION['User'])){
					$collectiony->save(array('titlearticle'=>$n, 'commentaire'=>$p, 'date'=>date('YmdHi'), 'admindate'=>htmlspecialchars($_POST['Date'], ENT_QUOTES), 'autor'=>$_SESSION['User'], 'verify'=>'non' ));
					echo "<p class='b'>Votre commentaire sera publié après vérification de l'administrateur.</p>";
					echo "<br /><br />";
				}
				else{
					$collectiony->save(array('titlearticle'=>$n, 'commentaire'=>$p, 'date'=>date('YmdHi'), 'admindate'=>htmlspecialchars($_POST['Date'], ENT_QUOTES), 'autor'=>'visiteur', 'verify'=>'non' ));
					echo "<p class='b'>Votre commentaire sera publié après vérification de l'administrateur.</p>";
					echo "<br /><br />";
				}
				echo "<nav id='mylink'>";
				echo "<table style='margin-left:3%;'>";
				echo "<tr>";
				if((htmlspecialchars($_POST['Date'], ENT_QUOTES))==date('Ymd')){
					echo "<td class='t'><form action='pageArticlesToday.php' method='post'>";
					echo "<button type='submit' formtarget='_parent'>Retournez à la page de l'article</button>";
					echo "</form></td>";
				}
				else{
					if((htmlspecialchars($_POST['Date'], ENT_QUOTES))==date('Ymd')-1){
						echo "<td class='t'><form action='pageArticlesYesterday.php' method='post'>";
						echo "<button type='submit' formtarget='_parent'>Retournez à la page de l'article</button>";
						echo "</form></td>";
					}
					else{
						if((htmlspecialchars($_POST['Date'], ENT_QUOTES))==date('Ymd')-2){
							echo "<td class='t'><form action='pageArticlesTwodaysago.php' method='post'>";
							echo "<button type='submit' formtarget='_parent'>Retournez à la page de l'article</button>";
							echo "</form></td>";
						}
						else{
							echo "<td class='t'><form action='pageArticlesOtherdays.php' method='post'>";
							echo "<button type='submit' formtarget='_parent'>Retournez à la page de l'article</button>";
							echo "</form></td>";
						}
					}
				}
				echo "</tr>";
				echo "</table>";
				echo "</nav>";
			}
			else{
				echo "<p class='b'>Mauvaise édition de commentaire</p>";
				echo "<br /><br />";
				echo "<nav id='mylink'>";
				echo "<table style='margin-left:3%;'>";
				echo "<tr>";
				if((htmlspecialchars($_POST['Date'], ENT_QUOTES))==date('Ymd')){
					echo "<td class='t'><form action='pageArticlesToday.php' method='post'>";
					echo "<button type='submit' formtarget='_parent'>Retournez à la page de l'article</button>";
					echo "</form></td>";
				}
				else{
					if((htmlspecialchars($_POST['Date'], ENT_QUOTES))==date('Ymd')-1){
						echo "<td class='t'><form action='pageArticlesYesterday.php' method='post'>";
						echo "<button type='submit' formtarget='_parent'>Retournez à la page de l'article</button>";
						echo "</form></td>";
					}
					else{
						echo "<td class='t'><form action='pageArticlesOtherdays.php' method='post'>";
						echo "<button type='submit' formtarget='_parent'>Retournez à la page de l'article</button>";
						echo "</form></td>";
					}
				}
				echo "</tr>";
				echo "</table>";
				echo "</nav>";				
			}
		?>
	</body>
</html>