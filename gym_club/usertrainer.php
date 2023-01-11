<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gym</title>
 
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
  
  </head>
  <body>
    <div class="container my-5"> 
      <h2 align="center">Display List of Trainer</h2><br>
      <a class="btn btn-primary btn-pink" href="/gym_club/createtrainer.php" role="button">Register Trainer</a><br>
      <br>
      <table border="3" cellspacing="7" width="100%" >
      
          <tr>
            <th width="10%">ID</th>
            <th width="10%">Name</th>
            <th width="20%">Email</th>
            <th width="10%">Phone</th>
            <th width="25%">Address</th>
            <th width="10%">Gender</th>
            <th width="20%">Membership</th>
            <th width="20%">Club Option</th >
</tr>
</head>
<tbody>

  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "gym";
  
  //create connection
$connection = new mysqli($servername, $username, $password, $database);

  //check connection
  if($connection->connect_error){
    die("Connection failed: " . $connection->connect_error);
  }

  //read row database
$sql = "SELECT * FROM trainers";
  $result = $connection->query($sql);

  if(!$result){
    die("Invalid query: " . $connection->error);
  }
  while($row = $result->fetch_assoc()){
    echo "
    <tr>
    <td>$row[id]</td>
    <td>$row[name]</td>
    <td>$row[email]</td>
    <td>$row[phone]</td>
    <td>$row[address]</td>
    <td>$row[gender]</td>
    <td>$row[membership]</td>
    <td>$row[club]</td>
    <td>
    <a class='btn btn-primary btn-sm' href='/gym_club/edittrainer.php?id=$row[id]'>Update</a>
    <a class='btn btn-danger btn-sm' href='/gym_club/deletetrainer.php?id=$row[id]'>Delete</a>
    </td>

    ";
  }
?>

   
  </body>
</html>