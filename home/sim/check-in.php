<?php
require 'config.php';
require 'inc/session.php';
require 'inc/items_core.php';
require 'inc/categories_core.php';
if($_session->isLogged() == false)
	header('Location: index.php');

$_page = 4;

$role = $_session->get_user_role();
if($role==4)
	header('Location: items.php');
	if(isset($_POST['aplot'])){
		$maxsize = 5242880; // 5MB
				   
		$name = $_FILES['file']['name'];
		$target_dir = "file/";
		$target_file = $target_dir . $_FILES["file"]["name"];
		
		// Select file type
		$videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		// Valid file extensions
		$extensions_arr = array("jpg","docx","txt","png","xlsx", "doc");

		// Check extension
		if( in_array($videoFileType,$extensions_arr) ){
			
			// Check file size
			if(($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) {
				echo "File too large. File must be less than 5MB.";
			}else{
				// Upload
				if(move_uploaded_file($_FILES['file']['tmp_name'],$target_file)){
					// Insert record
					$query = "INSERT INTO file(namafile,lokasi) VALUES('".$name."','".$target_file."')";

					mysqli_query($mysqli,$query);
					echo "Upload successfully.";
				}
			}

		}else{
			echo "Invalid file extension.";
		}
	
	}

	
?>

<!DOCTYPE HTML>
<html>
<head>
<?php require 'inc/head.php'; ?>

</head>
<body>
	<div id="main-wrapper">
		<?php require 'inc/header.php'; ?>
		
		<div class="wrapper-pad">
			<h2>Berkas</h2>
			<div class="center">
				<div class="new-item form">
				<form method="post" action="" enctype='multipart/form-data'>
            <input type='file' name='file' />
            <input type='submit' value='Upload' name='aplot'>
        </form>
		<table border="1" rules="rows" id="items">
		<?php
		$query = "SELECT * FROM file ORDER BY id DESC";	
					if ($result = $mysqli->query($query)){			
					
					
						
					
					}
							
while($row = mysqli_fetch_array($result))
{
    echo "<tr>";
        echo "<td>" . $row['namafile'] . "</td>";
		echo "<td><a href=".rawurlencode($row['lokasi']),">LIHAT</a></td>";
       
        echo "<td><a href='delete.php?did=".$row['id']."' >HAPUS</a></td>";
    echo "</tr>";
}
?>
								</table>
		
					
	
				</div>
			</div>
		</div>
		
		<div class="clear" style="margin-bottom:40px;"></div>
		<div class="border" style="margin-bottom:30px;"></div>
	</div>
</body>
</html>