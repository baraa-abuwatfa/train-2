<?php 
include('connec.php');
$username = $_POST['username'];
$depart_id = $_POST['depart_id'];
$mobile = $_POST['mobile'];
$city = $_POST['city'];

$sql = "INSERT INTO `users` (`username`,`depart_id`,`mobile`,`city`) values ('$username', '$depart_id', '$mobile', '$city' )";
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