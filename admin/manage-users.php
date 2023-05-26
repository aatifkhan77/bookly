<?php session_start();
include_once('../assets/php/database.php');

if (strlen($_SESSION['adminid'] == 0)) {
    header('location:logout.php');
} else {
    // for deleting user
    if (isset($_GET['id'])) {
        $adminid = $_GET['id'];
        $msg = mysqli_query($conn, "delete from candidate_detail where sno='$adminid'");
        if ($msg) {
            echo "<script>alert('Data deleted');</script>";
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Viewed Profiles</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="../assets/css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

    </head>

    <body class="sb-nav-fixed">
        <?php include_once('includes/navbar.php'); ?>
        <div id="layoutSidenav">
            <?php include_once('includes/sidebar.php'); ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Manage Candidates</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Manage CAndidates</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Viewed Candidate Details
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Sno.</th>
                                            <th>Full Name</th>
                                            <th>Email Id</th>
                                            <th>Gender</th>
                                            <th>Qualification</th>
                                            <th>Phone Number</th>
                                            <th>Address</th>
                                            <th>Pin Code</th>
                                            <th>Reg. Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        <?php
                                        $ret = mysqli_query($conn, "select * from candidate_detail");
                                        $cnt = 1;
                                        while ($row = mysqli_fetch_array($ret)) {
                                            if ($row['c_status'] == "yes") {
                                        ?>
                                                <tr>
                                                    <td><?php echo $cnt; ?></td>
                                                    <td><?php echo $row['fullname']; ?></td>
                                                    <td><?php echo $row['email']; ?></td>
                                                    <td><?php echo $row['gender']; ?></td>
                                                    <td><?php echo $row['qualification']; ?></td>
                                                    <td><?php echo $row['number']; ?></td>
                                                    <td><?php echo $row['address']; ?></td>
                                                    <td><?php echo $row['code']; ?></td>
                                                    <td><?php echo $row['date_time']; ?></td>
                                                    <td>

                                                        <a href="user-profile.php?uid=<?php echo $row['sno']; ?>">
                                                            <i class="fas fa-edit"></i></a>
                                                        <a href="manage-users.php?id=<?php echo $row['sno']; ?>" onClick="return confirm('Do you really want to delete');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                        <?php $cnt = $cnt + 1;
                                            }
                                        } ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <?php include('./includes/footer.php'); ?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="../assets/js/datatables-simple-demo.js"></script>
    </body>

    </html>
<?php } ?>