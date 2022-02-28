<?php
include_once('../Config/config.php');

if (isset($_PATCH['orderid']) && $_PATCH['orderid']!="") {

    include_once('../Config/config.php');

	$orderid = $_PATCH['orderid'];
	$status = "TAKEN";
	
	$validate =mysqli_query($conn,"SELECT * FROM `ordertbl` WHERE orderid = '$orderid' AND `status` = '$status'");

	if(mysqli_num_rows($validate)>0){

		$json = array( 
			"status" => "TAKEN");
		echo json_encode($json);
	}else{
		$result = mysqli_query($conn,"UPDATE `ordertbl` 
								SET  `status` = '$status'
								WHERE orderid = '$orderid'");
		if($result){
			$json = array( 
					"status" => "SUCCESSFUL");
				echo json_encode($json);
		mysqli_close($conn);

		}else{
			$json = array( 
					"Error" => "NO DATA FOR THIS ORDER ID");
			echo json_encode($json);
			}
		}
	}else{
	$json = array( 
        "Error" => "INVALID REQUEST");
    echo json_encode($json);
}

// Set Content-type to JSON
// Set Content-type to JSON
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header('Content-type: application/json');

?>