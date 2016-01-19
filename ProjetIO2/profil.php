<?php
session_start();
require_once('collection.php');
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset='utf-8'>
		<link rel="stylesheet" type="text/css" href="style.css">
		<title>Profil</title>
	</head>
	<body>
		<a href="pageAccueil.php" style="text-decoration:none"><h1>EmuRétroWorld</h1></a>
		<h2>Profil</h2>
		<?php
			echo "<nav id='mylink'>";
			echo "<table style='margin-left:3%;'>";
			echo "<tr>";
			echo "<td class='t'><a href='pageAccueil.php'>Page d'Accueil</a></td>";
			echo "<td class='t'><a href='modifInfo.php'>Modifier mes informations personnelles</a></td>";
			echo "<td class='t'><a href='newText.php'>Nouvel Article</a></td>";
			echo "</tr>";
			echo "</table>";			
			echo "</nav>";
			echo "<section>";
			$cursora = $collectiona->find(array('autor'=>$_SESSION['User']));
			if($cursora->hasNext()){
				echo "<h2><strong>Vos Articles : <strong></h2>";
				echo "<form action='actionUserText.php' method='post'>";
				$cursor = $collectiona->find(array('autor'=>$_SESSION['User']));
				foreach ($cursor as $c=>$v) {
					echo "<fieldset class='ar'>";
					echo "<legend>"."<strong>"."Titre : "."</strong><em>".$v['titlearticle']."</em>"."</legend><br />";
					echo "<strong>"."Article : "."</strong>"."<br/>";
					echo $v['article'];
					if(isset($v['multimedia'])){
						echo "<br />";
						echo "url : ";
						echo "<a href='".$v['multimedia']."' >Lien multimédia</a>";
					}
					echo "<br /><br />";
					echo "<em>Ecrit à : </em>";
					$date=$v['date'];
					$annee=substr($date, 0, 4);
					$mois=substr($date, 4, 2);
					$jour=substr($date, 6, 2);
					$heure=substr($date, 8, 2);
					$minute=substr($date, 10, 2);
					echo $heure.":".$minute."	".$jour."/".$mois."/".$annee;
					echo "<br />";
					if($v['verify']=='non'){
						echo " Statut : non vérifié par l'administrateur";
					}
					else{
						echo " Statut : vérifié par l'administrateur et publié";
					}
					echo "<br /><br />";
					echo "<table border='1'>";
					echo "<tr><td>"."<strong>"."Mots clefs :"."</strong>".$v['keyword1']." ".$v['keyword2']." ".$v['keyword3']." ".$v['keyword4']." ".$v['keyword5']."</td></tr>";
					echo "</table><br /><br />";
					echo "<label for='supprimer".$v['titlearticle']."'>Supprimer ".$v['titlearticle']."</label>"."<input type='radio' name='Actiontext' id='supprimer".$v['titlearticle']."' value='".$v['titlearticle']."delete'>";
					echo "<label for='modifier".$v['titlearticle']."'>Modifier ".$v['titlearticle']."</label>"."<input type='radio' name='Actiontext' id='modifier".$v['titlearticle']."' value='".$v['titlearticle']."modify'>";
					echo "</fieldset>";
					echo "<br /><br />";
				}
				//On ajoute le bouton de suppression des articles, on créer pour cela un formulaire 
				echo "<input type='submit' value='Envoyer'>";
				echo "</form>";
			}
			else{
				echo "<h2>Vous n'avez aucun article</h2>";
			}
			echo "</section>";	
		?>
	</body>
</html>
