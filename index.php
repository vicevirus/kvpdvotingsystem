<?php
session_start();




$errormsg = "";


if (isset($_SESSION['noicstatus'])) {
    $errormsg = "No IC tiada di dalam sistem";
    session_destroy();
}


require 'style.php';



?>


<html>


<head>

</head>

<body>


    <div class="jumbotron ">
        <div class="container">
            <div class="title">
                UNDI MPP
            </div>
            <div style="height: 30"></div>

            <form class="form-inline" action="votingpage.php" method="post">
                <div>No IC : </div>
                


                <input type="text" name="noic" class="form-control mx-sm-3" aria-describedby="passwordHelpInline">


                <button type="submit" class="btn btn-primary">Undi</button>
                
            </form>
            
        </div>
        <div class='error'><b><?php echo $errormsg ?></b></div>
    </div>

    



    <?php
    if (isset($_POST['submit'])) {

        if (!empty($_POST['lang'])) {

            foreach ($_POST['lang'] as $value) {
                echo "value : " . $value . '<br/>';
            }
        }
    }
    ?>
</body>

</html>

<style>
    .title {
        font-size: 30;
        text-align: center;
    }

    .jumbotron {
        position: fixed;
        top: 50%;
        left: 50%;

        transform: translate(-50%, -50%);
    }
    .error {
        text-align: center;
        color: red;
    }
</style>