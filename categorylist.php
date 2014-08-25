<?php
$link = mysqli_connect("localhost","root","fo8xj8qv");

mysqli_select_db($link,"senchanote");

$result = array("categories"=>array());

$query = "select * from categories";
$dbresult = mysqli_query($link, $query);

if (mysqli_affected_rows($link) > 0) {
	while($row = mysqli_fetch_array($dbresult))
	{
		array_push($result["categories"],array("id"=>$row["id"],
			"name"=>addslashes((string)$row["name"])));
	}
}

mysqli_close($link);

if (isset($_REQUEST["callback"])) {
	header("Content-Type: text/javascript");
	echo $_REQUEST["callback"]. "(" .json_encode($result). ");";
}
else {
	header("Content-Type: application/x-json");
	echo json_encode($result);
}
?>