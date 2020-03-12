<?php
$connect = mysqli_connect("localhost","root", "", "php-kuiz");
$output = '';
if(isset($_POST["import"]))
{
    $tmp = explode('.', $_FILES["excel"]["name"]);
 $extension = end($tmp);
 // For getting Extension of selected file
 $allowed_extension = array("xls", "xlsx", "csv"); //allowed extension
 if(in_array($extension, $allowed_extension)) //check selected file extension is present in allowed extension array
 {
  $file = $_FILES["excel"]["tmp_name"]; // getting temporary source of excel file
  include("PHPExcel/IOFactory.php"); // Add PHPExcel Library in this code
  include('PHPExcel/PHPExcel.php');

  $objPHPExcel = PHPExcel_IOFactory::load($file); // create object of PHPExcel library by using load() method and in load method define path of selected file

  $output .= "<label class='text-success'>Data Inserted</label><br /><table class='table table-bordered'>";
  foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
  {
   $highestRow = $worksheet->getHighestRow();
   for($row=2; $row<=$highestRow; $row++)
   {
    $output .= "<tr>";
    $email = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(0, $row)->getValue());
    $password = mysqli_real_escape_string($connect, $worksheet->getCellByColumnAndRow(1, $row)->getValue());
    
  
   
   }
  } 
  $output .= '</table>';

 }
 else
 {
  $output = '<label class="text-danger">Invalid File</label>'; //if non excel file then
 }
}
?>

<html>
 <head>
  <title>Import Excel to Mysql using PHPExcel in PHP</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
  <style>
  body
  {
   margin:0;
   padding:0;
   background-color:#f1f1f1;
  }
  .box
  {
   width:700px;
   border:1px solid #ccc;
   background-color:#fff;
   border-radius:5px;
   margin-top:100px;
  }
  
  </style>
 </head>
 <body>
 <div class="container box">
 <a href="../admin/index.php">Go To Home Page</a>

   <h3 align="center">Upload Time Table</h3><br />
   <form method="post" action="upload_time_table.php" enctype="multipart/form-data">
    <label>Upload Time Table</label>
    <input type="file" name="fileToUpload" id="fileToUpload">
    <br>



<br>
<br>
    <select name="branch">
  <option value="cse">CSE</option>
  <option value="ece">ECE</option>
  <option value="civil">Civil</option>
  <option value="it">IT</option>
  <option value="mba">MBA</option>
  <option value="mtech">M.Tech</option>

</select>
<br><br>
<select name="sec">
  <option value="a">Section "A"</option>
  <option value="b">Section "B"</option>
  <option value="c">Section "C"</option>
  <option value="d">Section "D"</option>
</select>

    <br />
    <br>
    <input type="submit" name="upload_time_table" class="btn btn-info" value="Import" />
   </form>
   <br />
   <br />
   <?php
   echo $output;
   ?>
  </div>
  <div class="container box">
   <h3 align="center">Upload Semester Result</h3><br />
   <form method="post" enctype="multipart/form-data">
    <label>Select Excel File</label>
    <input type="file" name="excel" /><br>
    <br />
    <br>
    <input type="submit" name="import" class="btn btn-info" value="Import" />
   </form>
   <br />
   <br />
   <?php
   echo $output;
   ?>
  </div>

 </body>
</html