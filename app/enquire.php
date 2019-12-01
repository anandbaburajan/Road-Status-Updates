<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container" style="margin-bottom:20px;margin-top:20px;">
<?php

$jsonString = file_get_contents('https://www.gizmolead.com/keralaroutes/enquiries.json');
$data = json_decode($jsonString, true);
$to = $_POST["to"];
$from = $_POST["from"];
$pre='0';
foreach ($data as $key => $route) {
    if((($to == $route['to']) && ($from == $route['from'])) || (($to == $route['from']) && ($from == $route['to'])))
    {   $pre='1';
    }
}
if($pre=='0'){
$data[] = array('to'=>$to, 'from'=>$from);
$newJsonString = json_encode($data);
file_put_contents('enquiries.json', $newJsonString);


$places = file_get_contents('https://www.gizmolead.com/keralaroutes/places.json');
$places_d = json_decode($places, true);
if (in_array($to, $places_d) == FALSE) {
$places_d[] = $to;
}
$newJsonString1 = json_encode($places_d);
file_put_contents('places.json', $newJsonString1);

$places1 = file_get_contents('https://www.gizmolead.com/keralaroutes/places.json');
$places1_d = json_decode($places1, true);
if (in_array($from, $places1_d) == FALSE) {
$places1_d[] = $from;
}
$newJsonString2 = json_encode($places1_d);
file_put_contents('places.json', $newJsonString2);

}

?>

<h2>Enquiry made successfully</h2>
<h4>Check status of <?php echo $to . " - " . $from . " route";?> in a while</h4>

<br><br>
<a href="https://www.gizmolead.com/keralaroutes/enquire.html"><button type="button" class="btn btn-secondary">Make another enquiry</button></a>
<br><br>
<a href="https://www.gizmolead.com/keralaroutes/enquiries.php"><button type="button" class="btn btn-warning">Check latest enquiries</button></a>
<br><br>
<a href="https://www.gizmolead.com/keralaroutes/update.html"><button type="button" class="btn btn-primary">Update status of a route / Add a route</button></a>
<br><br>
<a href="https://www.gizmolead.com/keralaroutes/"><button type="button" class="btn btn-info">Check a route</button></a>
<br><br>
<a href="https://www.gizmolead.com/keralaroutes/affected.php"><button type="button" class="btn btn-danger">List of affected routes</button></a>
</div>
</body>
</html>
