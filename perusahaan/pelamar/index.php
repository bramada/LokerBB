<?php
require_once("../../include/initialize.php");
//checkAdmin();
  	 if (!isset($_SESSION['PER_USERID'])){
      redirect(web_root."perusahaan/index.php");
     }

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';
$header=$view;
$title="Pelamar";
switch ($view) {
	case 'list' :
		$content    = 'list.php';		
		break;

	case 'add' :
		$content    = 'add.php';		
		break;

	case 'edit' :
		$content    = 'edit.php';		
		break;

    case 'confirm' :
		$content    = 'confirm.php';		
		break;

    case 'print' :
		$content    = 'laporan.php';		
		break;
		
    case 'view' :
		$content    = 'view.php';		
		break;

	default :
		$content    = 'list.php';		
}
require_once ("../theme/templates.php");
?>
  
