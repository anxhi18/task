<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
  <script src="../vendor/jquery/jquery.min.js" type="text/javascript"></script>
  <script src="../vendor/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <style>
      
 
  </style>
</head>
<body>
    <?php include '../databaseConn/conn.php' ?>

<div class="container">
  <h2>Admin Page</h2>
  <a type="button" id='delete' class="btn" style="background-color: red; color: white" href="adminpage.php?delete='1'">Delete User</a>
  <a type="button" style="background-color: green ; color: white" class="btn" href="adminpage.php?update='1'">Update User</a>
  
  <p></p>            
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Username</th>
        <th>Email</th>
        <th>Status</th>
        <th>Active_User</th>
        <th>Registration_Date</th>
        <th>Password</th>
        
      </tr>
    </thead>
    <tbody><?php
  
    $sql = "SELECT * from users "; 
       $result = mysqli_query($conn,$sql);
       foreach ($result as $row){
    ?>
      <tr>
          <td><?php echo $row['username']; ?></td>
          <td><?php echo $row['email']; ?></td>
          <td><?php echo $row ['status']; ?></td>
          <td><?php echo $row['active_user']; ?></td>
          <td><?php echo $row['dataregjistrimit_regdt']; ?></td>
          <td><?php echo $row ['password']; ?></td>
     </tr>
       <?php } ?>
    </tbody>
  </table>
</div>
<?php
if(isset($_GET['delete'])){
$sql = "DELETE FROM users ";

if ($conn->query($sql) === TRUE) {
  echo "Record deleted successfully";
} else {
  echo "Error deleting record: " . $conn->error;
}
    
}

if(isset($_GET['update'])){
    
    
$sql = "UPDATE users SET status='disable' WHERE email='anxhela.mullalli@gmail.com'";

if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}
}


?>
</body>
</html>


