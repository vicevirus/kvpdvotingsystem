<?php
require 'style.php';
$insertedusers = "";
$connect = mysqli_connect("localhost", "root", "", "voting");
if (isset($_POST["submit"])) {
  if ($_FILES['file']['name']) {
    $filename = explode(".", $_FILES['file']['name']);
    if ($filename[1] == 'csv') {
      $handle = fopen($_FILES['file']['tmp_name'], "r");

      $flag = true;
      while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

        if ($flag) {
          $flag = false;
          continue;
        }
        $item1 = mysqli_real_escape_string($connect, $data[0]);
        $item2 = mysqli_real_escape_string($connect, $data[1]);
      }
      fclose($handle);
      echo "<script>alert('Import done');</script>";
    }
  }
}
?>
<!DOCTYPE html>
<html>




<form method="post" enctype="multipart/form-data">
  <div align="center">
    <label>Select CSV File:</label>
    <input type="file" name="file" />
    <br />
    <input type="submit" name="submit" value="Import" class="btn btn-info" />
  </div>
</form>

<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nama</th>
      <th scope="col">Kelas</th>
      <th scope="col">Gambar</th>
    </tr>
  </thead>
  <tbody>

    <?php
    $sqlallcandidatescommand = "SELECT * FROM candidate";

    if ($result = $connect->query($sqlallcandidatescommand)) {

      /* fetch associative array */
      while ($rowall = $result->fetch_assoc()) {
        $id = $rowall["id"];
        $namacalon = ucwords(strtolower($rowall["nama"]));
        $kelascalon = strtoupper($rowall["class"]);
        $image = $rowall["image"];




        if (isset($_FILES[$id])) {
          $errors = array();
          $file_name = $_FILES[$id]['name'];
          $file_size = $_FILES[$id]['size'];
          $file_tmp = $_FILES[$id]['tmp_name'];
          $file_type = $_FILES[$id]['type'];




          if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "images/" . $file_name);

            $query = "UPDATE candidate 
        SET 
            image = '$file_name'
        WHERE
            id = $id";
            mysqli_query($connect, $query);
            echo "<meta http-equiv='refresh' content='0'>";
          }
        }

        echo "<tr>
   <th scope='row'>$id</th>
   <td><h3><b>$namacalon</b></h3>

   <h5>Image upload</h5>
   <form method = 'POST' enctype = 'multipart/form-data'>
         <input type = 'file' name = '$id' />
         <div style='height: 30px'></div>
       <div><input type = 'submit' value='Upload'/></div>
			
         
			
      </form></td>
   <td><h3>$kelascalon</h3></td>
   <td><div class='tablegambar'><img src='images/$image' class='img-thumbnail' height='200px' width='200px'></div></td>
 </tr>";
      }
    }




    ?>
  </tbody>
</table>
</div>



</html>

<style>
  .tablegambar {
    max-width: 150px;
    max-height: 200px;

  }
</style>