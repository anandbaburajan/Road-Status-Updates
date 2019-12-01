<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container" style="margin-bottom:20px;margin-top:20px;">
<h2>List of routes needing status update</h2><br>
<?php

$jsonString = file_get_contents('enquiries.json');
$data = json_decode($jsonString, true);
foreach ($data as $route) {
        echo "<h4>" . $route['to'] . " - " . $route['from'] . " route</h4>";
}
$newJsonString = json_encode($data);
file_put_contents('enquiries.json', $newJsonString);

?>
<br><br>
<a href="https://www.gizmolead.com/keralaroutes/enquire.html"><button type="button" class="btn btn-secondary">Make an enquiry</button></a>
<br><br>
<a href="https://www.gizmolead.com/keralaroutes/update.html"><button type="button" class="btn btn-primary">Update status of a route / Add a route</button></a>
<br><br>
<a href="https://www.gizmolead.com/keralaroutes/"><button type="button" class="btn btn-info">Check a route</button></a>
<br><br>
<a href="https://www.gizmolead.com/keralaroutes/affected.php"><button type="button" class="btn btn-danger">List of affected routes</button></a>
</div>
</body>
</html>
