<?php
session_start();

include('dbcon.php');
//Delete Patients
if(isset($_POST['delete-patients']))
{
    $id = $_POST['id_key'];

    $ref_table = "Patients/".$id;

    $deleteData = $database->getReference($ref_table)->remove();

   
}
//edit patients from database
if(isset($_POST['edit-patients']))
{
    $id = $_POST['id'];
    $firstname = $_POST['first-name'];
    $lastname = $_POST['last-name'];
    $username = $_POST['user-name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $date = $_POST['date'];
    $age = date_diff(date_create($date),date_create('Today'))->y;
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $img = $_POST['img'];
    $gender = $_POST['gender'];
    
    //
    $updateData = 
    [
        'firstname' => $firstname,
        'lastname' => $lastname,
        'username' => $username,
        'email' => $email,
        'password' => $password,
        'age' => $age,
        'address' => $address,
        'phone' => $phone,
        'img' => $img,
        'gender' => $gender,
    ];
    $ref_table = "Patients/".$id;
    $updatequery = $database->getReference($ref_table)->update($updateData);

}
// insert data into database
if(isset($_POST['create-patients']))
{
    $firstname = $_POST['first-name'];
    $lastname = $_POST['last-name'];
    $username = $_POST['user-name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $date = $_POST['date'];
    $age = date_diff(date_create($date),date_create('Today'))->y;
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $img = $_POST['img'];
    $gender = $_POST['gender'];
    
    //
    $postData = 
    [
        'firstname' => $firstname,
        'lastname' => $lastname,
        'username' => $username,
        'email' => $email,
        'password' => $password,
        'age' => $age,
        'address' => $address,
        'phone' => $phone,
        'img' => $img,
        'gender' => $gender,
    ];
    $ref_table = "Patients";
    $postRef = $database->getReference($ref_table)->push($postData);

}

?>

<!DOCTYPE html>
<html lang="en">


<!-- patients23:17-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/LOGO.jpg">
    <title>Survival-map</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <div class="header">
			<div class="header-left">
				<a href="index.php" class="logo">
					<img src="assets/img/logo web.png" width="500" height="55" alt="logo">
				</a>
			</div>
			<a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img"><img class="rounded-circle" src="assets/img/user.jpg" width="40" alt="Admin">
							<span class="status online"></span></span>
                        <span>Admin</span>
                    </a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="profile.php">My Profile</a>
						<a class="dropdown-item" href="edit-profile.php">Edit Profile</a>
						<a class="dropdown-item" href="login.php">Logout</a>
					</div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.php">My Profile</a>
                    <a class="dropdown-item" href="edit-profile.php">Edit Profile</a>
                    <a class="dropdown-item" href="login.php">Logout</a>
                </div>
            </div>
        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Main</li>
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                        </li>
						<li>
                            <a href="doctors.php"><i class="fa fa-user-md"></i> <span>Doctors</span></a>
                        </li>
                        <li class="active">
                            <a href="patients.php"><i class="fa fa-wheelchair"></i> <span>Patients</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Patients</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="add-patient.php" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Patient</a>
                    </div>
                </div>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-border table-striped custom-table datatable mb-0">
								<thead>
									<tr>
										<th>First Name</th>
										<th>Last Name</th>
										<th>Age</th>
										<th>Address</th>
										<th>Phone</th>
										<th>Email</th>
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									include('dbcon.php');

									$ref_table = "Patients";
									$fetchdata = $database->getReference($ref_table)->getValue();

									if($fetchdata > 0)
									{
										foreach($fetchdata as $key => $row)
										{
											?>
											<tr>
												<td><?= $row['firstname']; ?></td>
												<td><?= $row['lastname']; ?></td>
												<td><?= $row['age']; ?></td>
												<td><?= $row['address']; ?></td>
												<td><?= $row['phone']; ?></td>
												<td><?= $row['email']; ?></td>
												<td class="text-right">
													<div class="dropdown dropdown-action">
														<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="edit-patient.php?id=<?=$key;?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
															<a class="dropdown-item" href="#delete-patients" data-toggle="modal" data-target="#delete_patient"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
														</div>
													</div>
												</td>
									        </tr>
									        <?php
										}
									}
									else
									{
										?>
										<tr>
											<td clspan = "10"> no record found </td>
										</tr>
										<?php
									}
								?>  
								</tbody>
							</table>
						</div>
					</div>
                </div>
            </div>
        </div>
        <form action="patients.php" method="POST" id="delete-patients">
		<div id="delete_patient" class="modal fade delete-modal" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body text-center">
						<img src="assets/img/sent.png" alt="" width="50" height="46">
						<h3>Are you sure want to delete this Patient?</h3>
						<div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                            <input type="hidden" name="id_key" value="<?=$key?>" />
							<button type="submit" name="delete-patients" class="btn btn-danger">Delete</button>
						</div>
					</div>
				</div>
			</div>
			
		</div>
        </form>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- patients23:19-->
</html>