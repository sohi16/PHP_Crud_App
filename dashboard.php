<?php
    session_start();
    if(!isset($_SESSION['AdminLoginId'])){
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD App</title>
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <!-- font awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- css -->
  <link rel="stylesheet" href="style.css">
  <!-- datatable css -->
  <link href="https://cdn.datatables.net/v/bs5/dt-1.13.8/datatables.min.css" rel="stylesheet">
</head>

<body>
  <nav class="navbar fs-3 mb-3 text-white" >
    CRUD Application
    <form action="" method="POST">
        <button name="btnLogout" class="btn btn-secondary">LOGOUT</button>
    </form>
  </nav>

  <?php
    if(isset($_POST['btnLogout'])){
        session_destroy();
        header("Location: index.php");
    }
  ?> 

  <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4 ">
      <div class="text-body-secondary">
        <span class="h5">All Users</span>
        <br>
        Manage all your existing users or add a new user
      </div>
      <!-- Button to trigger Add user offcanvas -->
      <button class="btn btn-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser">
        <i class="fa-solid fa-user-plus fa-xs"></i>
        Add new user

      </button>
    </div>
    <div class="table-responsive{-sm|-md|-lg|-xl|-xxl}">
    <table class="table table-bordered table-striped table-hover align-middle" id="myTable" style="width:100%; margin-top:20px;">
      <thead class="table-dark mt-3">
        <tr>
          <th>ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Image</th>
          <th>Email</th>
          <th>Country</th>
          <th>Gender</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
    </div>
  </div>
  <!-- add user canvas -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser" style="width:600px;">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasExampleLabel">Add new user</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <form method="POST" id="insertForm">
        <div class="row mb-3">
          <div class="col">
            <label class="form-label">First Name</label>
            <input type="text" class="form-control" name="first_name" placeholder="enter last name">
          </div>
          <div class="col">
            <label class="form-label">Last Name</label>
            <input type="text" class="form-control" name="last_name" placeholder="enter last name">
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" name="email" placeholder="email@example.com">
        </div>
        <div class="row mb-3">
          <label class="form-label">Upload Image</label>
          <div class="col-2">
            <img src="images/default_profile.jpg" class="preview_img" alt="">
          </div>
          <div class="col-10">
            <div class="file-upload text-secondary">
              <input type="file" class="image" name="image" accept="image/*">
              <span class="fs-4 fw-2">Choose file..</span>
              <span>or drag and drop file here</span>
            </div>
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label">Country</label>

          <select name="country" class="form-control">
            <?php
            include 'countries.php'; // Include the countries array

            foreach ($countries as $country) {
              echo "<option value='$country'>$country</option>";
            }
            ?>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">Gender: </label>
          &nbsp; &nbsp;
          <input type="radio" class="form-check-input" name="gender" value="male" id="">
          <label class="form-input-label">Male</label>
          &nbsp;
          <input type="radio" class="form-check-input" name="gender" value="female" id="">
          <label class="form-input-label">Female</label>
        </div>
        <div>
          <button type="submit" class="btn btn-primary me-1" id="insertBtn">Submit</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="offcanvas">Cancel</button>
        </div>
      </form>
    </div>
  </div>

  <!-- edit user canvas -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEditUser" style="width:600px;">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasExampleLabel">Edit user</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <form method="POST" id="editForm">
        <input type="hidden" name="id" id="id">
        <div class="row mb-3">
          <div class="col">
            <label class="form-label">First Name</label>
            <input type="text" class="form-control" name="first_name" placeholder="enter last name">
          </div>
          <div class="col">
            <label class="form-label">Last Name</label>
            <input type="text" class="form-control" name="last_name" placeholder="enter last name">
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" name="email" placeholder="email@example.com">
        </div>
        <div class="row mb-3">
          <label class="form-label">Upload Image</label>
          <div class="col-2">
            <img src="images/default_profile.jpg" class="preview_img" alt="">
          </div>
          <div class="col-10">
            <div class="file-upload text-secondary">
              <input type="file" class="image" name="image" accept="image/*">
              <input type="hidden" name="image_old" id="image_old">
              <span class="fs-4 fw-2">Choose file..</span>
              <span>or drag and drop file here</span>
            </div>
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label">Country</label>

          <select name="country" class="form-control">
            <?php
            include 'countries.php'; // Include the countries array

            foreach ($countries as $country) {
              echo "<option value='$country'>$country</option>";
            }
            ?>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">Gender: </label>
          &nbsp; &nbsp;
          <input type="radio" class="form-check-input" name="gender" value="male" id="">
          <label class="form-input-label">Male</label>
          &nbsp;
          <input type="radio" class="form-check-input" name="gender" value="female" id="">
          <label class="form-input-label">Female</label>
        </div>
        <div>
          <button type="submit" class="btn btn-primary me-1" id="editBtn">Update</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="offcanvas">Cancel</button>
        </div>
      </form>
    </div>
  </div>

  <!-- toast container -->
  <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <!-- Success toast  -->
    <div class="toast align-items-center text-bg-success" role="alert" aria-live="assertive" aria-atomic="true" id="successToast">
      <div class="d-flex">
        <div class="toast-body">
          <strong>Success!</strong>
          <span id="successMsg"></span>
        </div>
        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
    <!-- Error toast  -->
    <div class="toast align-items-center text-bg-danger" role="alert" aria-live="assertive" aria-atomic="true" id="errorToast">
      <div class="d-flex">
        <div class="toast-body">
          <strong>Error!</strong>
          <span id="errorMsg"></span>
        </div>
        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  </div>
  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <!-- jquery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- JS -->
  <script src="script.js"></script>
  <!-- datatable script -->
  <script src="https://cdn.datatables.net/v/bs5/dt-1.13.8/datatables.min.js"></script>

  

</body>

</html>