<?php
session_start();
require_once('collection.php');
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset='UTF-8'>
		<title>Profil</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<a href="pageAccueil.php" style="text-decoration:none"><h1>EmuRétroWorld</h1></a>
		<h2>Profil</h2>
		<?php
			echo "<nav id='mylink'>";
			echo "<table style='margin-left:3%;'>";
			echo "<tr>";
			echo "<td class='t'><a href='pageAccueil.php'>Page d'Accueil</a></td>";
			echo "<td class='t'><a href='profil.php'>Profil</a></td>";
			echo "</tr>";
			echo "</table>";			
			echo "</nav>";
			echo "<section>";
			if(isset($_POST['Actiontext'])){
				$t=htmlspecialchars($_POST['Actiontext'], ENT_QUOTES);
				$_SESSION['Actiontext']=$t;//ajouter l'option de l'auteur
			}
			$s=$_SESSION['Actiontext'];
			$slongueur=strlen($s);
			$action=substr($s,($slongueur-6), 6);
			$title=substr($s, 0, ($slongueur-6));
			$_SESSION['Titlearticle']=$title;
			//echo $title."<br />";
			//echo $action."<br />";
			//echo $slongueur;
			//if($action=='modify'){echo "oui";}
			//$title=$_SESSION['Titlearticle'];
			//je recherche le titre de l'article et son auteur
			$where=array('autor' =>$_SESSION['User'], 'titlearticle' =>$title);
			if($action=='delete'){
				$collectiona->remove($where ,array("justOne" => true));
				$cursoro = $collectiona->find($where);
				if($cursoro->hasNext()){
					foreach ($cursoro as $c=>$v) {
					 echo $v['_id']	;
					}
				}
				else{
					echo "<p class='b'>Suppresion de l'article réussi</p>";
				}
			}
			if($action=='modify'){
				if(!isset($_POST['Contenumultimedia'])){
					echo "<br/><table style='margin-left:3%;' class='t'><form action='actionUserText.php' method='post'>";
					echo "<tr><td ><label for='multi'>Modifier article avec ajout de contenu multimédia</label><input type='radio' name='Contenumultimedia' id='multi' value='oui'></tr></td>";
					echo "<tr><td ><label for='multimed'>Modifier article sans ajout de contenu multimédia</label><input type='radio' name='Contenumultimedia' id='multimed' value='non'></tr></td>";
					echo "<tr><td><input type='submit' value='Continuez'></tr></td>";
					echo "</form></tr></table>";
				}
				else{
					echo "<form action='saveModifText.php' method='post'>";
					echo "<fieldset class='ecco'>";
					echo "<legend><p class='r'>Modification Article : </p></legend>";
					if($_POST['Contenumultimedia']=='oui'){
						$cursor = $collectiona->find($where);
						foreach ($cursor as $c=>$v) {
							$_SESSION['Titlearticle']=$v['titlearticle'];
							echo $v['titlearticle'];
							echo "<br />";
							echo "<textarea name='Article' rows=40 cols=100 wrap=physical>";
							echo $v['article'];
							echo "</textarea>";
							echo "<br /><br />";
							//On demande à l'utilisateur 5 mots clefs(ce qui est assez suffisant pour un article)
							echo "<label for='motcle'>5 Mots clefs(séparés seulement un  ';') :      </label><input type='text' name='Keyword' id='motcle' value='". $v['keyword1'].";".$v['keyword2'].";".$v['keyword3'].";".$v['keyword4'].";".$v['keyword5']."'>";
							echo "<br /><br />";
							//On demande à l'utilisateur une adresse vers du contenu multimédia
							if(isset($v['multimedia'])){
								echo "<label for='multimedia'>Entrez l'adresse d'un image, d'une vidéo ou d'un son : </label><input type='url' name='multimedia' id='multimedia' value='".$v['multimedia']."'><br />";
							}
							else{
								echo "<label for='multimedia'>Entrez l'adresse d'un image, d'une vidéo ou d'un son : </label><input type='url' name='multimedia' id='multimedia' value=''><br />";
							}
							echo "<input type='submit' value='Envoyer'>";
							echo "<input type='reset' value='Réinitialiser'>";
						}
					}
					else{
						$cursor = $collectiona->find($where);
						foreach ($cursor as $c=>$v) {
							$_SESSION['Titlearticle']=$v['titlearticle'];
							echo $v['titlearticle'];
							echo "<br />";
							echo "<textarea name='Article' rows=40 cols=100 wrap=physical>";
							echo $v['article'];
							echo "</textarea>";
							echo "<br /><br />";
							//On demande à l'utilisateur 5 mots clefs(ce qui est assez suffisant pour un article)
							echo "<label for='motcle'>5 Mots clefs(séparés seulement un  ';') :      </label><input type='text' name='Keyword' id='motcle' value='". $v['keyword1'].";".$v['keyword2'].";".$v['keyword3'].";".$v['keyword4'].";".$v['keyword5']."'>";
							echo "<br /><br />";
							echo "<input type='submit' value='Envoyer'>";
							echo "<input type='reset' value='Réinitialiser'>";
						}	
					}
					echo "</fieldset>";
					echo "</form>";
				}
			}
		?>
	</body>
</html>
