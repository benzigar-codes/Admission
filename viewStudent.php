<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Student Details</title>
</head>

<body>
    <a href="index.php" class="p-4">Go Back</a>
    <?php
    if (isset($_GET['delete'])) {
        include('connection.php');
        $degree = $_GET['degree'];
        $name = $_GET['delete'];
        $sql = "delete from studentdetails where degree='$degree' and name='$name';";
        mysqli_query($connection, $sql);
    }
    if (isset($_GET['degree'])) {
        include('connection.php');
        $degree = $_GET['degree'];
        $sql = "SELECT * from studentdetails where degree='$degree' order by id;";
        $result = mysqli_query($connection, $sql);
        echo '
            <table class="table border mt-3">
                <tr>
                    <td>SI.NO</td>
                    <td>NAME</td>
                    <td>FEES PAID?</td>
                    <td>CERTIFICATE GIVEN?</td>
                    <td>STUDIED IN THIS COLLEGE?</td>
                    <td>Remove</td>
                </tr>        
        ';
        $counter = 1;
        while ($row = mysqli_fetch_array($result)) {
            echo '<tr>';
            echo '<td>' . $counter++ . '</td>';
            echo '<td>' . $row[1] . '</td>';
            echo '<td>' . (($row[2] == 1) ? 'Yes' : 'No') . '</td>';
            echo '<td>' . (($row[3] == 1) ? 'Yes' : 'No') . '</td>';
            echo '<td>' . (($row[4] == 1) ? 'Yes' : 'No') . '</td>';
            echo '<td>' . '<a href="viewStudent.php?delete=' . $row[1] . '&degree=' . $degree . '"><svg height=20 width=20 aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash" class="svg-inline--fa fa-trash fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="darkred" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path></svg></a>' . '</td>';
            echo '<tr>';
        }
        echo '</table>';
    }
    ?>

</body>

</html>