<?php
session_start();
require_once('collection.php');
?>
<!DOCTYPE html>
<html lang='fr'>
	<head>
		<meta charset='UTF-8'>
		<title>Page administrateur</title>
	<link rel="stylesheet" type="text/css" href="style.css">
		
	</head>
	<body>
		<a href="pageAccueil.php" style="text-decoration:none"><h1>EmuRétroWorld</h1></a>
		<h3>Page administrateur</h3>
		<?php
			require_once('grossecarotte.php');
			$lapin=hachepasswordadmin();
			if(isset($_SESSION['User']) && isset($_SESSION['Hpassword']) && $_SESSION['User']=='admin' && $_SESSION['Hpassword']==$lapin){
				echo "<nav id='mylink'>";
				echo "<table style='margin-left:3%;'>";
				echo "<tr>";
				echo "<td class='t'><a href='pageAccueil.php'>Page d'Accueil</a></td>";
				echo "<td class='t'><a href='newText.php'>Nouvel Article</a></td>";
				echo "<td class='t'><a href='pageAdmin.php'>Retour</a></td>";
				echo "</tr>";
				echo "</table>";			
				echo "</nav>";
				echo "<section>";
				$cursora = $collectiony->find(array('verify'=>'non'));
				if($cursora->hasNext()){
					echo "<h2><strong>Commentaires du jour en attente d'une vérification : <strong></h2>";
					if(!isset($_POST['TextDelete'])){
						$cursor = $collectiony->find(array('verify'=>'non'));
						echo "<form action='actionAdminCommentaire.php' method='post'>";
						foreach ($cursor as $c=>$v) {
							echo "<fieldset class='co'>";
							echo "<legend>"."<strong>"."Titre de l'article : "."</strong><em>".$v['titlearticle']."</em>"."</legend><br />";
							echo "<strong>"."Commentaire : "."</strong>"."<br/>";
							echo $v['commentaire'];
							echo "<br /><br />";
							echo "<em>Ecrit par : </em>"."<strong>".strtoupper($v['autor'])."</strong>";
							echo "	à ";
							$date=$v['date'];
							$annee=substr($date, 0, 4);
							$mois=substr($date, 4, 2);
							$jour=substr($date, 6, 2);
							$heure=substr($date, 8, 2);
							$minute=substr($date, 10, 2);
							echo $heure.":".$minute."	".$jour."/".$mois."/".$annee;
							echo "<br /><br />";
							echo "<label for='supprimer".$v['titlearticle']."'>Supprimer ".$v['titlearticle']."</label>"."<input type='radio' name='Actiontext' id='supprimer".$v['titlearticle']."' value='".$v['titlearticle']."delete'>";
							echo "<label for='publier".$v['titlearticle']."'>Publier ".$v['titlearticle']."</label>"."<input type='radio' name='Actiontext' id='publier".$v['titlearticle']."' value='".$v['titlearticle']."publie'>";
							echo "</fieldset>";
							echo "<br /><br />";
						}
						//On ajoute le bouton de suppression des articles, on créer pour cela un formulaire 
						echo "<input type='submit' value='Envoyer'>";
					}
					else{
						$cursor = $collectiony->find(array('verify'=>'non'));
						echo "<form action='actionAdminCommentaire.php' method='post'>";
						foreach ($cursor as $c=>$v) {
							echo "<fieldset class='co'>";
							echo "<legend>"."<strong>"."Titre de l'article : "."</strong><em>".$v['titlearticle']."</em>"."</legend><br />";
							echo "<strong>"."Commentaire : "."</strong>"."<br/>";
							echo $v['commentaire'];
							echo "<br /><br />";
							echo "<em>Ecrit par : </em>"."<strong>".strtoupper($v['autor'])."</strong>";
							echo "	à ";
							$date=$v['date'];
							$annee=substr($date, 0, 4);
							$mois=substr($date, 4, 2);
							$jour=substr($date, 6, 2);
							$heure=substr($date, 8, 2);
							$minute=substr($date, 10, 2);
							echo $heure.":".$minute."	".$jour."/".$mois."/".$annee;
							echo "<br /><br />";
							echo "<label for='supprimer".$v['titlearticle']."'>Supprimer ".$v['titlearticle']."</label>"."<input type='radio' name='Actiontext' id='supprimer".$v['titlearticle']."' value='".$v['titlearticle']."delete'>";
							echo "<label for='publier".$v['titlearticle']."'>Publier ".$v['titlearticle']."</label>"."<input type='radio' name='Actiontext' id='publier".$v['titlearticle']."' value='".$v['titlearticle']."publie'>";
							echo "</fieldset>";
							echo "<br /><br />";
						}
						//On ajoute le bouton de suppression des articles, on créer pour cela un formulaire 
						echo "<input type='submit' value='Envoyer'>";
					}
				}
				else{
					echo "<h2><strong>Pas de commentaires du jour en attente d'une vérification <strong></h2>";
				}
				echo "</form>";
				echo "</section>";
			}
			else{
				echo "<nav id='mylink'>";
				echo "<table style='margin-left:3%;'>";
				echo "<tr>";
				echo "<td class='t'><a href='pageAccueil.php'>Page d'Accueil</a></td>";
				echo "</tr>";
				echo "</table>";			
				echo "</nav>";
			}
		?>
	</body>
</html>