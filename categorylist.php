<?php
$link = mysql_connect("localhost","root","root");

mysql_select_db("senchanote",$link);

$result = array("categories"=>array());

$query = "select * from categories";
$dbresult = mysql_query($query);

if (mysql_affected_rows() > 0) {
	while($row = mysql_fetch_array($dbresult))
	{
		array_push($result["categories"],array("id"=>$row["id"],
			"name"=>addslashes((string)$row["name"])));
	}
}

mysql_close();

if (isset($_REQUEST["callback"])) {
	header("Content-Type: text/javascript");
	echo $_REQUEST["callback"]. "(" .json_encode($result). ");";
}
else {
	header("Content-Type: application/x-json");
	echo json_encode($result);
}
?>