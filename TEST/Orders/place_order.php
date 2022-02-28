<?php

include_once('../Config/config.php');

if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	// Get data from the REST client
	$origin = isset($_POST['origin']) ? mysqli_real_escape_string($conn, $_POST['origin']) : "";
	$destination = isset($_POST['destination']) ? mysqli_real_escape_string($conn, $_POST['destination']) : "";

    $api = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".$origin."&destination=".$destination."&key=YOUR_API_KEY");
    $data = json_decode($api);

    $status = "UNASSIGNED";

	// Insert data into database
	$sql = "INSERT INTO `deliverydb`.`oredertbl` (`distance`, `status`) VALUES ('$data', '$status');";
	$post_data_query = mysqli_query($conn, $sql);

	if($post_data_query){
        header("HTTP/1.1 200 OK");
		$json = array("id" => 1, 
                      "distance" => $data, 
                      "status" => $status);
	}
	else{
        header("HTTP/1.1 404 ERROR");
		$json = array("status" => 0, 
                "Error" => "Error adding To-Do! Please try again!");
	}
}
else{
    header("HTTP/1.1 404 INCOMPLETE");
	$json = array("Error" => "Unable to create item.Data is incomplete.");
}

@mysqli_close($conn);

// Set Content-type to JSON
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
echo json_encode($json);
?>