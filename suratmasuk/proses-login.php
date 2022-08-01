<?php 
include "../database/db.php";
session_start();

if (isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = mysqli_query($conn,"select * from user where username='$username' and password='$password'");
    $hitung = mysqli_num_rows($query);
    $_SESSION["user"] = true;
    if($hitung > 0){
        //Data ditemukan
        $ambildatarole = mysqli_fetch_array($query);
        $role = $ambildatarole['role'];
        if(isset($role)){
            $_SESSION['log'] = 'Logged';
            $_SESSION['role'] = $role;
            $_SESSION['query'] = "WHERE diteruskan LIKE '%".$role."%'";


            echo "<script>location.href=\"admin.php\";</script>";

        }
        // if($role == 'admin'){
        //     $_SESSION['log'] = 'Logged';
        //     $_SESSION['role'] = 'admin';
        //     echo "<script>location.href=\"admin.php\";</script>";
        // }else if($role == 'kepala'){
        //     $_SESSION['log'] = 'Logged';
        //     $_SESSION['role'] = 'kepala';
        //     echo "<script>location.href=\"kepala.php\";</script>";
        // }else if($role == 'kstu'){
        //     $_SESSION['log'] = 'Logged';
        //     $_SESSION['role'] = 'kstu';
        //     echo "<script>location.href=\"koorbid.php\";</script>";
        // }else if($role == 'kdat'){
        //     $_SESSION['log'] = 'Logged';
        //     $_SESSION['role'] = 'kdat';
        //     echo "<script>location.href=\"koorbid.php\";</script>";
        // }else if($role == 'kobs'){
        //     $_SESSION['log'] = 'Logged';
        //     $_SESSION['role'] = 'kdat';
        //     echo "<script>location.href=\"koorbid.php\";</script>";
        // }else if($role == 'ppk'){
        //     $_SESSION['log'] = 'Logged';
        //     $_SESSION['role'] = 'kdat';
        //     echo "<script>location.href=\"koorbid.php\";</script>";
        // }else if($role == 'operator'){
        //     $_SESSION['log'] = 'Logged';
        //     $_SESSION['role'] = 'operator';
        //     echo "<script>
        //     location.href=\"admin.php\"
        //     ;</script>";
        }else{
            echo "<script type ='text/javascript'>alert('Username atau Password salah');
        location.href=\"login.php\"
        ;</script>";
        }
    }else{

        echo "<script type ='text/javascript'>alert('Username atau Password salah');
        location.href=\"login.php\"
        ;</script>";
    }
    
    // if(mysqli_num_rows($query) !== 0){
    //     $_SESSION["user"] = $query->fetch_assoc();
    //     header("location:index.php");

    // }else{
    //     echo '<script>alert("LOGIN GAGAL");location.href="login.php"</script>';
    // }
    // }else{
    // header("location:login.php?pesan=gagal");

?>