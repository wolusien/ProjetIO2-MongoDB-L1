<?php
session_start();
require_once('collection.php');
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset='utf-8'>
		<title>Action</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<a href="pageAccueil.php" style="text-decoration:none"><h1>EmuRétroWorld</h1></a>
		<br /><br />
		<h2>Action sur l'article</h2>
		<?php
		require_once('grossecarotte.php');
			$lapin=hachepasswordadmin();
			if(isset($_SESSION['User']) && isset($_SESSION['Hpassword']) && $_SESSION['User']=='admin' && $_SESSION['Hpassword']==$lapin){
				echo "<nav id='mylink'>";
				echo "<table style='margin-left:3%;'>";
				echo "<tr>";
				echo "<td class='t'><a href='pageAccueil.php'>Page d'Accueil</a></td>";
				echo "<td class='t'><a href='pageAdmin.php'>Page Administrateur</a></td>";
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
				echo "<p class='b'>".$title."<br /><p/>";				
				if($action=='delete'){
					$collectiona->remove(array('titlearticle' =>$title), array('justOne' => true));
					$cursoro = $collectiona->find(array('titlearticle'=>'$title'));
					if($cursoro->hasNext()){
						foreach ($cursoro as $c=>$v) {
						 echo $v['_id']	;
						}
					}
					else{
						echo "<p class='b'>Suppresion de l'article réussi</p>";
					}
				
				}
				if($action=='publie'){
					$cursor = $collectiona->find(array('titlearticle'=>$title));
					foreach ($cursor as $c=>$v) {
						if(isset($v['multimedia'])){
							$collectiona->save(array('titlearticle'=>$v['titlearticle'], 'article'=>$v['article'], 'date'=>$v['date'], 'admindate'=>$v['admindate'], 'autor'=>$v['autor'], 'keyword1'=>$v['keyword1'], 'keyword2'=>$v['keyword2'], 'keyword3'=>$v['keyword3'], 'keyword4'=>$v['keyword4'], 'keyword5'=>$v['keyword5'], 'multimedia'=>$v['multimedia'], 'verify'=>'oui' ));
						}
						else{
							$collectiona->save(array('titlearticle'=>$v['titlearticle'], 'article'=>$v['article'], 'date'=>$v['date'], 'admindate'=>$v['admindate'], 'autor'=>$v['autor'], 'keyword1'=>$v['keyword1'], 'keyword2'=>$v['keyword2'], 'keyword3'=>$v['keyword3'], 'keyword4'=>$v['keyword4'], 'keyword5'=>$v['keyword5'], 'verify'=>'oui' ));
						}
						$collectiona->remove(array('titlearticle' =>$v['titlearticle'], 'verify'=>'non'), array('justOne' => true));
						$cursorp = $collectiona->find(array('titlearticle'=>$title, 'verify'=>'non'));
						if($cursorp->hasNext()){
							foreach ($cursoro as $c=>$v) {
							 echo $v['_id']	;
							}
						}
						else{
							echo "<p class='b'>Publication de l'article réussi</p>";
						}
					}	
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
