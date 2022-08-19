<?php 
include('connec.php');
$username = $_POST['username'];
$depart_id = $_POST['depart_id'];
$mobile = $_POST['mobile'];
$city = $_POST['city'];
$id = $_POST['id'];

$sql = "UPDATE `users` SET  `username`='$username' , `depart_id`= '$depart_id', `mobile`='$mobile',  `city`='$city' WHERE id='$id' ";
$query= mysqli_query($con,$sql);
$lastId = mysqli_insert_id($con);
if($query ==true)
{
   
    $data = array(
        'status'=>'true',
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'false',
      
    );

    echo json_encode($data);
} 

?>