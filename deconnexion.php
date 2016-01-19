<?php
session_start();
$_SESSION=array();
session_destroy();
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset='UTF-8'>
		<title>EmuRétroWorld</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<h1>EmuRétroWorld</h1>
		<?php
			echo "<br /><br /><br /><br />";
			echo "<h2>Déconnexion réussie</h2>";
			echo "<nav>";
			echo "<a href='pageAccueil.php'><p class='b'>Retournez à la page d'accueil</p></a>";
			echo "</nav>";
		?>
	</body>
</html>