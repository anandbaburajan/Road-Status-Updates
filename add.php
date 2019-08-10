<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">

<?php

$jsonString = file_get_contents('https://www.gizmolead.com/keralaroutes/routes.json');
$data = json_decode($jsonString, true);
$status =  $_POST["status_1"]; $remarks = $_POST["remarks_1"]; $asof = $_POST["datetime_1"];
$to = $_POST["to_1"];
$from = $_POST["from_1"];
$data[] = array('to'=>$to, 'from'=>$from, 'status'=>$status, 'asof'=>$asof, 'remarks'=>$remarks);
$newJsonString = json_encode($data);
file_put_contents('routes.json', $newJsonString);

$jsonString1 = file_get_contents('https://www.gizmolead.com/keralaroutes/places.json');
$data1 = json_decode($jsonString1, true);
$data1[] = $to;
$newJsonString1 = json_encode($data1);
$data1[] = $from;
$newJsonString1 = json_encode($data1);
file_put_contents('places.json', $newJsonString1);

$dt= explode("T",$asof);

?>


<h2>Status of <?php echo $to . " - " . $from . " route";?> added</h2>
<br>
<h4>Status: <b><?php echo $status; ?></b></h4>
<h4>As of: <b><?php echo $dt[1]." ".$dt[0]; ?></b></h4>
<h4>Remarks: <b><?php echo $remarks; ?></b></h4>

<br><br>
<a href="https://www.gizmolead.com/keralaroutes/update.html"><button type="button" class="btn btn-primary">Update another route</button></a>
<br><br>
<a href="https://www.gizmolead.com/keralaroutes/"><button type="button" class="btn btn-info">Check a route</button></a>
</div>
</body>
</html>
