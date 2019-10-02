<?php

if($_SERVER['REQUEST_METHOD']=='POST'){

	session_start();
$akis  = $_POST["akis"];
	
	
		$_SESSION['test'] = $akis;

$servername = "";
$username = "";
$password = "";
$dbname = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$v = $conn->prepare("select * from tabletwo where akis=? ");
$v->execute(array($akis));
$x = $v->fetch(PDO::FETCH_ASSOC);
$d = $v->rowCount();
if($d){
	
	
	
	
  echo "üye name ve ad daha önce alınmış";
}else{
  




    $sql = "INSERT INTO tabletwo (akis)
    VALUES ('$akis')";
    // use exec() because no results are returned
    $conn->exec($sql);
	

	
   //$result["success"] = "1";
  // $result["message"] = "success";
	
	
/*	$sorgu = $conn->query("SELECT akis FROM tabletwo");

    $cikti = $sorgu->fetchAll(PDO::FETCH_ASSOC);*/


    $statement = $conn->prepare("SELECT akis FROM tabletwo");
$statement->execute();
$array = $statement->fetchAll(PDO::FETCH_ASSOC);
//$json = json_encode($array);
				$result["employees"] = $array;

		echo json_encode($result);
	
	/*foreach($cikti as $b){
	
		
		
		
		
		$d = $b["akis"];
		$result["d"] = $d;
		echo json_encode($result);
	
	
	}*/
	
	
	
	
/*$json = json_encode($cikti);
$result["d"] = $json;
		echo json_encode($result);
	
	
	
	*/
	
	
		

    
        }
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
}
?>
