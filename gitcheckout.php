<?php
$action = '';
if($_POST['action'] != ''){
	$action = $_POST['action'];
} 
$cBranch = shell_exec('git branch | grep "*" | sed "s/* //"');

if($action == ''){
	echo shell_exec('git pull');
	
	$allBranch = shell_exec('git branch -a');
	$allBranch = explode(' ', $allBranch);
	foreach($allBranch as $key => $value){
		if($value == ''){
			unset($allBranch[$key]);
		}elseif($value == '->'){
			unset($allBranch[$key]);
		}else{
			$allBranch[$key] = str_replace('remotes/origin/', '', $value);
			$allBranch[$key] = str_replace('*', '', $allBranch[$key]);
			$allBranch[$key] = str_replace('origin/', '', $allBranch[$key]);
		}
	}
	$allBranch = array_unique($allBranch);
	sort($allBranch);
	
	echo '<br>Current branch name is: <b>' . $cBranch . '</b>';
	echo '<form name="checkout" action="" method="post">';
	echo '<input type="hidden" name="action" value="commitedFileList">';
	echo '<br><br>Checkout on branch: ';
		echo '<select name="checkoutBranch">';
			foreach($allBranch as $key => $value){
				echo '<option value="'.$value.'">'.$value.'</option>';
			}
		echo '</select>';
		echo '<input type="submit" name="submit" value="Checkout Branch">';
	echo '</form>';
}
print_r($_POST);
if($action == 'commitedFileList'){
	echo 'git diff --name-status '.$cBranch.'  '.$_POST['checkoutBranch'].'<BR><BR>';
	$fileList = shell_exec('git diff --name-status '.$cBranch.'  '.$_POST['checkoutBranch']); 
	echo '<br><br> New branch change is: <bR><br>' . $fileList;
}
?>