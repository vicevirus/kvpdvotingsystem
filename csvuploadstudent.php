<?php  

$insertedusers = "";
$connect = mysqli_connect("localhost", "root", "", "voting");
if(isset($_POST["submit"]))
{
 if($_FILES['file']['name'])
 {
  $filename = explode(".", $_FILES['file']['name']);
  if($filename[1] == 'csv')
  {
   $handle = fopen($_FILES['file']['tmp_name'], "r");
   
   $flag = true;
   while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
   
   {
       
    if($flag) { $flag = false; continue; }
    $item1 = mysqli_real_escape_string($connect, $data[0]);  
                $item2 = mysqli_real_escape_string($connect, $data[1]);

              
                


              
                $query = "INSERT into users(noic, nama) values('$item1','$item2')";
                mysqli_query($connect, $query);
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

  

  
</html>