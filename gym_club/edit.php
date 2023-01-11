<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "gym";

//create connection
$connection = new mysqli($servername, $username, $password, $database);

$id = "";
$name = "";
$email = "";
$phone = "";
$address = "";
$membership = "";
$gender = "";
$club = "";

$errorMessage = "";
$successMessage = "";


if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (!isset($_GET['id'])) {
        header("location: /gym_club/user.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM clients WHERE id=$id";//query
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if(!$row){

        header("location: /gym_club/user.php");
        exit;
    }

    $name = $row["name"];
    $email = $row["email"];
    $phone = $row["phone"];
    $address = $row["address"];
    $gender = $row["gender"];
    $membership = $row["membership"];
    $club = $row["club"];

  
}else{

    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];   
    $gender = $_POST["gender"];
    $membership = $_POST["membership"];
    $club = $_POST["club"];

    do {
        if(empty($id) || empty($name) || empty($email) || empty($phone) || empty($address) || empty($gender) || empty($membership) || empty($club)){
            $errorMessage = "ALL THE FIELDS ARE REQUIRED";
            break;
        } 

        $sql = "UPDATE clients" .
                " SET name= '$name', email= '$email', phone= '$phone', address= '$address', gender= '$gender', membership= '$membership', club= '$club'".
                " WHERE id=$id";

        $result = $connection->query($sql);

        if(!$result){
            $errorMessage = "INVALID QUERY" . $connection->error;
            break;
        }

        $successMessage = "CLIENT UPDATED SUCCESSFULLY";
        header("location: /gym_club/user.php");
        exit;

    }while (true);

    
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gym</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js">
    </script>

</head>
<body>
    <div class="container my-5">
        <h2>Update Membership</h2>
        <br>

        <?php
        if(!empty($errorMessage) ){
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }

        ?>

        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="name" placeholder="Enter Your Name" value="<?php echo $name; ?>">
            </div>
            </div>


            <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="email" placeholder="Enter Your Email" value="<?php echo $email; ?>">
            </div>
            </div>


            <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Phone</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="phone" placeholder="Enter Phone Number" value="<?php echo $phone; ?>">
            </div>
            </div>


            <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Address</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="address" placeholder="Enter Your Address" value="<?php echo $address; ?>">
            </div>
            </div>


            <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Membership</label>
            <div class="col-sm-6">
                <select id="membership" name="membership">
                <option value="" selected="selected">Select Membership</option>

                <option value="3 Months" 
                <?php if($row['membership'] == '3 Months'){
                echo "selected";
                } ?>
                >3 Months</option>

                <option value="6 Months" 
                <?php if($row['membership'] == '6 Months'){
                echo "selected";
                } ?>
                >6 Months</option>

                <option value="12 Months"
                <?php if($row['membership'] == '12 Months'){
                echo "selected";
                } ?>
                >12 Months</option>
</select>
            </div>
            </div>


            <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Gender</label>
            <div class="col-sm-6">
            <select id="gender" name="gender">
            <option value="" selected="selected">Gender</option>

            <option value="Female" 
                <?php if($row['gender'] == 'Female'){
                echo "selected";
                } ?>
                >Female</option>

                <option value="Male" 
                <?php if($row['gender'] == 'Male'){
                echo "selected";
                } ?>
                >Male</option>

                </select>
            </div>
            </div>


            <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Club Option</label>
            <div class="col-sm-6">
                <select id="club" name="club">
                    <option value="" selected="selected">Select Club</option>

                    <option value="Crunch Fitness"
                    <?php if($row['club'] == 'Crunch Fitness'){
                    echo "selected";
                    } ?>
                    >Crunch Fitness</option>

                    <option value="Anytime Fitness"
                    <?php if($row['club'] == 'Anytime Fitness'){
                    echo "selected";
                    } ?>
                    >Anytime Fitness</option>

                    <option value="LA Fitness"
                    <?php if($row['club'] == 'LA Fitness'){
                    echo "selected";
                    } ?>
                    >LA Fitness</option>

                    <option value="Life Time"
                    <?php if($row['club'] == 'Life Time'){
                    echo "selected";
                    } ?>
                    >Life Time</option>

    </select>
            </div>
            </div>

            <?php
            if(!empty($successMessage)){
                echo "
                <div class='row mb-3'>
                <div class='offset sm-3 col-sm-6'>
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                </div>
                </div>
                ";
            }

            ?>


            <div class="row mb-3">
            <label class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-primary">Update Data</button>
             </div>
            <div class="offset-sm-3 col-sm-3 d-grid">
                <a class="btn btn-outline-primary" href="/gym_club/user.php" role="button">Cancel</a>
                
            </div>
            </div>
        </form>

</div>
</body>
</html>
