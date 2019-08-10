<html>
<body>

<?php

$jsonString = file_get_contents('routes.json');
$data = json_decode($jsonString, true);
$status = ""; $remarks = ""; $asof = "";
$to = $_POST["to"];
$from = $_POST["from"];
$i='0';
foreach ($data as $route) {
    if((($to == $route['to']) && ($from == $route['from'])) || (($to == $route['from']) && ($from == $route['to'])))
    {
        $i='1';
        $status = $route['status'];
        $asof = $route['asof'];
        $remarks = $route['remarks'];
    }
}
if($i=='0')
{
    $status = "Unknown";
    $asof = "Unknown";
    $remarks = "Unknown";
}
$newJsonString = json_encode($data);
file_put_contents('routes.json', $newJsonString);

?>

Status: <b><?php echo $status; ?></b>
<br>As of: <b><?php echo $asof; ?></b>
<br>Remarks: <b><?php echo $remarks; ?></b>

<br><br>
<a href="https://www.gizmolead.com/keralaroutes/update.html"
>Update status of a route / Add a route</a>
<br><a href="https://www.gizmolead.com/keralaroutes/">Check another route</a>
</body>
</html>