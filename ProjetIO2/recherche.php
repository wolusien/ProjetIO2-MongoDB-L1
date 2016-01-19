<?php
session_start();
require_once('collection.php');
?>
<!DOCTYPE html>
<html lang='fr'>
	<head>
		<meta charset='UTF-8'>
		<title>Résultats de la recherche</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<a href="pageAccueil.php" style="text-decoration:none"><h1>EmuRétroWorld</h1></a>
		<h3>Résultats de la recherche</h3>
		<br />
		<?php
			echo "<nav id='mylink'>";
			if(isset($_POST['Search']) && $_POST['Search']!=''){
				$k=htmlspecialchars($_POST['Search'], ENT_QUOTES);
				$where=array( '$or' => array( array('keyword1' =>$k), array('keyword2' =>$k), array('keyword3' =>$k), array('keyword4' =>$k), array('keyword5' =>$k ) ));
				$lariat=array( '$and' => array( array('verify' =>'oui'), $where ) );
				$cursor = $collectiona->find($lariat);
				if($cursor->hasNext()){
					echo "<form>";
					foreach ($cursor as $c=>$v) {
						echo "<fieldset class='ar'>";
					echo "<legend ><p class='r'>Titre : <em>".$v['titlearticle']."</em></p></legend><br />";
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
					echo "<table >";
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
				else{
					echo "<h2>Aucun article n'est associé à votre mot clef</h2>";
				}
			}
			
			else{
				echo "<h2>Aucun article n'est associé à votre mot clef</h2>";
			}
		?>
	</body>
</html>
