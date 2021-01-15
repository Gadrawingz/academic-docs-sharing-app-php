<?php
include ('pages/queries.php');
$obj = new DocQuery;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Academic Document Sharing System</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Staff member</h3></div>
                                    <div class="card-body">
									
									
									    <?php
										if(isset($_POST['add_data'])) {
											// if(!empty($_POST['staff_name']) && !empty($_POST['email']) && !empty($_POST['user_type']) && !empty($_POST['dept_ID']) && !empty($_POST['password'])) {
												
												if($obj->addStaffMember($_POST['staff_name'], $_POST['email'], $_POST['user_type'], $_POST['Dept_ID'], $_POST['password'])) {
													echo "<script>alert('StaffMember added successfully!');</script>";
													echo "<script>window.location='staff_home.php';</script>";
												
											} else {
											    echo "<script>alert('StaffMember Not added!');</script>";
											    echo "<script>window.location='staff_home.php';</script>";
											}
										}
										?>
										
                                        <form method="POST" action="">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Staff Name</label>
                                                        <input class="form-control py-2" id="inputFirstName" type="text" name="staff_name" placeholder="Enter staffName" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
													<div class="form-group">
														<label class="small mb-1" for="inputEmailAddress">Email</label>
														<input class="form-control py-2" id="inputEmailAddress" type="email" name="email" aria-describedby="emailHelp" placeholder="Enter email address" />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="usertype">User type</label>
														<select class="form-control py-2" id="usertype" name="user_type" />
														<option value="DAS">DAS</option>
														<option value="HOD">HOD</option>
														<option value="Lecturer">Lecturer</option>				
														</select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
													<div class="form-group">
                                                <label class="small mb-1" for="deptid">Department ID</label>
                                                <select class="form-control py-2" id="deptid" name="Dept_ID" />
												<?php
												
												$stmt = $obj->viewDepartments();
													while($row = $stmt->FETCH(PDO::FETCH_ASSOC)){ 
												?>
												
												<option value="<?php echo $row['Dept_ID']; ?>"><?php echo $row['Dept_ID']; ?></option>
												
												<?php } ?>
													
												</select>
                                            </div>
                                                </div>
                                            </div>

											
											<div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-2 input-color" id="inputPassword" type="password" name="password" placeholder="Enter password" />
                                            </div>
											
                                            <div class="form-group mt-4 mb-0"><button type="submit" class="btn btn-primary btn-block" name="add_data">Save</button></div>
                                        </form>
                                    </div>
									
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Document sharing 2020</div>
                            <div>
                                <a href="#">Made by</a>
                                &middot;
                                <a href="#">Joseph & Joyce Rihanna</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
