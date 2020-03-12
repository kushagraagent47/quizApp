<?php 
session_start();
include "connection.php";
if (isset($_SESSION['id'])) {
	?>
	<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.min.css">
    <title>Score</title>
</head>
<body>
    <div class="container">
    <div class="jumbotron">
  <h1 class="display-3">Hello, <?php echo $_SESSION['email'];?></h1>
  <h3 >Your score is <font color="green"> <?php if (isset($_SESSION['score'])) {
echo $_SESSION['score']; 
}; ?></font></h3>
  <hr class="my-4">
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="logout.php" role="button">Log out</a>
  </p>
</div>
    </div>
</body>
</html>

		<?php 
		$score = $_SESSION['score'];
		$email = $_SESSION['email'];
		$query = "UPDATE users SET score = '$score' , verified='1' WHERE email = '$email'";
		$run = mysqli_query($conn , $query) or die(mysqli_error($conn));
 		?>


<?php unset($_SESSION['score']); ?>
<?php unset($_SESSION['time_up']); ?>
<?php unset($_SESSION['start_time']); ?>
<?php }
else {
	header("location: home.php");
}
?>

