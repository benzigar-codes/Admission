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
        if ($_POST['department'] != '' && $_POST['DegreeName'] != '') {
            include('connection.php');
            $department = $_POST['department'];
            $degree = $_POST['DegreeName'];
            $selfaided = $_POST['self/aided'];
            $seat = $_POST['seat'];
            $sql = "INSERT INTO `degreedetails` (`id`, `name`, `department`, `seat`, `selfaided`) VALUES (NULL, '$degree', '$department', $seat, '$selfaided');";
            mysqli_query($connection, $sql);
            header("Location: index.php");
        }
    }
    ?>
    <div class="d-flex m-4">
        <a href="index.php">
            <svg height=30 width=30 aria-hidden="true" focusable="false" data-prefix="far" data-icon="arrow-alt-circle-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-arrow-alt-circle-left fa-w-16">
                <path fill="black" d="M8 256c0 137 111 248 248 248s248-111 248-248S393 8 256 8 8 119 8 256zm448 0c0 110.5-89.5 200-200 200S56 366.5 56 256 145.5 56 256 56s200 89.5 200 200zm-72-20v40c0 6.6-5.4 12-12 12H256v67c0 10.7-12.9 16-20.5 8.5l-99-99c-4.7-4.7-4.7-12.3 0-17l99-99c7.6-7.6 20.5-2.2 20.5 8.5v67h116c6.6 0 12 5.4 12 12z" class=""></path>
            </svg>
        </a>
    </div>
    <form action="" method="post" class="from-control m-4 p-4">
        <h3>Add Degree,, <?php echo $_GET['department'] ?></h3>
        <label class="mt-3" for="Full Name">Enter the Degree Name, ,</label>
        <input type="text" name="DegreeName" id="" class="form-control">
        <label class="mt-3" for="self/aided">Select the self/aided ,, </label>
        <select class="form-control mb-3" name="self/aided" id="">
            <option value="Self">Self</option>
            <option value="Aided">Aided</option>
        </select>
        <label for="seats">Enter the no of seats , , </label>
        <input type="number" name="seat" id="" class="form-control">
        <input type="hidden" name="department" value="<?php echo $_GET['department'] ?>">
        <input type="submit" name="submit" value="Add Degree" class="mt-3 btn btn-primary">
    </form>
</body>

</html>