<?php
session_start();
$errmsg_arr = array();
$errflag = false;
// configuration
$dbhost 	= "localhost";
$dbname		= "tunahanc_Data";
$dbuser		= "root";
$dbpass		= "";

// database connection
$conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);

// new data

$user = $_POST['kullanici'];
$password = $_POST['sifre'];

if($user == '') {
    $errmsg_arr[] = 'You must enter your Username';
    $errflag = true;
}
if($password == '') {
    $errmsg_arr[] = 'You must enter your Password';
    $errflag = true;
}

// query
$result = $conn->prepare("SELECT * FROM Uyeler WHERE KullaniciAdi='{$user}' AND KullaniciSifre='{$password }'");
$result->execute();
$rows = $result->fetch(PDO::FETCH_NUM);
if($rows > 0) {
    header("location: adminAnasayfa.php");
}
else{
    $errmsg_arr[] = 'Username and Password are not found';
    $errflag = true;
}
if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    header("location: index.php");
    exit();
}

?>