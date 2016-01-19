<?php
	function hachepasswordadmin(){
		$mdp='admin';
		$mdpass=SHA1($mdp);
		return $mdpass;
	}
?>