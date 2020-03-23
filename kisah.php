<?php
session_start();
require 'style.php';
$con = mysqli_connect("localhost", "root", "", "voting");

$noicmasuk =  $_SESSION["noicmasuk"];

$con = mysqli_connect("localhost", "root", "", "voting");

$sqliccommand = "SELECT * FROM users WHERE noic = '$noicmasuk'";


$sqlicqueryresult = mysqli_query($con, $sqliccommand);

$rowic = mysqli_fetch_array($sqlicqueryresult);

$havevoted = $rowic['havevoted'];

if ($havevoted == 1) {
    header('Location: index.php');
    exit();
}
if (!empty($_POST['checkvalues'])) {
    
    foreach ($_POST['checkvalues'] as $selected) {
        $sqlcommandvoters = "UPDATE candidate
SET totalvote=totalvote+1
WHERE id=$selected";
        mysqli_query($con, $sqlcommandvoters);
    }

}




$sqlcommandhavevoted = "UPDATE users SET havevoted = 1 WHERE noic = $noicmasuk";
mysqli_query($con, $sqlcommandhavevoted);


?>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>