<?php
	//Construction du mdp
	function generatepassword(){
		$alphabet='abcdefghijklmnopqrstuvwxyz';
		$mdpass=$alphabet{rand(0,25)}.$alphabet{rand(0,25)}.$alphabet{rand(0,25)}.$alphabet{rand(0,25)}.rand(1,100).rand(1,100);
		return $mdpass;
	}
?>