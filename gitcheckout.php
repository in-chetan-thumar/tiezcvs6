<?php
	exec('/www/cronjobs/tiezcvs6');
	echo exec('git pull');
	
	//	echo '<br><Br> -l: '.exec('git branch -l');
	echo '<br><Br> -a: '. $allBranch = shell_exec('git branch -a');
	echo '<br> array ';
	$allBranch = explode(' ', $allBranch);
	print_R($allBranch); 
	
	$cBranch = exec('git branch | grep "*" | sed "s/* //"');
	echo '<br>Current branch name is: ' . $cBranch;
	
	$lBranch = exec('git branch --contains');
	echo '<br><br>Latest branch name is: ' . $lBranch;
	
	//echo '<br><br> New branch change is: <bR><br>' . exec('git diff --name-status branch1..branch2'); 
?>