<?php
//Dont allow anyone to enter directly
session_start();

$whereusercomefrom = $_SERVER['HTTP_REFERER'];
$_SESSION['admin'] = "0";

$loggedin = false;





require 'style.php';

//Info from User input

$noicmasuk = $_POST["noic"];

if (isset($noicmasuk)) {
    $_SESSION["noicmasuk"] = $noicmasuk;
}


// Info from DB IC CHECK AND ADMIN CHECK ONLY

$con = mysqli_connect("localhost", "root", "", "voting");

$sqliccommand = "SELECT * FROM users WHERE noic = '$noicmasuk'";


$sqlicqueryresult = mysqli_query($con, $sqliccommand);

$rowic = mysqli_fetch_array($sqlicqueryresult);

$noicdb = $rowic['noic'];
$namadb = ucwords($rowic['nama']);
$admindb = $rowic['admin'];

// CANDIDATE LOOP

$sqlallcandidatescommand = "SELECT * FROM candidate";









$adminbutton =  "<a href='/admin.php'><button type='button' class='btn btn-danger'>Admin Page</button></a>";


// Data Processing

if ($noicmasuk == $noicdb) {
    $loggedin = true;
    $_SESSION['loginstatus'] = $loggedin;

    if ($admindb == 0) {

        $adminbutton = "";
    }
} else {
    header('Location: index.php');
    $_SESSION["noicstatus"] = "0";


    exit();
}

if ($whereusercomefrom !== "http://voting.test/index.php" && $whereusercomefrom !== "http://voting.test/") {
    header("Location: /index.php");
}
?>

<body>
    <nav class="navbar navbar-dark bg-dark">

        <?php
        echo $adminbutton;
        ?>

    </nav>
    <div class="jumbotron">
        <div class="container">
            <h1 class="welcome">
                <?php
                echo "Selamat mengundi $namadb!"
                ?>
            </h1>

        </div>


    </div>
    <form action='kisah.php' method='post'>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Undi</th>
                </tr>
            </thead>
            <tbody>

                <?php

                if ($result = $con->query($sqlallcandidatescommand)) {

                    /* fetch associative array */
                    while ($rowall = $result->fetch_assoc()) {
                        $id = $rowall["id"];
                        $namacalon = $rowall["nama"];
                        $kelascalon = $rowall["class"];
                        $image = $rowall["image"];
                        $errormsg = "";



                        echo "<tr>
   <th scope='row'>$id</th>
   <td>$namacalon</td>
   <td>$kelascalon</td>
   <td>
   <div class='tablegambar'><img src='images/$image' class='img-thumbnail' height='200px' width='200px'>
   </div>
   
   </td>
   <td>
   
   
   <input type='checkbox' name='checkvalues[]' value='$id'></input>
   </td>
 </tr>";
                    }
                }


                ?>
            </tbody>

        </table>
        <input type="submit" name="submit" value="Submit" />
    </form>
</body>


<style>
    .welcome {
        text-align: center;
    }
</style>