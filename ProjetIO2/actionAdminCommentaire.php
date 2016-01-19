<?php
session_start();
require_once('collection.php');
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset='UTF-8'>
		<title>Page administrateur</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<style></style>
		
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
				echo "<tr >";
				echo "<td class='t'><a href='pageAccueil.php'>Page d'Accueil</a></td>";
				echo "<td class='t'><a href='newText.php'>Nouvel Article</a></td>";
				echo "<td class='t'><a href='pageAdmin.php'>Retour</a></td>";
				echo "</tr>";
				echo "</table>";			
				echo "</nav>";
				echo "<section>";
				if(isset($_POST['Actiontext'])){
					$t=htmlspecialchars($_POST['Actiontext'], ENT_QUOTES);
					$_SESSION['Actiontext']=$t;
				}
				$s=$_SESSION['Actiontext'];
				$slongueur=strlen($s);
				$action=substr($s,($slongueur-6), 6);
				$title=substr($s, 0, ($slongueur-6));
				$_SESSION['Titlearticle']=$title;
				echo "<p class='b'>".$title."</p><br />";
				//echo $action."<br />";
				//echo $slongueur;
				//if($action=='modify'){echo "oui";}
				//$title=$_SESSION['Titlearticle'];
				if($action=='delete'){
					$collectiony->remove(array('titlearticle' =>$title), array('justOne' => true));
					$cursoro = $collectiony->find(array('titlearticle'=>'$title'));
					if($cursoro->hasNext()){
						foreach ($cursoro as $c=>$v) {
						echo $v['_id']	;
						}
					}
					else{
						echo "<p class='b'>Suppresion du commentaire réussi</p>";
					}
				}
				if($action=='publie'){
					$cursor = $collectiony->find(array('titlearticle'=>$title));
					foreach ($cursor as $c=>$v) {
						$collectiony->save(array('titlearticle'=>$v['titlearticle'], 'commentaire'=>$v['commentaire'], 'date'=>$v['date'], 'admindate'=>$v['admindate'], 'autor'=>$v['autor'], 'verify'=>'oui' ));
					}
					$collectiony->remove(array('titlearticle' =>$title, 'verify'=>'non'), array('justOne' => true));
					echo "<p class='b'>Publication du commentaire réussi</p>";
				}
			}
			else{
				echo "<nav id='mylink'>";
				echo "<table style='margin-left:3%'>";
				echo "<tr>";
				echo "<td class='t'><a href='pageAccueil.php'>Page d'Accueil</a></td>";
				echo "</tr>";
				echo "</table>";			
				echo "</nav>";
			}
		?>
	</body>
</html>
