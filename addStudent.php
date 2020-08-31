<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Add Student</title>
</head>

<body>
    <?php
    if (isset($_POST['submit'])) {
        if ($_POST['Name'] != '' && $_POST['degree'] != '') {
            include('connection.php');
            $name = $_POST['Name'];
            $degree = $_POST['degree'];
            $fees = (isset($_POST['Fees'])) ? '1' : '0';
            $certificates = (isset($_POST['Certificates'])) ? '1' : '0';
            $currentcollege = (isset($_POST['CurrentCollege'])) ? '1' : '0';
            $sql = "INSERT INTO `studentdetails` (`id`, `name`, `fees`, `currentCollge`, `certificate`, `degree`) VALUES (NULL, '$name', '$fees', '$currentCollge', '$certificates', '$degree');";
            mysqli_query($connection, $sql);
            header("Location: index.php");
        }
    }
    ?>
    <div class="d-flex m-4">
        <a href="index.php">
            <svg height=30 width=30 aria-hidden="1" focusable="0" data-prefix="far" data-icon="arrow-alt-circle-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-arrow-alt-circle-left fa-w-16">
                <path fill="black" d="M8 256c0 137 111 248 248 248s248-111 248-248S393 8 256 8 8 119 8 256zm448 0c0 110.5-89.5 200-200 200S56 366.5 56 256 145.5 56 256 56s200 89.5 200 200zm-72-20v40c0 6.6-5.4 12-12 12H256v67c0 10.7-12.9 16-20.5 8.5l-99-99c-4.7-4.7-4.7-12.3 0-17l99-99c7.6-7.6 20.5-2.2 20.5 8.5v67h116c6.6 0 12 5.4 12 12z" class=""></path>
            </svg>
        </a>
    </div>
    <?php
    if (isset($_GET['degree'])) {
        ?>
        <form action="addStudent.php" method="post" class="from-control m-4 p-4">
            <h3>Add Student,, in <?php echo $_GET['degree'] ?></h3>
            <label for="Full Name">Enter the Full Name with initial, ,</label>
            <input type="text" name="Name" id="" class="form-control">
            <div class="mt-3 mb-3">
                <input type="checkbox" name="Fees" id=""> Fees Paid? <br>
                <input type="checkbox" name="CurrentCollege" id=""> Studied in Current College? <br>
                <input type="checkbox" name="Certificates" id=""> Certificated properly given?? <br>

            </div>
            <input type="hidden" name="degree" value="<?php echo $_GET['degree'] ?>">
            <input type="submit" name="submit" value="Add Student" class="btn btn-primary">
        </form>
    <?php
    } else {
        echo '<h3 class="m-4">Something went wrong,,  Please Go back,, :( </h3>';
    }
    ?>
</body>

</html>