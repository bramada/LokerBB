<?php
require_once ("../../include/initialize.php");
	  if (!isset($_SESSION['PER_USERID'])){
      redirect(web_root."admin/index.php");
     }

$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';

switch ($action) {
	case 'add' :
	doInsert();
	break;
	
	case 'edit' :
	doEdit();
	break;
	
	case 'delete' :
	doDelete();
	break;

	case 'photos' :
	doupdateimage();
	break;

 
	}
   
	function doInsert(){
		if(isset($_POST['save'])){


		if ($_POST['U_NAME'] == "" OR $_POST['U_USERNAME'] == "" OR $_POST['U_PASS'] == "") {
			$messageStats = false;
			message("Harus Diisi Semua!","error");
			redirect('index.php?view=add');
		}else{	
			$user = New User();
			$user->IDUSER 			= $_POST['user_id'];
			$user->NAMA_LENGKAP 	= $_POST['U_NAME'];
			$user->USERNAME			= $_POST['U_USERNAME'];
			$user->PASS				=sha1($_POST['U_PASS']);
			$user->PERANAN			=  $_POST['U_ROLE'];
			$user->create();

						$autonum = New Autonumber(); 
						$autonum->auto_update('IDUSER');

			message("Akun [". $_POST['U_NAME'] ."] Berhasil Dibuat!", "success");
			redirect("index.php");
			
		}
		}

	}

function doEdit(){
		if(isset($_POST['save'])){

			$company = New Company();
			$company->NAMA_PERUSAHAAN	= $_POST['COMPANYNAME'];
			$company->ALAMAT_PERUSAHAAN	= $_POST['COMPANYADDRESS'];
			$company->KONTAK_PERUSAHAAN	= $_POST['COMPANYCONTACTNO'];
			$company->EMAIL_PERUSAHAAN	= $_POST['COMPANYEMAIL'];
			$company->USERNAMEP			= $_POST['P_USERNAME'];
			$company->PASSP				= sha1($_POST['P_PASS']);
			$company->VISI_MISI			= $_POST['VM'];
			$company->update($_POST['COMPANYID']);

			message("Perusahaan berhasil diupdate!", "success");
			redirect("index.php");
		}

	}


	function doDelete(){
		
		// if (isset($_POST['selector'])==''){
		// message("Select the records first before you delete!","info");
		// redirect('index.php');
		// }else{

		// $id = $_POST['selector'];
		// $key = count($id);

		// for($i=0;$i<$key;$i++){

		// 	$user = New User();
		// 	$user->delete($id[$i]);

		
				$id = 	$_GET['id'];

				$user = New User();
	 		 	$user->delete($id);
			 
			message("User Berhasil Dihapus!","info");
			redirect('index.php');
		// }
		// }

		
	}

	function doupdateimage(){
 
			$errofile = $_FILES['photo']['error'];
			$type = $_FILES['photo']['type'];
			$temp = $_FILES['photo']['tmp_name'];
			$myfile =$_FILES['photo']['name'];
		 	$location="photos/".$myfile;


		if ( $errofile > 0) {
				message("Gambar Belum Dipilih!", "error");
				redirect("index.php?view=view&id=". $_GET['id']);
		}else{
	 
				@$file=$_FILES['photo']['tmp_name'];
				@$image= addslashes(file_get_contents($_FILES['photo']['tmp_name']));
				@$image_name= addslashes($_FILES['photo']['name']); 
				@$image_size= getimagesize($_FILES['photo']['tmp_name']);

			if ($image_size==FALSE ) {
				message("Upload File Harus Berupa Gambar!", "error");
				redirect("index.php?view=view&id=". $_GET['id']);
			}else{
					//uploading the file
					move_uploaded_file($temp,"photos/" . $myfile);
		 	
					 

						$user = New company();
						$user->FOTOP 			= $location;
						$user->update($_SESSION['PER_USERID']);
						redirect("index.php?view=view");
						 
							
					}
			}
			 
		}
 
?>