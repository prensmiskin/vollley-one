<?php

if($_SERVER['REQUEST_METHOD']=='POST'){

	session_start();
$name  = $_POST["kisi_ad"];
$ad  = $_POST["kisi_tel"];
	
	
		$_SESSION['test'] = $name;

$servername = "localhost:3306";
$username = "webmaster";
$password = "2092641182";
$dbname = "databaseone";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$v = $conn->prepare("select * from tableone where name=? and password=?");
$v->execute(array($name, $ad));
$x = $v->fetch(PDO::FETCH_ASSOC);
$d = $v->rowCount();
if($d){
	
	
	
	
  echo "üye name ve ad daha önce alınmış";
}else{
  




    $sql = "INSERT INTO tableone (name, password)
    VALUES ('$name', '$ad')";
    // use exec() because no results are returned
    $conn->exec($sql);
	
	$sessionname = $_SESSION['test'];
	
   $result["success"] = "1";
   $result["message"] = "success";
	
	$result["sesion"] = $sessionname;
	
	
	
	
	  

	echo json_encode($result);
		


      
    
        }
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
}
?>
