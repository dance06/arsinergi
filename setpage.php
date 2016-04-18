<?php

session_start();

$_SESSION['page']=$_GET['page'];
switch($_GET['page']){
	case 'analysis':
		$_SESSION['item_id']="";
		break;
	case 'measurement':
		$_SESSION['project_id']=sha1(substr($_GET['prid'],8));
		break;
	case 'rab':
		$_SESSION['project_id']=sha1(substr($_GET['prid'],8));
		break;
	case 'rb':
		$_SESSION['project_id']=sha1(substr($_GET['prid'],8));
		break;
	case 'rbupah':
		$_SESSION['project_id']=sha1(substr($_GET['prid'],8));
		break;
	case 'projectlist': 
		$_SESSION['project_id']=sha1(substr($_GET['prid'],8));
		break;
}
header("Location: index.php");
?>
