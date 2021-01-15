<?php
session_start();
if(!isset($_SESSION['stid'])) {
    header("Location: index.php?staff");
}

include ('pages/queries.php');
$obj = new DocQuery;

include ('pages/otherquery.php');
$ooq = new OtherQuery;

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Lecturer - Academic Document Sharing</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/docmis.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">

        <!-- Header -->
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.html">Lecturer.Home</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>

            <?php include('pages/staff_header.php'); ?>
        </nav>
        <!-- %Header -->


        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Upload</div>
                            <a class="nav-link collapsed" href="staff_homelect.php?uploadmd" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Modules
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>

                            <a class="nav-link collapsed" href="staff_homelect.php?uploadas" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Assignments
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
							
							<a class="nav-link collapsed" href="staff_homelect.php?uploadnt" data-target="#collapsePages" aria-expanded="" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Announcements
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
							
                            <div class="sb-sidenav-menu-heading">Actions</div>
                            <a class="nav-link" href="staff_homelect.php?uploadmk">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Submit Marks to HoD
                            </a>

                            <a class="nav-link" href="staff_homelect.php?vcom">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                View comments
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:
                            <a class="text-danger" href="staff_homelect.php?logout">Logout</a>
                            <?php
                               if(isset($_GET['logout'])) {
                                session_start();
                                session_destroy();
                                // header("Location: index.php?staff");
                               }
                            ?>
                        </div>
                        <div class="text-success"><?php echo $_SESSION['stuser']; ?></div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">

                        <?php if(isset($_GET['welcome'])) { ?>
                        <h1 class="mt-2 mt-5">Welcome again</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"><b><?php echo $_SESSION['stuser']; ?></b>, You are successfully logged in!</li>
                        </ol>
                        <?php } ?>




                        <?php
                            if(isset($_GET['uploadmd'])) {
                                if(isset($_POST['add_module'])) {
                                            
                                    if($ooq->uploadModules($_POST['mname'], $_FILES['mfile']['name'], $_FILES['mfile']['tmp_name'], $_POST['mcode'], $_SESSION['stid'], $_POST['Dept_ID'])) {
                                    echo "<script>alert('Module is added successfully!');</script>";
                                    echo "<script>window.location='staff_homelect.php?uploadmd';</script>";
                                                
                                } else {
                                    echo "<script>alert('Module is not added!');</script>";
                                    echo "<script>window.location='staff_homelect.php?uploadmd';</script>";
                                }
                            }
                        ?>
                                <div class="card shadow-lg border-0 rounded-lg mt-3">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Upload Modules</h3></div>
                                    <div class="card-body">
                                        <form method="POST" enctype="multipart/form-data">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Module Name</label>
                                                        <input class="form-control py-2" id="inputFirstName" type="text" name="mname" placeholder="Enter ModuleName" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="mcode">Module code</label>
                                                        <input class="form-control py-2" id="mcode" type="text" name="mcode" aria-describedby="mcode" placeholder="Module code" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            


                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputmfile">Module File</label><br>
                                                        <input type="file" id="inputmfile" class="btn-success" name="mfile" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="SelectDept">Select Department</label>
                                                <select class="form-control py-2" id="SelectDept" name="Dept_ID" required/>
                                                <?php
                                                $stmt = $obj->viewDepartments();
                                                    while($row = $stmt->FETCH(PDO::FETCH_ASSOC)){ 
                                                ?>
                                                <option value="<?php echo $row['Dept_ID']; ?>"><?php echo $row['DeptName']; ?></option>
                                                <?php } ?>
                                                    
                                                </select>                                                        
                                                    </div>
                                                </div>
                                            </div>
 

                                            
                                            <div class="form-group mt-4 mb-0"><button type="submit" class="btn btn-primary btn-block" name="add_module">Upload</button></div>
                                        </form>
                                    </div>
                                </div>
                            <?php } ?>










                        <?php
                            if(isset($_GET['uploadmk'])) {
                                if(isset($_POST['add_marks'])) {
                                            
                                    if($ooq->uploadMarks($_POST['Mod_ID'], $_FILES['marks']['name'], $_FILES['marks']['tmp_name'], $_SESSION['stid'])) {
                                    echo "<script>alert('Marks uploaded successfully!');</script>";
                                    echo "<script>window.location='staff_homelect.php?uploadmk';</script>";
                                                
                                } else {
                                    echo "<script>alert('Marks not uploaded!');</script>";
                                    echo "<script>window.location='staff_homelect.phpuploadmk';</script>";
                                }
                            }
                        ?>
                                <div class="card shadow-lg border-0 rounded-lg mt-3">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Upload Marks</h3></div>
                                    <div class="card-body">
                                        <form method="POST" enctype="multipart/form-data">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Module Name</label>
                                                <select class="form-control py-2" id="SelectDept" name="Mod_ID" required/>
                                                <?php
                                                $stmt3 = $obj->readModules();
                                                    while($row3 = $stmt3->FETCH(PDO::FETCH_ASSOC)){ 
                                                ?>
                                                <option value="<?php echo $row3['Mod_ID']; ?>"><?php echo $row3['Mname']; ?></option>
                                                <?php } ?>
                                                    
                                                </select> 
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputmfile">Browse marks</label><br>
                                                        <input type="file" id="inputmfile" class="btn-primary" name="marks" required>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputmfile"></label>
                                                        <button type="submit" class="btn btn-success btn-block smwidth" name="add_marks">Upload</button>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputmfile"></label>
                                                        <input type="reset" value="Cancel" class="btn btn-danger btn-block smwidth" name="add_marks">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <?php } ?>












                        <?php
                            if(isset($_GET['uploadnt'])) {
                                if(isset($_POST['add_notice'])) {
                                            
                                    if($ooq->upload_announcement($_POST['title'], $_POST['announcem'], $_SESSION['stid'])) {
                                    echo "<script>alert('Announcement added successfully!');</script>";
                                    echo "<script>window.location='staff_homelect.php?uploadnt';</script>";
                                                
                                } else {
                                    echo "<script>alert('Announcement not uploaded!');</script>";
                                    echo "<script>window.location='staff_homelect.php?uploadnt';</script>";
                                }
                            }
                        ?>
                                <div class="card shadow-lg border-0 rounded-lg mt-3">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Add Announcement</h3></div>
                                    <div class="card-body">
                                        <form method="POST">
                                            <div class="form-row">
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="AnTitle">Announcement Title</label>
                                                        <input class="form-control py-2" id="AnTitle" type="text" name="title" placeholder="Enter Title" required />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col-md-9">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputarea">Type Announcement</label><br>
                                                        <textarea id="inputarea" class="text-success" name="announcem" cols="100" rows="8" required></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputmfile"></label>
                                                        <button type="submit" class="btn btn-success btn-block smwidth" name="add_notice">Save</button>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputmfile"></label>
                                                        <input type="reset" value="Cancel" class="btn btn-danger btn-block smwidth">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            <?php } ?>















                        <?php
                            if(isset($_GET['uploadas'])) {
                                if(isset($_POST['add_ass'])) {
                                            
                                    if($ooq->uploadAssignment($_POST['Mod_ID'], $_FILES['assignment']['name'], $_FILES['assignment']['tmp_name'], $_POST['ass_title'], $_SESSION['stid'], $_POST['Dept_ID'])) {

                                    echo "<script>alert('Assignment uploaded successfully!');</script>";
                                    echo "<script>window.location='staff_homelect.php?uploadas';</script>";
                                                
                                } else {
                                    echo "<script>alert('Assignment not uploaded!');</script>";
                                    echo "<script>window.location='staff_homelect.php?uploadas';</script>";
                                }
                            }
                        ?>
                                <div class="card shadow-lg border-0 rounded-lg mt-3">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Upload Assignment</h3></div>
                                    <div class="card-body">
                                        <form method="POST" enctype="multipart/form-data">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">Module Name</label>
                                                <select class="form-control py-2" id="SelectDept" name="Mod_ID" required/>
                                                <?php
                                                $stmt3 = $obj->readModules();
                                                    while($row3 = $stmt3->FETCH(PDO::FETCH_ASSOC)){ 
                                                ?>
                                                <option value="<?php echo $row3['Mod_ID']; ?>"><?php echo $row3['Mname']; ?></option>
                                                <?php } ?>
                                                    
                                                </select> 
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputafile">Assignment File</label><br>
                                                        <input type="file" id="inputafile" class="btn-warning" name="assignment" required>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="asstitle">Assignment Title</label>
                                                        <input class="form-control py-2" id="asstitle" type="text" name="ass_title" placeholder="Assignment Title" required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="SelectDept">Your Department</label>
                                                <select class="form-control py-2" id="SelectDept" name="Dept_ID" required/>
                                                <?php
                                                $stmt = $obj->viewDepartments();
                                                    while($row = $stmt->FETCH(PDO::FETCH_ASSOC)){ 
                                                ?>
                                                <option value="<?php echo $row['Dept_ID']; ?>"><?php echo $row['DeptName']; ?></option>
                                                <?php } ?>
                                                    
                                                </select>     
                                                    </div>
                                                </div>
                                            </div>                                            
                                            
                                            <div class="form-group mt-4 mb-0"><button type="submit" class="btn btn-success btn-block" name="add_ass">Upload</button></div>
                                        </form>
                                    </div>
                                </div>
                            <?php } ?>










                        <?php
                            if(isset($_GET['vcom'])) { 
                        ?>            

                         <div class="card mb-4 mt-5">
                            <h3 class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                View All Student Comments
                            </h3>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Comment</th>
                                                <th>Written By:</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            <tr>
                                                <td>Ndimo ndareclama amanota mwanyibye muri Php</td>
                                                <td>Gad IRADUFASHA</td>
                                                <td><a href="#" class="btn btn-danger btn-block">Delete</a></td>
                                            </tr>
                                         
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php } ?>






                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Document sharing 2020</div>
                            <div>
                                <a href="#">Made by</a>
                                &middot;
                                <a href="#">Joseph & Joyce </a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>
