<?php
session_start();
require_once('collection.php');
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset='utf-8'>
        <title>Modification</title><link rel="stylesheet" type="text/css" href="style.css">
		
	</head>
	<body>
		<a href="pageAccueil.php" style="text-decoration:none"><h1>EmuRétroWorld</h1></a>
		<?php
			// test si les nouvelles données ne sont pas vides
			if (isset($_POST['Nom']) && isset($_POST['Prenom']) && isset($_POST['Bdate']) && isset($_POST['Mail']) && isset($_POST['Sex']) && $_POST['Prenom']!="" && $_POST['Nom']!='' && $_POST['Bdate']!='' && $_POST['Mail']!='@' && $_POST['Bdate']!='jj/mm/aaaa'){
				//suppression des anciennes données
				$collection->remove(array('username' =>$_SESSION['User'],'hachepassword'=>$_SESSION['Hpassword']), array("justOne" => true));
				//Stockage des données
				$c=htmlspecialchars($_POST['Nom'], ENT_QUOTES);
				$d=htmlspecialchars($_POST['Prenom'], ENT_QUOTES);
				$e=htmlspecialchars($_POST['Sex'], ENT_QUOTES);
				$f=htmlspecialchars($_POST['Bdate'], ENT_QUOTES);
				$g=htmlspecialchars($_POST['Mail'], ENT_QUOTES);
				$collection->save(array('nom'=>$c,'prenom'=>$d,'sex'=>$e,'bdate'=>$f,'mail'=>$f,'username'=>$_SESSION['User'],'hachepassword'=>$_SESSION['Hpassword']));
				//Affichage du message
				echo "<section id='sectionMdp'>";
				echo "<p class='b'>Modification réussie</p>"."<br />";
				echo "</section>"."<br /><br />";
				echo "<nav><a href='pageAccueil.php'><p class='b'>Retournez à la page d'accueil</p></a></nav>";
			}
			else{
				echo "<section id='sectInfo'>";
				echo "<p class='b'>Echec de la modification des informations<p>"."<br />";
				echo "</section>"."<br /><br />";
				echo "<nav><a href='modifInfo.php' ><p class='b'>Revenir à la modification des informations</a></nav>";	
			}

		?>
	</body>
</html>