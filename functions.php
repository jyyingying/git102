<?php
include 'config.php';

function get_all_records(){
    $con = getdb();
    $Sql = "SELECT * FROM product ORDER BY id DESC";
    $result = mysqli_query($con, $Sql);  


    if (mysqli_num_rows($result) > 0) {
     echo "<div class='table-responsive'><table id='myTable' class='table table-striped table-bordered'>
             <thead><tr><th>PRODUCT ID</th>
                          <th>Color</th>
                          <th>Shape</th>
                          <th>Created Time</th>
                        </tr></thead><
                        >";


     while($row = mysqli_fetch_assoc($result)) {

         echo "<tr><td>" . $row['id']."</td>
                   <td>" . $row['color']."</td>
                   <td>" . $row['shape']."</td>
                   <td>" . $row['created_at']."</td></tr>";        
     }
    
     echo "</tbody></table></div>";
     
} else {
     echo "you have no records";
}
}

 if(isset($_POST["Import"])){
    
    $filename=$_FILES["file"]["tmp_name"];    


     if($_FILES["file"]["size"] > 0)
     {
        $file = fopen($filename, "r");
          while (($getData = fgetcsv($file, 100000, ",")) !== FALSE)
           {
            
            $servername = "mysql56";
            $username = "jyyingying_ying";
            $password = "lovetvxq";
            $db = "jyyingying_sutarrinee";
            $conn = mysqli_connect($servername, $username, $password, $db);
            
           
            $sql = "INSERT into product (color,shape,created_at) 
                   values ('".$getData[0]."','".$getData[1]."','".$getData[3]."')";
                   $result = mysqli_query($conn, $sql);

            /*if($result){
              echo "success";
            }else{
              echo "fail";
            }*/

        if(!isset($result))
        {
          echo "<script type=\"text/javascript\">
              alert(\"Invalid File:Please Upload CSV File.\");
              window.location = \"index.php\"
              </script>";   
        }
        else {
            echo "<script type=\"text/javascript\">
            alert(\"CSV File has been successfully Imported.\");
            window.location = \"index.php\"
          </script>";
        }
           }
      
           fclose($file); 
     }
  }  

   else if(isset($_POST["Export"])){
     $servername = "mysql56";
      $username = "jyyingying_ying";
      $password = "lovetvxq";
      $db = "jyyingying_sutarrinee";
      $conn = mysqli_connect($servername, $username, $password, $db);
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv');  
      $output = fopen("php://output", "w");  
      $basic_header = array('PRODUCT ID', 'Color', 'Shape', 'Created Time');

      fputcsv($output,$basic_header);  
      $query = "SELECT * from product ORDER BY id DESC";  
      $result = mysqli_query($conn, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 }  

 ?>
