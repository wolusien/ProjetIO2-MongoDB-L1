<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset='UTF-8'>
		<title>Nouvel article</title>
	<link rel="stylesheet" type="text/css" href="style.css">
		
	</head>
	<body>
		<a href="pageAccueil.php" style="text-decoration:none"><h1>EmuRétroWorld</h1></a>
		<h2>Nouvel article</h2>
		<?php
			if(!isset($_POST['Contenumultimedia'])){
				echo "<table style='margin-left:3%;' class='t'><form action='newText.php' method='post'>";
				echo "<tr><td><label for='multi'>Nouvel article avec ajout de contenu multimédia</label><input type='radio' name='Contenumultimedia' id='multi' value='oui'></tr></td>";
				echo "<td><label for='multimed'>Nouvel article sans ajout de contenu multimédia</label><input type='radio' name='Contenumultimedia' id='multimed' value='non'></tr></td>";
				echo "<td><input type='submit' value='Continuez'></tr></td>";
				echo "</form></table>";
			}
			else{
				if(htmlspecialchars($_POST['Contenumultimedia'], ENT_QUOTES)=='oui'){
					echo "<form action='saveNewText.php' method='post'>";
					echo "<fieldset class='ecco'>";
					echo "<legend><p class='r'>Nouvel Article:</p></legend>";
					echo "<label for='title'>Titre de l'article : </label><input type='text' name='Titlearticle' id='title' value=''><br /><br />";
					echo "<textarea name='Article' rows=40 cols=100 wrap=physical>";
					echo "Ecrivez ici le texte de votre article";
					echo "</textarea>";
					echo "<br /><br />";
					//On demande à l'utilisateur 5 mots clefs(ce qui est assez suffisant pour un article)
					echo "<label for='motcle'>5 Mots clefs(séparés seulement un  ';') :      </label><input type='text' name='Keyword' id='motcle' value=''>";
					echo "<br /><br />";
					//On demande à l'utilisateur une adresse vers du contenu multimédia
					echo "<label for='multimedia'>Entrez l'adresse d'un image, d'une vidéo ou d'un son : </label><input type='url' name='Multimedia' id='multimedia'><br />";
					echo "<input type='submit' value='Envoyer'>";
					echo "<input type='reset' value='Réinitialiser'>";
					echo "</fieldset>";
					echo "</form>";
				}
				else{
					echo "<form action='saveNewText.php' method='post'>";
					echo "<fieldset class='ecco'>";
					echo "<legend><p class='r'>Nouvel Article:</p></legend>";
					echo "<label for='title'>Titre de l'article :      </label><input type='text' name='Titlearticle' id='title' value=''><br /><br />";
					echo "<textarea name='Article' rows=40 cols=100 wrap=physical>";
					echo "Ecrivez ici le texte de votre article";
					echo "</textarea>";
					echo "<br /><br />";
					//On demande à l'utilisateur 5 mots clefs(ce qui est assez suffisant pour un article)
					echo "<label for='motcle'>5 Mots clefs(séparés seulement un  ';') :      </label><input type='text' name='Keyword' id='motcle' value='' style='text-transform:lowercase;'>";
					echo "<br /><br />";
					echo "<input type='submit' value='Envoyer'>";
					echo "<input type='reset' value='Réinitialiser'>";
					echo "</fieldset>";
					echo "</form>";
				}
			}
		?>
	</body>
</html>