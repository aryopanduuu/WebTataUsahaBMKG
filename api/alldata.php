<?php 
require '../database/db.php';
$tampil = mysqli_query($conn,"SELECT * FROM surat_masuk ");
while($row=mysqli_fetch_object($tampil))
      {
         $data[] =$row;
      }
      $response=array(
        'status' => 1,
        'message' =>'Success',
        'data' => $data
     );
     echo json_encode($response);

  
?>