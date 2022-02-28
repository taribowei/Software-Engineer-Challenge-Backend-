<?php
include_once('../Config/config.php');

if (isset($_GET['page']) && $_GET['page']!="") {

    include_once('../Config/config.php');

	$page = $_GET['page'];
    $limit = $_GET['limit'];

	$result = mysqli_query($conn,"SELECT * FROM `ordertbl` WHERE orderid = '$page' LIMIT 1");

	if(mysqli_num_rows($result)>0){

        $row = mysqli_fetch_array($result);
        $distance = $row['distance'];
        $status = $row['status'];

	response($page, $distance, $status);

	mysqli_close($conn);
	}else{
        $json = array( 
                "Error" => "NO DATA FOR THIS ORDER ID");
        echo json_encode($json);
		}
}else{
	$json = array( 
        "Error" => "INVALID REQUEST");
    echo json_encode($json);
}

function response($page, $distance, $status){

    $json = array( 
        "orderid" => $page,
        "distance" => $distance,
        "status" => $status,
        );
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