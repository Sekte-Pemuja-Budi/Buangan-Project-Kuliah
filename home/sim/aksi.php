<?php
require 'config.php';
require 'inc/session.php';
require 'inc/items_core.php';
require 'inc/categories_core.php';
if($_session->isLogged() == false)
	header('Location: index.php');

$_page = 2;

$role = $_session->get_user_role();
if($role==4)
	header('Location: items.php');

if(isset($_POST['act'])) {
	if($_POST['act'] == '1') {
		if(!isset($_POST['name']) || !isset($_POST['descrp']) || !isset($_POST['cat']) || !isset($_POST['qty']) || !isset($_POST['price']))
			die('wrong');
		if($_POST['name'] == '' || $_POST['cat'] == '' || $_POST['price'] == '')
			die('wrong');
		
		$name = $_POST['name'];
		$descrp = $_POST['descrp'];
		$cat = $_POST['cat'];
		$qty = $_POST['qty'];
		$price = $_POST['price'];
		
		// Fix price
		$price = (string)$price;
		if(strpos($price, '.') === false) {
			$price = $price.'';
		}else{
			$pos = strpos($price, '.');
			if($price{$pos+1} == null)
				$price = $price.'';
			elseif(!isset($price{$pos+2}))
				$price = $price.'';
			else
				$price = substr($price,0,$pos+3);
		}
		
		if(substr_count($price, '.') > 1)
			die('wrong');
		
		if($_items->new_item($name, $descrp, $cat, $qty, $price) == false)
			die('wrong');
		die('1');
	}
}
if($_POST['upload']){
    $ekstensi_diperbolehkan	= array('png','jpg');
    $nama = $_FILES['file']['name'];
    $x = explode('.', $nama);
    $ekstensi = strtolower(end($x));
    $ukuran	= $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];	

    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
        if($ukuran < 1044070){			
            move_uploaded_file($file_tmp, 'file/'.$nama);
            $query = mysql_query("INSERT INTO upload VALUES(NULL, '$nama')");
            if($query){
                echo 'FILE BERHASIL DI UPLOAD';
            }else{
                echo 'GAGAL MENGUPLOAD GAMBAR';
            }
        }else{
            echo 'UKURAN FILE TERLALU BESAR';
        }
    }else{
        echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
    }
}
?>