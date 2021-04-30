
<?php
//action.php
if(isset($_POST["action"]))
{
 $connect = mysqli_connect("localhost", "root", "", "dtmf");
 if($_POST["action"] == "fetch")
 {
  $query = "SELECT * FROM shortarticle ORDER BY id DESC";
  $result = mysqli_query($connect, $query);
  $output = '
   <table style="width: 80%; margin-left: 19.5%;" class="table table-bordered table-striped">  
    <tr>
     <th width="8%">ID</th>
     <th width="10%">title</th>
     <th width="10%">date</th>
     <th width="10%">Article</th>
     <th width="70%">Image</th>
     <th width="10%">Change</th>
     <th width="10%">Remove</th>
    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '

    <tr>
     <td>'.$row["id"].'</td>
     
     
     <td>
      <div> '.$row['title'].'</div>
     </td>     
     
          
     <td>
      <div> '.$row['date'].'</div>
     </td>     
     
          
     <td>
      <div> '.$row['article'].'</div>
     </td>     
     
     
     
     <td>
      <img src="data:image/jpeg;base64,'.base64_encode($row['name'] ).'" height="60" width="75" class="img-thumbnail" />
     </td>
     
     
     <td><button type="button" name="update" class="btn btn-warning bt-xs update" id="'.$row["id"].'">Change</button></td>
     <td><button type="button" name="delete" class="btn btn-danger bt-xs delete" id="'.$row["id"].'">Remove</button></td>
    </tr>
   ';
  }
  $output .= '</table>';
  echo $output;
 }

 if($_POST["action"] == "insert")
 {
     
$title = $_POST['title'];     
$date = $_POST['date'];     
$article = $_POST['article'];     
  $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
  $query = "INSERT INTO shortarticle(name,title,date,article) VALUES ('$file','$title','$date','$article')";
  if(mysqli_query($connect, $query))
  {
   echo 'Image Inserted into Database';
  }
 }
 if($_POST["action"] == "update")
 {
     
  $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
     
     
  $query = "UPDATE shortarticle SET name = '$file' WHERE id = '".$_POST["image_id"]."'";
     
     
     
  if(mysqli_query($connect, $query))
  {
   echo 'Image Updated into Database';
  }
 }
    
    
    
 if($_POST["action"] == "delete")
 {
  $query = "DELETE FROM shortarticle WHERE id = '".$_POST["image_id"]."'";
  if(mysqli_query($connect, $query))
  {
   echo 'Image Deleted from Database';
  }
 }
}
?>

