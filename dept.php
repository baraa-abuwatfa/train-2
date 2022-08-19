<?php include('connec.php'); ?>
<?php include('side.php'); ?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>Department </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
       
 <style>
   thead {background-color:#866ec7;}
   </style>
</head>
    <body>
        <div class="container">
            <div class="jumbotron">
        <div class="card">
            <div class="card-header">
            <h4>   Department Table </h4>
            </div>
            <div class="card-body">
                <!-- <h5 class="card-title">Details Departments </h5> -->
 
            <table class="table  table-hover table-bordered">
                <thead>
                    <tr>
                    <th scope="col">Dept_ID</th>
                    <th scope="col">Dept_Name</th>
                    <th scope="col">Options</th>
                    </tr>
                </thead>
                <tbody>
             <?php 
             $con  = mysqli_connect('localhost','root','','datatable_example');
             $sql= "Select * from dept";
             $result= mysqli_query($con, $sql);
              if($result){
                while($row= mysqli_fetch_assoc($result)){
                    $depart_id= $row['depart_id'];
                    $depart_name= $row['depart_name'];
                    echo '<tr>
                    <th>'.$depart_id.'</th>
                    <td>'.$depart_name.'</td>
                    <td> <button type="button" onclick="get_employees()"><a href="">View</a> </button></td>
                    </tr>';
                }
              }
             ?>
        
            </tbody>
            </table>
            </div>
        </div>
            </div>
        </div>
     <hr>

     <div class="container">
            <div class="jumbotron">
        <div class="card">
            <div class="card-header">
        <h4>       Employee Table </h4>
            
            </div>
            <div class="card-body">
                <!-- <h5 class="card-title">Details Employees </h5> -->
 
            <table class="table table-hover table-bordered " >
                <thead>
                    <tr>
                    <th scope="col">Emp_ID</th>
                    <th scope="col">Emp_Name</th>
                    <th scope="col">Options</th>
                    </tr>
                </thead>
                <tbody id="emps-list">

    </tbody>
            </table>
            </div>
        </div>
            </div>
        </div>
        <script>
function get_employees(depart_id) {
        $.ajax({
            url: "#" + depart_id,
        })
            .done(function( data ) {
                let users = JSON.parse(data);
                let v_str = '';

                for (let i = 0; i < users.length; i++) {
                    v_str += '' +
                        '<tr>' +
                        '   <td>' + users[i].id + '</td>' +
                        '   <td>' + users[i].username + '</td>' +
                        '   <td><button onclick="delete_employee(' + users[i].id + ', ' + depart_id + ')" type="button">Delete</button></td>' +
                        '</tr>';
                }
                $('#emps-list').html(v_str);
            });
    }
    function delete_employee(p_employee, p_department) {
        $.ajax({
            url: "#" + p_employee,
            method: 'post',
        })
            .done(function( data ) {
                get_employees(p_department);
            });
    }
    </script>
    </body>
</html>
