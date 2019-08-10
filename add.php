<html>
<body>

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
?>


<p>Status of <b><?php echo $to . " - " . $from . " route";?> </b> added</p>

Status: <b><?php echo $status; ?></b>
<br>As of:<b><?php echo $asof; ?></b>
<br>Remarks: <b><?php echo $remarks; ?></b>

<br><br>
<a href="https://www.gizmolead.com/keralaroutes/update.html">Update another route</a>
<br><a href="https://www.gizmolead.com/keralaroutes/">Check a route</a>
</body>
</html>