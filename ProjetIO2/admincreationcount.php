<?php
	$cursor = $collection->find(array('username'=>'admin', 'hachepassword'=>SHA1('admin')) );
	if(!($cursor->hasNext())){
		$collection->save(array('nom'=>'DJEBALI','prenom'=>'Wissam','username'=>'admin','hachepassword'=>SHA1('admin')));
	}

?>