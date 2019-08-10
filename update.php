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
}
?>


<h2>Status of <?php echo $to . " - " . $from . " route";?> updated</h2>
<br>
<h4>Status: <b><?php echo $status; ?></b></h4>
<h4>As of: <b><?php echo $asof; ?></b></h4>
<h4>Remarks: <b><?php echo $remarks; ?></b></h4>

<br><br>
<a href="https://www.gizmolead.com/keralaroutes/update.html"><button type="button" class="btn btn-primary">Update another route</button></a>
<br><br>
<a href="https://www.gizmolead.com/keralaroutes/"><button type="button" class="btn btn-info">Check a route</button></a>
</div>
</body>
</html>
