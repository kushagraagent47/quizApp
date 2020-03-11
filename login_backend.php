<?php
session_start();
include 'db.php';
$user_count = 0;
$email = $_POST['email'];
$password = $_POST['password'];
$query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
$results = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($results)) {
$email = $row['email'];
$password = $row['password'];
$verify = $row['verified'];
$user_count = $user_count + 1;
$id = $row['id'];
}
    if($verify > 0){
        ?>
        <script>
        alert("you have already completed this game");
        window.location.href = 'index.php'
        </script>
<?php
// header("location: index.php");
?>
<?php
    } else {
    if($user_count > '0'){
        $_SESSION['email'] = $email;
  $_SESSION['password'] = $password;
    $update = "UPDATE users SET played_on = '$played_on' WHERE email = '$email' ";
    $runupdate = mysqli_query($conn , $update) or die(mysqli_error($conn));
        $_SESSION['id'] = $id;
        $_SESSION['email'] = $email;
    header("location: quiz/home.php");
}else {
  ?>
  <script>
  window.location.href = 'index.php'
  </script>
<?php 
    
?>
    <script>
        alert("WRONG PASSWORD");
    </script>
<?php
}
    }
  