<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Admission</title>
</head>

<body class="bg-dark text-white">
    <!--Header-->
    <div class="d-flex align-items-center justify-content-between m-3">
        <div class="d-flex align-items-center">
            <img src="user-graduate-solid.svg" height=30 width=30 alt="">
            <h1 class="ml-3">Department</h1>
        </div>
        <div class="d-flex justify-content-end">
            <a href="addDepartment.php">
                <img class="m-4" src="plus-solid.svg" height="30" width="30" class="" alt="">
            </a>
        </div>
    </div>
    <?php
    include("connection.php");
    if (isset($_GET['deleteDepartment'])) {
        $depart = $_GET['deleteDepartment'];
        mysqli_query($connection, "DELETE FROM degreedetails where department='$depart';");
    }
    if (isset($_GET['deleteDegree'])) {
        $deg = $_GET['deleteDegree'];
        $selfaided = $_GET['selfaided'];
        $depart = $_GET['department'];
        mysqli_query($connection, "DELETE FROM degreedetails where name='$deg' and selfaided='$selfaided' and department='$depart';");
        mysqli_query($connection, "DELETE FROM studentdetails where degree='$deg' and selfaided='$selfaided' and department='$depart';");
    }
    $result = mysqli_query($connection, "SELECT DISTINCT department from degreedetails;");
    while ($departmentLoop = mysqli_fetch_array($result)) {
        echo '<div class="d-flex justify-content-center">
        <div class="col-lg-9 col-sm-12 col-md-10">
            <div class="card p-4 m-4 shadow text-dark m-sm-1 pd-sm-1">
                <!--Heading-->
                <div class="d-flex justify-content-around align-items-center">
                    <h3>' . $departmentLoop[0] . ' </h3>
                    <a href="index.php?deleteDepartment=' . $departmentLoop[0] . '">
                        <svg class="ml-3" height=30 width=30 aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash" class="svg-inline--fa fa-trash fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path fill="darkred" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path>
                        </svg>
                    </a>
                </div>
                <hr>
                <!--Degree-->
                <table class="table table-striped">
                    <tr>
                        <th>Degree</th>
                        <th>Total Seat</th>
                        <th>Taken Seat</th>
                        <th>Available Seat</th>
                        <th>Self/Aided</th>
                        <th>View</th>
                        <th>Add Student</th>
                        <th>Remove</th>
                    </tr>';
        $degreeLoopResult = mysqli_query($connection, "select name,seat,selfaided from degreedetails where department='$departmentLoop[0]';");
        while ($degreeLoop = mysqli_fetch_array($degreeLoopResult)) {
            $totalseat = $degreeLoop[1];
            $takenseat = mysqli_query($connection, "SELECT count(name) FROM `studentdetails` WHERE degree='" . $degreeLoop[0] . "';");
            $takenseat = mysqli_fetch_array($takenseat);
            $availableseat = $totalseat - $takenseat[0];
            echo '
                    <tr>
                        <th>' . $degreeLoop[0] . '</th>
                        <th>' . $degreeLoop[1] . '</th>
                        <th>' . $takenseat[0] . '</th>
                        <th>' . $availableseat . '</th>
                        <th>' . $degreeLoop[2] . '</th>
                        <th>
                            <a href="viewStudent.php?degree=' . $degreeLoop[0] . '">
                                <svg height=25 width=25 aria-hidden="true" focusable="false" data-prefix="fas" data-icon="external-link-alt" class="svg-inline--fa fa-external-link-alt fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <path fill="currentColor" d="M576 24v127.984c0 21.461-25.96 31.98-40.971 16.971l-35.707-35.709-243.523 243.523c-9.373 9.373-24.568 9.373-33.941 0l-22.627-22.627c-9.373-9.373-9.373-24.569 0-33.941L442.756 76.676l-35.703-35.705C391.982 25.9 402.656 0 424.024 0H552c13.255 0 24 10.745 24 24zM407.029 270.794l-16 16A23.999 23.999 0 0 0 384 303.765V448H64V128h264a24.003 24.003 0 0 0 16.97-7.029l16-16C376.089 89.851 365.381 64 344 64H48C21.49 64 0 85.49 0 112v352c0 26.51 21.49 48 48 48h352c26.51 0 48-21.49 48-48V287.764c0-21.382-25.852-32.09-40.971-16.97z"></path>
                                </svg>
                            </a>
                        </th>
                        <th>
                            <div class="d-flex justify-content-center">
                                <a href="addStudent.php?degree=' . $degreeLoop[0] . '">
                                    <svg height=25 width=25 aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" class="svg-inline--fa fa-plus fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path fill="black" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path>
                                    </svg>

                                </a>
                            </div>
                        </th>
                        <th>
                            <a href="index.php?deleteDegree=' . $degreeLoop[0] . '&selfaided=' . $degreeLoop[2] . '&department=' . $departmentLoop[0] . '">
                                <svg class="ml-3" height=25 width=25 aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash" class="svg-inline--fa fa-trash fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path fill="darkred" d="M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z"></path>
                                </svg>
                            </a>
                        </th>
                    </tr>';
        }
        echo  '
                </table>
                <!--Add Degree-->
                <div class="d-flex justify-content-end">
                    <div class="col-4 float-right">
                        <a href="addDegree.php?department=' . $departmentLoop[0] . '">
                            <button class="btn btn-primary">
                                Add Degree
                                <svg height=20 width=20 aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" class="svg-inline--fa fa-plus fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path class="ml-2" fill="white" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path>
                                </svg>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>';
    }
    ?>
</body>

</html>