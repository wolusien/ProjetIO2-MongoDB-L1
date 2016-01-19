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
		<h2>Page administrateur</h2>
		<?php
			require_once('grossecarotte.php');
			$lapin=hachepasswordadmin();
			if(isset($_SESSION['User']) && isset($_SESSION['Hpassword']) && $_SESSION['User']=='admin' && $_SESSION['Hpassword']==$lapin){
				echo "<nav id='mylink'>";
				echo "<table style='margin-left:3%;'>";
				echo "<tr>";
				echo "<td class='t'><a href='pageAccueil.php'>Page d'Accueil</a></td>";
				echo "<td class='t'><a href='newText.php'>Nouvel Article</a></td>";
				echo "<td class='t'><a href='pageAdmincommentaires.php'>Gestion des commentaires</a></td>";
				echo "</tr>";
				echo "</table>";			
				echo "</nav>";
				echo "<section>";
				$cursora = $collectiona->find(array('verify'=>'non'));
				if($cursora->hasNext()){
					echo "<h2><strong>Articles du jour en attente d'une vérification : <strong></h2>";
					if(!isset($_POST['TextDelete'])){
						$cursor = $collectiona->find(array('verify'=>'non'));
						echo "<form action='actionAdminText.php' method='post'>";
						foreach ($cursor as $c=>$v) {
							echo "<fieldset class='ar'>";
							echo "<legend>"."<strong>"."Titre : "."</strong><em>".$v['titlearticle']."</em>"."</legend><br />";
							echo "<strong>"."Article : "."</strong>"."<br/>";
							echo $v['article'];
							if(isset($v['multimedia'])){
								echo "<br />";
								echo "url : ";
								echo $v['multimedia'];
							}
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
							echo "<table border='1'>";
							echo "<tr><td>"."<strong>"."Mots clefs :"."</strong>".$v['keyword1']." ".$v['keyword2']." ".$v['keyword3']." ".$v['keyword4']." ".$v['keyword5']."</td></tr>";
							echo "</table><br /><br />";
							echo "<label for='supprimer".$v['titlearticle']."'>Supprimer ".$v['titlearticle']."</label>"."<input type='radio' name='Actiontext' id='supprimer".$v['titlearticle']."' value='".$v['titlearticle']."delete'>";
							echo "<label for='publier".$v['titlearticle']."'>Publier ".$v['titlearticle']."</label>"."<input type='radio' name='Actiontext' id='publier".$v['titlearticle']."' value='".$v['titlearticle']."publie'>";
							echo "</fieldset>";
							echo "<br /><br />";
						}
						//On ajoute le bouton de suppression des articles, on créer pour cela un formulaire 
						echo "<input type='submit' value='Envoyer'>";
					}
					else{
						$cursore = $collectiona->find(array('verify'=>'non'));
						echo "<form action='actionAdminText.php' method='post'>";
						foreach ($cursor as $c=>$v) {
							echo "<fieldset>";
							echo "<legend>"."<strong>"."Titre : "."</strong><em>".$v['titlearticle']."</em>"."</legend><br />";
							echo "<strong>"."Article : "."</strong>"."<br/>";
							echo $v['article'];
							if(isset($v['multimedia'])){
								echo "<br />";
								echo "url : ";
								echo $v['multimedia'];
							}
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
							echo "<table border='1'>";
							echo "<tr><td>"."<strong>"."Mots clefs :"."</strong>".$v['keyword1']." ".$v['keyword2']." ".$v['keyword3']." ".$v['keyword4']." ".$v['keyword5']."</td></tr>";
							echo "</table><br /><br />";
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
					echo "<h2><strong>Pas d'articles du jour en attente d'une vérification <strong></h2>";				
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