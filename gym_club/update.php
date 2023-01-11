<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "gym";

//create connection
$connection = new mysqli($servername, $username, $password, $database);


$name = "";
$email = "";
$phone = "";
$address = "";
$membership = "";
$gender = "";
$club = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'POST'){
$name = $_POST['name'];
$email =  $_POST['email'];
$phone = $_POST['phone'];
$address =  $_POST['address'];
$membership =  $_POST['membership'];
$gender =  $_POST['gender'];
$club =  $_POST['club'];

    do {
        if(empty($name) || empty($email) || empty($phone) || empty($address) || empty($membership) 
        || empty($gender) || empty($club)){
            $errorMessage = "ALL THE FIELDS ARE REQUIRED";
            break;
        }

        //add new members to database
        $sql= "INSERT INTO clients(name, email, phone, address, membership, gender, club) " .
        "VALUES ('$name','$email','$phone','$address','$membership','$gender','$club')";
        $result = $connection->query($sql);

        if(!$result){
            $errorMessage = "INVALID QUERY: " . $connection->error;
            break;
        }


        $name = "";
        $email = "";
        $phone = "";
        $address = "";
        $membership = "";
        $gender = "";
        $club = "";

        $successMessage = "MEMBERS REGISTERED";

        header("location: /gym_club/user.php");
        exit;

    } while (false);
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
            <input tpye="hidden" value="<?php echo $id; ?>">
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
                <option value="3 Months" >3 Months</option>
                <option value="6 Months" >6 Months</option>
                <option value="12 Months" >12 Months</option>
</select>
            </div>
            </div>


            <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Gender</label>
            <div class="col-sm-6">
                <input type="radio" name="gender" value="Male" required/>Male
                <br>
                <input type="radio" name="gender" value="Female" required/>Female

            </div>
            </div>


            <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Club Option</label>
            <div class="col-sm-6">
                <select id="club" name="club">
                    <option value="">Select Club</option>
                    <option value="Crunch Fitness">Crunch Fitness</option>
                    <option value="Anytime Fitness">Anytime Fitness</option>
                    <option value="LA Fitness">LA Fitness</option>
                    <option value="Life Time">Life Time</option>
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
                <button type="submit" class="btn btn-primary">Update Member</button>
             </div>
            <div class="offset-sm-3 col-sm-3 d-grid">
                <a class="btn btn-outline-primary" href="/gym_club/user.php" role="button">Cancel</a>
                
            </div>
            </div>
        </form>

</div>
</body>
</html>
