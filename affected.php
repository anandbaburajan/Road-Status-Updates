<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    </head>
<body>
<div class="container">
<h2>List of affected routes:</h2>
<?php

$jsonString = file_get_contents('routes.json');
$data = json_decode($jsonString, true);
foreach ($data as $route) {
    if($route['status'] == "Not Okay")
    {
        echo "<br><h4>" . $route['to'] . " - " . $route['from'] . " route is not okay as of " . $route['asof']."</h4>";
    }
}
$newJsonString = json_encode($data);
file_put_contents('routes.json', $newJsonString);

?>
<br><br>
<a href="https://www.gizmolead.com/keralaroutes/"><button type="button" class="btn btn-info">Check a route</button></a>
<br><br>
<a href="https://www.gizmolead.com/keralaroutes/update.html"><button type="button" class="btn btn-primary">Update status of a bus route / Add a bus route</button></a>
</div>
</body>
</html>
