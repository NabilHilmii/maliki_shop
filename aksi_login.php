<?php
session_start();
include "connection.php";
$user = $_POST['username'];
$psw = $_POST['password'];
$op = $_GET['op'];
if($op=="in"){
    $sql="SELECT * FROM user where username='$user' AND password='$psw'";
    $query = $koneksi->query($sql);
    if(mysqli_num_rows($query)==1){
        $data = $query->fetch_array();
        $_SESSION['username'] = $data['username'];
        $_SESSION['role'] = $data['role'];
        if($data['role']=="admin"){
            header("location: dashboard.php");
        }else if($data['role']=="user"){
            header('location: dashboard.php');        
        }else if($data['role']=="seller"){
            header('location: dashboard.php');
        }else{
            die("password salah <a href=\"javascript:history.back()\">kembali</a>");
        }
    }
}else if($op=="out"){
    unset($_SESSION['username']);
    unset($_SESSION['role']);
    header('location:login.php');
}
?>