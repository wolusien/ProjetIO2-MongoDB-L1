<?php
session_start();
require_once('collection.php');
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset='UTF-8'>
		<title>Article terminé</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		
	</head>
	<body>
		<a href="pageAccueil.php" style="text-decoration:none"><h1>EmuRétroWorld</h1></a>
		<h3>Enregistrement de l'article</h3>
		<?php
			//On vérifie si l'article a bien été créé plus si le titre n'est pas déja pris par un autre article
			//On affiche l'article auquel on ajoute la date, le pseudo, les mots clefs, puis on stocke ces informations
			$cursor = $collectiona->find(array('titlearticle'=>$_POST['Titlearticle']));
			if(!($cursor->hasNext()) && isset($_POST['Titlearticle']) && isset($_POST['Article']) && isset($_POST['Keyword']) && $_POST['Titlearticle']!='' && $_POST['Article']!='Ecrivez ici le texte de votre article' && $_POST['Article']!='' && $_POST['Keyword']!=''){			
				$n=htmlspecialchars($_POST['Titlearticle'], ENT_QUOTES);
				$j=htmlspecialchars($_POST['Article'], ENT_QUOTES);
				$l=htmlspecialchars($_POST['Keyword'], ENT_QUOTES);
				$_SESSION['Titlearticle']=$n;
				$_SESSION['Article']=$j;
				$keyword = explode(';',$l);
				echo "<section id='article'>";
				if($_SESSION['User']=='admin'){
					echo "<form action='pageAdmin.php' method='post'>";
				}
				else{
					echo "<form action='profil.php' method='post'>";
				}
				echo "<fieldset class='ar'>";
				echo "<legend><p class='r'>Votre article :<em>".$_SESSION['Titlearticle']."</em></p></legend>";
				echo "<br /><br />";
				echo "<p>".$_SESSION['Article']."</p>";
				echo "<br /><br />";
				//On vérifie si l'utilisateur a entré une url ou pas, si oui on lui affiche
				if(isset($_POST['Multimedia']) && $_POST['Multimedia']!='https'){
					$o=htmlspecialchars($_POST['Multimedia'], ENT_QUOTES);
					echo "Voici votre url : ";
					echo "<a href='".$o."' >Lien multimédia</a>"."<br />";
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
				echo "<br /><br />";
				echo $_SESSION['User'];
				echo "</section>";
				//On vérifie si l'utilisateur a entré une url ou pas puis on stocke les informations
				if(isset($_POST['Multimedia']) && $_POST['Multimedia']!='https'){
					$collectiona->save(array('titlearticle'=>$_SESSION['Titlearticle'], 'article'=>$_SESSION['Article'], 'date'=>date('YmdHi'), 'admindate'=>date('Ymd'), 'autor'=>$_SESSION['User'], 'keyword1'=>$keyword[0], 'keyword2'=>$keyword[1], 'keyword3'=>$keyword[2], 'keyword4'=>$keyword[3], 'keyword5'=>$keyword[4], 'multimedia'=>$o, 'verify'=>'non' ));
					echo "<p class='b'>Votre article sera publié après vérification de l'administrateur</p>";
				}
				else{
					$collectiona->save(array('titlearticle'=>$_SESSION['Titlearticle'], 'article'=>$_SESSION['Article'], 'date'=>date('YmdHi'), 'admindate'=>date('Ymd'), 'autor'=>$_SESSION['User'], 'keyword1'=>$keyword[0], 'keyword2'=>$keyword[1], 'keyword3'=>$keyword[2], 'keyword4'=>$keyword[3], 'keyword5'=>$keyword[4], 'verify'=>'non' ));
					echo "<h2>Votre article sera publié après vérification de l'administrateur</h2>";
				}
				//On redirige l'utilisateur
				echo "<button type='submit' formtarget='_parent'>Retour au profil</button>";

				echo "</fieldset>";
				echo "</form>";
			}
			else{
				echo "<p class='r'>Mauvaise édition de texte : vous avez mal rempli un des champs";
				echo "<a href='newText.php'><p class='r'>Revenir à l'éditeur de texte</a></p>";
				echo "<a href='pageAccueil.php'><p class='r'>Revenir à l'accuel</p></a>";
			}
		?>
	</body>
</html>