<?php
session_start();
$adminstatus = $_SESSION['admin'];

$loginstatus = $_SESSION['loginstatus'];



require 'style.php';

if ($loginstatus != true) {
    header("Location: /index.php");
    exit();
}

if (isset($_POST['logout'])) {

    session_destroy();
    unset($loginstatus);
    header('Location: /index.php');
}





?>

<html>

<head>

    <nav class="navbar sticky-top navbar-dark bg-dark">
        <div class="btn-group" role="group" aria-label="Basic example">
            <a href="#section1"><button type="button" class="btn btn-primary">Admin Dashboard</button></a>
            <a href="#section2"><button type="button" class="btn btn-success">Import Students</button></a>
            <a href="#section3"><button type="button" class="btn btn-secondary">Voting info</button></a>
            <div class="logout">
                <form method="post">
                    <button type="submit" name="logout" value="logout" class="btn btn-danger">Logout</button>

                </form>
            </div>
        </div>
    </nav>


</head>

<body>




    <div class="main" id="section1">
        <div class="jumbotron">
            <div class="titletext">
                <h1>Admin dashboard</h1>
            </div>
        </div>
    </div>

    <div class="sizedbox"></div>

    <div class="main" id="section2">
        <div class="jumbotron">
            <div class="titletext">
                <h1>Import Pelajar dan Calon (.csv)</h1>
            </div>
            <center>
                <div>
                    <a href="/csvuploadstudent.php"><button type="button" class="btn btn-info">Pelajar</button></a>
                    <a href="/csvuploadcandidate.php"><button type="button" class="btn btn-info">Calon</button></a>
                </div>
            </center>
        </div>
    </div>





    <div class="sizedbox"></div>


    <div class="main" id="section3">
        <div class="jumbotron">
            <div class="titletext">
                <h1>Voting info</h1>
            </div>

        </div>
    </div>
</body>

</html>




<style>
    html {
        scroll-behavior: smooth;
    }

    .sizedbox {
        height: 100px;
    }

    .titletext {
        text-align: center;
    }

    .logout {
        position: absolute;

        left: 1400px;
    }
</style>