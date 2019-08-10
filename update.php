<html>
<body>

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


<p>Status of <b><?php echo $to . " - " . $from . " route";?> </b> updated</p>

Status: <b><?php echo $status; ?></b>
<br>As of:<b><?php echo $asof; ?></b>
<br>Remarks: <b><?php echo $remarks; ?></b>

<br><br>
<a href="https://www.gizmolead.com/keralaroutes/update.html">Update another route</a>
<br><a href="https://www.gizmolead.com/keralaroutes/">Check a route</a>
</body>
</html>