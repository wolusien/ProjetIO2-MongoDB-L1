<?php					
	echo "<table class='in'><tr><td><form action='pageAccueil.php' method='post' style='display:inline;'>";
	echo "<legend><strong><p class='tab'>Connexion :</p></strong></legend>";
	echo "<label for='user'></label><input type='text' name='User' id='user' placeholder='Nom d utilisateur'><br />";
	echo "<label for='password'></label><input type='password' name='Password' id='password' placeholder='Mot de passe'><br />";
	echo "<input type='submit' value='Connexion'>";
	echo "</form>";
	echo "<form action='inscription.php' method='post' style='display:inline;'>";
	echo "<button type='submit' formtarget='_parent'>S'inscrire</button>";
	echo "</form></td></tr></table>";
?>	
