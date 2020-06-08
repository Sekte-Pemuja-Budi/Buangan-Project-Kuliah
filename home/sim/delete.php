<?php

require 'check-in.php';
if(isset($_GET['did'])) {
    
    $delete_id = mysqli_real_escape_string($mysqli, $_GET['did']);
    
    $sql = "SELECT namafile FROM file WHERE id = '$delete_id'";
    $result1 = mysqli_query($mysqli,$sql);
    if ($result1) {
        while ($row = mysqli_fetch_assoc($result1)) {
          $file = $row['namafile'];
        }
      }
      $sql1  = "DELETE FROM file WHERE id='$delete_id'";
      $result = mysqli_query($mysqli, $sql1);
    
      if ($result) {
        unlink('file/'.$file);
        echo "<h1>Berhasil dihapus !</h1>";
      }else{
        echo "Gagal dihapus !";
      }
    }
    header('Location: check-in.php');
    exit();
                    ?>