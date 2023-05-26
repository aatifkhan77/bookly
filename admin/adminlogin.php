<?php session_start();
include_once('../assets/php/database.php');

// Code for login 
if (isset($_POST['login'])) {
    $adminusername = $_POST['username'];
    $pass = md5($_POST['password']);
    $ret = mysqli_query($conn, "SELECT * FROM admin WHERE username='$adminusername' and password='$pass'");
    $num = mysqli_fetch_array($ret);
    if ($num > 0) {
        $extra = "dashboard.php";
        $_SESSION['login'] = $_POST['username'];
        $_SESSION['adminid'] = $num['id'];
        echo "<script>window.location.href='" . $extra . "'</script>";
        exit();
    } else {
        echo "<script>alert('Invalid username or password');</script>";
        $extra = "index.php";
        echo "<script>window.location.href='" . $extra . "'</script>";
        exit();
    }
}
?>