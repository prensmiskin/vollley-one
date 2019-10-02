<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
 session_start();
	
$name  = $_POST["kisi_ad"];
$ad  = $_POST["kisi_tel"];

  
	$_SESSION['test'] = $name;
	
$name  = $_POST["kisi_ad"];
$ad  = $_POST["kisi_tel"];

$servername = "localhost:3306";
$username = "webmaster";
$password = "2092641182";
$dbname = "databaseone";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // başlangıç
$v = $conn->prepare("select * from tableone where name=? and password=?");
$v->execute(array($name, $ad));
$x = $v->fetch(PDO::FETCH_ASSOC);
$d = $v->rowCount();
if($d){
	$namegelen =  $x["name"];
      $adgelen =  $x["password"];
	
	$sessionname = $_SESSION['test'];
	
	$result["success"] = "1";
   $result["message"] = "success";
	$result["sesion"] = $sessionname;
	

	echo json_encode($result);
	
	
	

	
	
}else{
  
}





     // $result = mysqli_query($conn,$sql);
     // $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
     // $active = $row['active'];
      
      //$count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
    
    //  if($count == 1) {
         //session_register("firstname");
        // $_SESSION['login_user'] = $name;
        // echo "tamam";
         //header("location: welcome.php");
      //}else {
                 //echo "hayır";

         $error = "Your Login Name or Password is invalid";
    //  }

          // bitiş

   
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
}
?>
