<?php
session_start();
require_once('collection.php');
?>
<!DOCTYPE html>
<html lang='fr'>
	<head>
		<meta charset='UTF-8'>
		<title>Article de 2 semaines</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		
	</head>
	<body>
		<a href="pageAccueil.php" style="text-decoration:none"><h1>EmuRétroWorld</h1></a>
		<h2>Article de 2 semaines</h2>
		<br />
		<?php
			echo "<nav id='mylink'>";
			echo "<ul>";
			echo "<li><form action='pageArticlesToday.php' method='post'><button type='submit' formtarget='_parent'>Articles d'une semaine</button></form></li>";
			echo "<li><form action='pageArticlesOtherdays.php' method='post'><button type='submit' formtarget='_parent'>Articles des autres semaines</button></form></li>";
			echo "</ul>";
			echo "</nav>";
			
			//Affiche les articles
			echo "<section id='Arcticle'>";
			echo "<form>";
			$cursor = $collectiona->find(array('verify'=>'oui'));
			foreach ($cursor as $c=>$v) {
				if($v['admindate']<=(date('Ymd')-8) && $v['admindate']>=(date('Ymd')-15)){
					echo "<fieldset class='ar'>";
					echo "<legend ><strong><p class='a'>Titre : </strong><em>".$v['titlearticle']."</em></p></legend><br />";
					echo "<strong>"."Article : "."</strong>"."<br/>";
					echo $v['article'];
					if(isset($v['multimedia'])){
						echo "<br />";
						echo "url : ";
						echo "<a href='".$v['multimedia']."' >Lien multimédia</a>";
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
					echo "<table>";
					echo "<tr><td>"."<strong>"."Mots clefs :"."</strong>".$v['keyword1']." ".$v['keyword2']." ".$v['keyword3']." ".$v['keyword4']." ".$v['keyword5']."</td></tr>";
					echo "</table><br /><br />";
					echo "</fieldset>";
					echo "<br />";
			//Affiche les commentaires
					$cursora = $collectiony->find(array('verify'=>'oui', 'titlearticle'=>$v['titlearticle'] ));
					if($cursora->hasNext()){
						echo "<fieldset class='co'>";
						echo "<legend><p class='c'><strong>Commentaires: </strong></p></legend><br /><br />";
						foreach ($cursora as $d=>$w) {
							echo $w['commentaire'];
							echo "<br /><br />";
							echo "<em>Ecrit par : </em>"."<strong>".strtoupper($w['autor'])."</strong>";
							echo "	à ";
							$date=$w['date'];
							$annee=substr($date, 0, 4);
							$mois=substr($date, 4, 2);
							$jour=substr($date, 6, 2);
							$heure=substr($date, 8, 2);
							$minute=substr($date, 10, 2);
							echo $heure.":".$minute."	".$jour."/".$mois."/".$annee;
							echo "<br /><br />";
							
						}
						echo "</fieldset>";
					}
					
					echo "</form>";
			//Ecrire des commentaires
					echo "<form action='commentaires.php' method='post'>";
					echo "<fieldset class='ecco'>";
					echo "<legend><p class='c'><strong>Commentaires: </strong></p></legend><br />";
					echo "<input type='hidden' name='Titlearticle' value='".$v['titlearticle']."' >";
					echo "<input type='hidden' name='Date' value='".$v['admindate']."' >";
					echo "<textarea name='Commentaire' rows=10 cols=100 wrap=physical>";
					echo "Ecrivez ici le texte de votre commentaire";
					echo "</textarea>";
					echo "</fieldset>";
					echo "<input type='submit' value='Envoyer'>";
					echo "<input type='reset' value='Réinitialiser'>";
					echo "</form>";
					echo "<br /><br />";
				}
			}
			echo "</section>";
		?>
	</body>
</html>

		