<?php include('connec.php'); ?>
<?php include('side.php'); ?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="css/bootstrap5.0.1.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" />

  <title>Ajax Operations</title>
  <style type="text/css">
    .btnAdd {
      text-align: right;
      width: 83%;
      margin-bottom: 20px;
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <h2 class="text-center">Welcome to Employee Page</h2>
    <p class="datatable design text-center"></p>
    <div class="row">
      <div class="container">
        <div class="btnAdd">
          <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addUserModal" class="btn btn-success btn-sm">Add User</a>
        </div>
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <table id="example" class="table">
              <thead>
                <th>Id</th>
                <th>Name</th>
                <th>Department</th>
                <th>Mobile</th>
                <th>City</th>
                <th>Options</th>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <div class="col-md-2"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- Optional JavaScript; choose one of the two! -->
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>
  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
  -->
  <script type="text/javascript">
    $(document).ready(function() {
      $('#example').DataTable({
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
          $(nRow).attr('id', aData[0]);
        },
        'serverSide': 'true',
        'processing': 'true',
        'paging': 'true',
        'order': [],
        'ajax': {
          'url': 'fetch_data.php',
          'type': 'post',
        },
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [5]
          },

        ]
      });
    });
    $(document).on('submit', '#addUser', function(e) {
      e.preventDefault();
      var city = $('#addCityField').val();
      var username = $('#addUserField').val();
      var mobile = $('#addMobileField').val();
      var depart_id = $('#addDepartField').val();
      if (city != '' && username != '' && mobile != '' && depart_id != '') {
        $.ajax({
          url: "add_user.php",
          type: "post",
          data: {
            city: city,
            username: username,
            mobile: mobile,
            depart_id: depart_id
          },
          success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
              mytable = $('#example').DataTable();
              mytable.draw();
              $('#addUserModal').modal('hide');
            } else {
              alert('failed');
            }
          }
        });
      } else {
        alert('Fill all the required fields');
      }
    });
    $(document).on('submit', '#updateUser', function(e) {
      e.preventDefault();
      //var tr = $(this).closest('tr');
      var city = $('#cityField').val();
      var username = $('#nameField').val();
      var mobile = $('#mobileField').val();
      var depart_id = $('#departField').val();
      var trid = $('#trid').val();
      var id = $('#id').val();
      if (city != '' && username != '' && mobile != '' && depart_id != '') {
        $.ajax({
          url: "update_user.php",
          type: "post",
          data: {
            city: city,
            username: username,
            mobile: mobile,
            depart_id: depart_id,
            id: id
          },
          success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
              table = $('#example').DataTable();
              // table.cell(parseInt(trid) - 1,0).data(id);
              // table.cell(parseInt(trid) - 1,1).data(username);
              // table.cell(parseInt(trid) - 1,2).data(email);
              // table.cell(parseInt(trid) - 1,3).data(mobile);
              // table.cell(parseInt(trid) - 1,4).data(city);
              var button = '<td><a href="javascript:void();" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Edit</a>  <a href="#!"  data-id="' + id + '"  class="btn btn-danger btn-sm deleteBtn">Delete</a></td>';
              var row = table.row("[id='" + trid + "']");
              row.row("[id='" + trid + "']").data([id, username, depart_id, mobile, city, button]);
              $('#exampleModal').modal('hide');
            } else {
              alert('failed');
            }
          }
        });
      } else {
        alert('Fill all the required fields');
      }
    });
    $('#example').on('click', '.editbtn ', function(event) {
      var table = $('#example').DataTable();
      var trid = $(this).closest('tr').attr('id');
      // console.log(selectedRow);
      var id = $(this).data('id');
      $('#exampleModal').modal('show');

      $.ajax({
        url: "get_single_data.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(data) {
          var json = JSON.parse(data);
          $('#nameField').val(json.username);
          $('#departemailField').val(json.depart_id);
          $('#mobileField').val(json.mobile);
          $('#cityField').val(json.city);
          $('#id').val(id);
          $('#trid').val(trid);
        }
      })
    });

    $(document).on('click', '.deleteBtn', function(event) {
      var table = $('#example').DataTable();
      event.preventDefault();
      var id = $(this).data('id');
      if (confirm("Are you sure want to delete this User ? ")) {
        $.ajax({
          url: "delete_user.php",
          data: {
            id: id
          },
          type: "post",
          success: function(data) {
            var json = JSON.parse(data);
            status = json.status;
            if (status == 'success') {
              //table.fnDeleteRow( table.$('#' + id)[0] );
              //$("#example tbody").find(id).remove();
              //table.row($(this).closest("tr")) .remove();
              $("#" + id).closest('tr').remove();
            } else {
              alert('Failed');
              return;
            }
          }
        });
      } else {
        return null;
      }



    })
  </script>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="updateUser">
            <input type="hidden" name="id" id="id" value="">
            <input type="hidden" name="trid" id="trid" value="">
            <div class="mb-3 row">
              <label for="nameField" class="col-md-3 form-label">Name</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="nameField" name="name">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="departField" class="col-md-3 form-label">Department</label>
              <div class="col-md-9">
           <!--     <select class="form-control" id="validationCustom01" value="" name="depart_id" required>
                      <option value="1">القسم رقم 1</option>
                      <option value="1">القسم رقم2</option>
                      <option value="1">القسم رقم 3</option>
                      <option value="1">القسم رقم 4</option>
                      <option value="1">القسم رقم 5</option>
                      <option value="1">القسم رقم 6</option>
                      <option value="1">القسم رقم 7</option>
                      <option value="1">القسم رقم 8</option>
                      <option value="1">القسم رقم 9</option>
                      <option value="1">القسم رقم 10</option>
                      <option value="1">القسم رقم 11</option>
                      <option value="1">القسم رقم 12</option>
                      <option value="1">القسم رقم 13</option>
                      <option value="1">القسم رقم 14</option>
                      <option value="1">القسم رقم 15</option>
                      <option value="1">القسم رقم 16</option>
                      <option value="1">القسم رقم 17</option>
                      <option value="1">القسم رقم 18</option>
                      <option value="1">القسم رقم 19</option>
                      <option value="1">القسم رقم 20</option>

                    </select>
-->
            <input type="depart_id" class="form-control" id="departField" name="depart_id">   
              </div>
            </div>
            <div class="mb-3 row">
              <label for="mobileField" class="col-md-3 form-label">Mobile</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="mobileField" name="mobile">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="cityField" class="col-md-3 form-label">City</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="cityField" name="City">
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Add user Modal -->
  <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="addUser" action="">
            <div class="mb-3 row">
              <label for="addUserField" class="col-md-3 form-label">Name</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="addUserField" name="name">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addDepartField" class="col-md-3 form-label">Department</label>
              <div class="col-md-9">
             <!--      <select class="form-control" id="validationCustom01" value="" name="depart_id" required>
                      <option value="1">القسم رقم 1</option>
                      <option value="1">القسم رقم2</option>
                      <option value="1">القسم رقم 3</option>
                      <option value="1">القسم رقم 4</option>
                      <option value="1">القسم رقم 5</option>
                      <option value="1">القسم رقم 6</option>
                      <option value="1">القسم رقم 7</option>
                      <option value="1">القسم رقم 8</option>
                      <option value="1">القسم رقم 9</option>
                      <option value="1">القسم رقم 10</option>
                      <option value="1">القسم رقم 11</option>
                      <option value="1">القسم رقم 12</option>
                      <option value="1">القسم رقم 13</option>
                      <option value="1">القسم رقم 14</option>
                      <option value="1">القسم رقم 15</option>
                      <option value="1">القسم رقم 16</option>
                      <option value="1">القسم رقم 17</option>
                      <option value="1">القسم رقم 18</option>
                      <option value="1">القسم رقم 19</option>
                      <option value="1">القسم رقم 20</option>

                    </select>
 -->
           <input type="depart_id" class="form-control" id="addDepartField" name="email">  
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addMobileField" class="col-md-3 form-label">Mobile</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="addMobileField" name="mobile">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addCityField" class="col-md-3 form-label">City</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="addCityField" name="City">
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
<script type="text/javascript">
  //var table = $('#example').DataTable();
</script>