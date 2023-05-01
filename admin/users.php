<?php 
include "../dbcon.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Users Management</title>
</head>

<body class="fixed-left">

  <!-- Top Bar Start -->
  <?php include('includes/navbar.php'); ?>
  <!-- ========== Left Sidebar Start ========== -->
  <?php include('includes/sidebar.php'); ?>
  <!-- Left Sidebar End -->

  <main class="mt-5 pt-3 px-4">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 mb-3">
          <div class="card">
            <div class="card-header">
              <span><i class="bi bi-people-fill me-2"></i></span> Users
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="example" class="table table-hover data-table" style="width: 100%">

                  <div class="m-2">
                    <!-- Button HTML (to Trigger Modal) -->
                    <button type="button" id="myBtn" class="btn btn-outline-success">
                      <span class="me-2"><i class="bi bi-person-plus-fill"></i></span>
                      Add User
                    </button>

                    <!-- Modal HTML -->
                    <div id="myModal" class="modal fade" data-bs-backdrop="static" tabindex="-1">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Add User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>
                          <div class="modal-body">

                            <form class="needs-validation" method="POST">
                              <div class="form-row">
                                <div class="col-md-12 mb-2">
                                  <label for="validationCustom01">User ID</label>
                                  <input type="text" class="form-control" id="validationCustom01" name="empid"
                                    placeholder="Enter  ID" required>
                                  <div class="valid-feedback">
                                    Looks good!
                                  </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                  <label for="validationCustom01">Username</label>
                                  <input type="text" class="form-control" id="validationCustom01" name="username"
                                    placeholder="Enter  Username" required>
                                  <div class="valid-feedback">
                                    Looks good!
                                  </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                  <label for="validationCustom02">Password</label>
                                  <input type="password" class="form-control" id="validationCustom02" name="password"
                                    placeholder="Enter Password" required>
                                  <div class="valid-feedback">
                                    Looks good!
                                  </div>
                                </div>
                                <div class="form-check col-md-12 mt-3">
                                  <input class="form-check-input" type="checkbox" name="isadmin" value="" id="flexCheckIndeterminate">
                                  <label class="form-check-label" for="flexCheckIndeterminate">
                                    Admin?
                                  </label>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                <button class="btn btn-success">Save</button>
                              </div>
                            </form>
                            <?php
                            if (isset($_POST['empid'])) {
                              if (isset($_POST['isadmin']))
                              {
                                $newisadmin = "admin";
                              }
                              else
                              {
                                $newisadmin = "user";
                              }
                              $sql = "INSERT INTO `users` (user_id,`username`,`password`,privilege)
                                            VALUES ('" . $_POST['empid'] . "','" . $_POST['username'] . "','" . $_POST['password'] . "','".$newisadmin."')";
                              if ($conn->query($sql) === TRUE) {
                                echo '<script>alert("User Addedd Successfully!") 
                                                window.location.href="users.php"</script>';
                              } else {
                                echo '<script>alert("Adding User Failed!\n Please Check SQL Connection String!") 
                                                window.location.href="users.php"</script>';
                              }
                            }
                            ?>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <thead class>
                    <tr>
                      <th>User ID</th>
                      <th>Username</th>
                      <th>Password</th>
                      <th>Privilege</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $sql = "SELECT * FROM `users`;";
                      $actresult = mysqli_query($conn, $sql);

                      while ($result = mysqli_fetch_assoc($actresult)) {
                      ?>
                    <tr>
                      <td>
                        <?php echo $result['user_id']; ?>
                      </td>
                      <td>
                        <?php echo $result['username']; ?>
                      </td>
                      <td>
                        <?php echo $result['password']; ?>
                      </td>
                      <td>
                        <?php echo $result['privilege']; ?>
                      </td>
                      <td>
                        <div class="d-grid gap-2 d-md-flex">
                          <a href="#edit<?php echo $result['id']; ?>" data-toggle="modal" class="btn btn-primary btn-sm me-md-2"><span
                              class="me-2"><i class="bi bi-pencil"></i></span> Edit</a> ||
                          <a href="#del<?php echo $result['id']; ?>" data-toggle="modal" class="btn btn-danger btn-sm"><span class="me-2"><i
                                class="bi bi-trash"></i></span>
                            Delete</a>
                        </div>
                      </td>
                    </tr>
                    <!-- Start of Edit Modal -->
                    <!-- Edit Modal HTML -->
                    <div id="edit<?php echo $result['id']; ?>" class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <form id="update_form" method="POST">
                            <div class="modal-header">
                              <h4 class="modal-title">Edit Faculty</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                              <?php
                                $id = $result['id'];
                                $edit = mysqli_query($conn, "select * from users where id='" . $result['id'] . "'");
                                $erow = mysqli_fetch_array($edit);
                                ?>
                              <input type="hidden" id="id_u" name="editid" value="<?php echo $result['id']; ?>" class="form-control" required>
                              <div class="form-group">
                                <label>Faculty ID</label>
                                <input type="text" id="name_u" name="editempid" value="<?php echo $result['user_id']; ?>" class="form-control" required>
                              </div>
                              <div class="form-group">
                                <label>Username</label>
                                <input type="text" id="username_u" name="editusername" value="<?php echo $result['username']; ?>" class="form-control"
                                  required>
                              </div>
                              <div class="form-group">
                                <label>Password</label>
                                <input type="password" id="password_u" name="editpassword" value="<?php echo $result['password']; ?>" class="form-control"
                                  required>
                              </div>
                              <div class="form-check col-md-12 mt-3">
                                
                                  <input class="form-check-input" type="checkbox" name="isadmin" <?php if ($result['privilege']=== "admin")
                                  {
                                    echo 'checked=""';
                                  }?> id="flexCheckIndeterminate">
                                  <label class="form-check-label" for="flexCheckIndeterminate">
                                    Admin?
                                  </label>
                                </div>
                            </div>
                            <div class="modal-footer">
                              <input type="hidden" value="2" name="type">
                              <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                              <button class="btn btn-info" id="update">Update</button>
                            </div>
                          </form>
                          <?php
                          if (isset($_POST['editusername']))
                          {
                            if (isset($_POST['isadmin']))
                            {
                              $isadmin = "admin";
                            }
                            else
                            {
                              $isadmin = "user";
                            }
                            $sql = "UPDATE `users` SET user_id = '" . $_POST['editempid'] . "', username = '" . $_POST['editusername'] . "',
                             password = '" . $_POST['editpassword'] . "'
                             WHERE id='" . $_POST['editid'] . "';";
                            //$sql = "UPDATE `users` SET user_id =12 WHERE id = 1; ";
                            if ($conn->query($sql) === TRUE) {
                              echo '<script>alert("Users Edit Successful!") 
                                      window.location.href="users.php"</script>';
                            } else {
                              echo '<script>alert("Editing User Details Failed!\n Please Check SQL Connection String!") 
                                      window.location.href="users.php"</script>';
                            }
                          }
                          ?>

                        </div>
                      </div>
                    </div>
                    <!-- End of Edit Modal -->

                    <!-- Delete -->
                    <div class="modal fade" id="del<?php echo $result['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                      aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <center>
                              <h4 class="modal-title" id="myModalLabel">Delete</h4>
                            </center>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          </div>
                          <div class="modal-body">
                            <?php
                              $del = mysqli_query($conn, "select * from users where id='" . $result['id'] . "'");
                              $drow = mysqli_fetch_array($del);
                            ?>
                            <div class="container-fluid">
                              <h5>
                                <center>Are you sure to delete <strong>
                                  <?php echo ucwords($drow['username']); ?>
                                  </strong> from User list? This method cannot be undone.</center>
                              </h5>
                            </div>
                          </div>
                          <form method="POST">
                            <input type="hidden" id="id_u" name="deleteid" value="<?php echo $drow['id']; ?>" class="form-control" required>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal"><span
                                  class="glyphicon glyphicon-remove"></span> Cancel</button>
                              <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>
                                Delete</button>
                            </div>
                            <?php
                              if (isset($_POST['deleteid'])) {
                                $sql = "DELETE FROM users  WHERE id='" . $_POST['deleteid'] . "'";
                                if ($conn->query($sql) === TRUE) {
                                  echo '<script>alert("Deleted Successfully!") 
                                                window.location.href="users.php"</script>';
                                } else {
                                  echo '<script>alert("Deleting Employee Details Failed!\n Please Check SQL Connection String!") 
                                                window.location.href="users.php"</script>';
                                }
                              }
                            ?>
                          </form>
                          
                        </div>
                      </div>
                    </div>
                    <!-- /.modal -->

                    <?php } ?>
                  </tbody>
                  <tfoot></tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="./js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
  <script src="./js/jquery-3.5.1.js"></script>
  <script src="./js/jquery.dataTables.min.js"></script>
  <script src="./js/dataTables.bootstrap5.min.js"></script>
  <script src="./js/script.js"></script>
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function () {
      $("#myBtn").click(function () {
        $("#myModal").modal("toggle");
      });
    });
  </script>

</body>

</html>