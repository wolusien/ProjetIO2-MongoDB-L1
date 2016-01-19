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
			//On vérifie si l'article a bien été modifié
			//On affiche l'article auquel on ajoute la date, le pseudo, les mots clefs, puis on stocke ces informations
			if(isset($_POST['Article']) && isset($_POST['Keyword']) && $_POST['Article']!='Ecrivez ici le texte de votre article' && $_POST['Article']!='' && $_POST['Keyword']!=''){			
				$j=htmlspecialchars($_POST['Article'], ENT_QUOTES);
				$l=htmlspecialchars($_POST['Keyword'], ENT_QUOTES);
				$_SESSION['Article']=$j;
				$keyword = explode(";",$l);
				
				echo "<form>";
				echo "<fieldset class='ar'>";
				echo "<legend><p class='r'>Votre article : ".$_SESSION['Titlearticle']."</p></legend>";
				echo "<br />";
				echo $_SESSION['Article'];
				echo "<br />";
				//On vérifie si l'utilisateur a entré une url ou pas, si oui on lui affiche
				if(isset($_POST['Multimedia']) && $_POST['Multimedia']!='https'){
					$m=htmlspecialchars($_POST['Multimedia'], ENT_QUOTES);
					echo "Voici votre url : ";
					echo $m."<br />";
				}
				echo "Voici vos mots clefs : ";
				echo $keyword[0].", ".$keyword[1].", ".$keyword[2].", ".$keyword[3].", ".$keyword[4];
				echo "<br /><br />";
				$date=date('YmdHi');
				$annee=substr($date, 0, 4);
				$mois=substr($date, 4, 2);
				$jour=substr($date, 6, 2);
				$heure=substr($date, 8, 2);
				$minute=substr($date, 10, 2);
				echo $heure.":".$minute."	".$jour."/".$mois."/".$annee;
				echo "<br />";
				echo $_SESSION['User'];
				echo "</fieldset>/<form>";
				//On vérifie si l'utilisateur a entré une url ou pas puis on stocke les informations
				if(isset($_POST['Multimedia']) && $_POST['Multimedia']!='https'){
					$m=htmlspecialchars($_POST['Multimedia'], ENT_QUOTES);
					//suppression de l'ancienne article
					$collectiona->remove(array('titlearticle' =>$_SESSION['Titlearticle'], 'autor'=>$_SESSION['User']), array('justOne' => true));
					$cursoro = $collectiona->find(array('titlearticle' =>$_SESSION['Titlearticle'], 'autor'=>$_SESSION['User']));
					if($cursoro->hasNext()){
						echo "<p class='b'>Echec de modification</p>";
						echo "<a href='actionUserText.php'><p class='b'>Revenir à l'éditeur de texte</p></a>";
						echo "<a href='pageAccueil.php'><p class='b'>Revenir à l'accueil</p></a>";
					}
					else{
						//Stockage du nouvel article
						$collectiona->save(array('titlearticle'=>$_SESSION['Titlearticle'], 'article'=>$_SESSION['Article'], 'date'=>date('YmdHi'), 'admindate'=>date('Ymd'), 'autor'=>$_SESSION['User'], 'keyword1'=>$keyword[0], 'keyword2'=>$keyword[1], 'keyword3'=>$keyword[2], 'keyword4'=>$keyword[3], 'keyword5'=>$keyword[4], 'verify'=>'non' ));
						echo "<p class='b'>Votre article sera publié après vérification de l'administrateur</p>";
					}
				}
				else{
					//suppression de l'ancienne article
					$collectiona->remove(array('titlearticle' =>$_SESSION['Titlearticle'], 'autor'=>$_SESSION['User']), array('justOne' => true));
					$cursoro = $collectiona->find(array('titlearticle' =>$_SESSION['Titlearticle'], 'autor'=>$_SESSION['User']));
					if($cursoro->hasNext()){
						echo "<p class='b'>Echec de modification</p>";
						echo "<a href='actionUserText.php'><p class='b'>Revenir à l'éditeur de texte</p></a>";
						echo "<a href='pageAccueil.php'><p class='b'>Revenir à l'accueil</p></a>";
					}
					else{
						//Stockage du nouvel article
						$collectiona->save(array('titlearticle'=>$_SESSION['Titlearticle'], 'article'=>$_SESSION['Article'], 'date'=>date('YmdHi'), 'admindate'=>date('Ymd'), 'autor'=>$_SESSION['User'], 'keyword1'=>$keyword[0], 'keyword2'=>$keyword[1], 'keyword3'=>$keyword[2], 'keyword4'=>$keyword[3], 'keyword5'=>$keyword[4], 'verify'=>'non' ));
						echo "<p class='b'>Votre article sera publié après vérification de l'administrateur</p>";
					}
				}
				//On redirige l'utilisateur
				if($_SESSION['User']=='admin'){
					echo "<a href='pageAdmin.php'><p class='b'>Revenir à votre page de  profil</p></a>";
				}
				else{
					echo "<a href='profil.php'><p class='b'>Revenir à votre page de profil</p></a>";
				}
				echo "<a href='pageAccueil.php'><p class='b'>Revenir à l'accueil</p></a>";
			}
			else{
				echo "<p class='b'>Mauvaise édition de texte : vous avez mal rempli un des champs</p>";
				echo "<a href='actionUserText.php'><p class='b'>Revenir à l'éditeur de texte</p></a>";
				echo "<a href='pageAccueil.php'><p class='b'>Revenir à l'accueil</p></a>";
			}
		?>
	</body>
</html>