<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container" style="margin-bottom:20px;margin-top:20px;">
<?php

$jsonString = file_get_contents('https://www.gizmolead.com/keralaroutes/routes.json');
$data = json_decode($jsonString, true);
$status =  $_POST["status"]; $remarks = $_POST["remarks"]; $asof = $_POST["datetime"];
$to = $_POST["to"];
$from = $_POST["from"];
$pre='0';
foreach ($data as $key => $route) {
    if((($to == $route['to']) && ($from == $route['from'])) || (($to == $route['from']) && ($from == $route['to'])))
    {   $pre='1';
        $data[$key]['status'] =$status;
        $data[$key]['asof']=$asof;
        $data[$key]['remarks']=$remarks;
        $newJsonString = json_encode($data);
        file_put_contents('routes.json', $newJsonString);
    }
}
if($pre=='0'){
$data[] = array('to'=>$to, 'from'=>$from, 'status'=>$status, 'asof'=>$asof, 'remarks'=>$remarks);
$newJsonString = json_encode($data);
file_put_contents('routes.json', $newJsonString);

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

$en_flag='0';
$enq = file_get_contents('https://www.gizmolead.com/keralaroutes/enquiries.json');
$enq_d = json_decode($enq, true);
$arr_index = array();
foreach ($enq_d as $key => $route) {
    if((($to == $route['to']) && ($from == $route['from'])) || (($to == $route['from']) && ($from == $route['to'])))
    {   $en_flag='1';
        $arr_index[] = $key;
    }
}
if($en_flag=='1')
{
foreach ($arr_index as $i)
{
    unset($enq_d[$i]);
}
$enq_d = array_values($enq_d);
}
file_put_contents('enquiries.json', json_encode($enq_d));

$dt= explode("T",$asof);

?>

<h2>Status of <?php echo $to . " - " . $from . " route";?> updated</h2>
<br>
<h4>Status: <b><?php echo $status; ?></b></h4>
<h4>As of: <b><?php echo $dt[1]." ".$dt[0]; ?></b></h4>
<h4>Remarks: <b><?php echo $remarks; ?></b></h4>

<br><br>
<a href="https://www.gizmolead.com/keralaroutes/update.html"><button type="button" class="btn btn-primary">Update another route</button></a>
<br><br>
<a href="https://www.gizmolead.com/keralaroutes/"><button type="button" class="btn btn-secondary">Check a route</button></a>
<br><br>
<a href="https://www.gizmolead.com/keralaroutes/enquiries.php"><button type="button" class="btn btn-warning">Check latest enquiries</button></a>
<br><br>
<a href="https://www.gizmolead.com/keralaroutes/enquire.html"><button type="button" class="btn btn-info">Make an enquiry</button></a>
<br><br>
<a href="https://www.gizmolead.com/keralaroutes/affected.php"><button type="button" class="btn btn-danger">List of affected routes</button></a>
</div>
</body>
</html>