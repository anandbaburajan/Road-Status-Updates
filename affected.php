<html>
<body>
<b>List of affected routes:</b>
<?php

$jsonString = file_get_contents('routes.json');
$data = json_decode($jsonString, true);
foreach ($data as $route) {
    if($route['status'] == "Not Okay")
    {
        echo "<br>" . $route['to'] . " - " . $route['from'] . " route is not okay as of " . $route['asof'];
    }
}
$newJsonString = json_encode($data);
file_put_contents('routes.json', $newJsonString);

?>
<br><br>
<a href="https://www.gizmolead.com/keralaroutes/">Check a route</a>
<br><a href="https://www.gizmolead.com/keralaroutes/update.html">Update status of a route / Add a route</a>
</body>
</html>