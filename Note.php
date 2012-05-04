<?php
$current_page = 1;
$offset_page = 0;
$limit_per_page = 25;

$link = mysql_connect("localhost","root","root");

mysql_select_db("senchanote",$link);

if (!isset($_REQUEST["action"])) {
	$result = array("notes"=>array(),"total"=>0);

	$current_page = $_REQUEST["page"];
	$limit_per_page = $_REQUEST["limit"];
	$offset_page = $_REQUEST["start"];
	
	$keyword = "";

	if (isset($_REQUEST["keyword"]))
		$keyword = $_REQUEST["keyword"];

	$query = "select n.id,content,categoryid,name from notes n left join categories c on n.categoryid = c.id where content like concat('%','" .$keyword. "','%') limit " .$limit_per_page. " offset " .$offset_page;
	$dbresult = mysql_query($query);

	if (mysql_affected_rows() > 0) {
		while($row = mysql_fetch_array($dbresult))
		{
			array_push($result["notes"],array("id"=>$row["id"],
				"content"=>addslashes((string)$row["content"]),
				"categoryid"=>$row["categoryid"],
				"category"=>(string)$row["name"]));
		}
	}

	$query = "select * from notes where content like concat('%','" .$keyword. "','%')";
	$dbresult = mysql_query($query);
	$result["total"] = mysql_affected_rows();

	mysql_close();
}
else if ($_REQUEST["action"] == "create") {
	$inputPayload = file_get_contents("php://input");
	$inputPayload = json_decode($inputPayload);

	$query = "insert into notes values(NULL,'" .htmlspecialchars($inputPayload->content). "',".
		$inputPayload->categoryid. ")";

	$dbresult = mysql_query($query);

	if(mysql_affected_rows()>0)
		$result = array("success"=>true,"message"=>"Note added");
	else
		$result = array("success"=>false,"message"=>mysql_error());

	mysql_close();
}
else if ($_REQUEST["action"] == "update") {
	$inputPayload = file_get_contents("php://input");
	$inputPayload = json_decode($inputPayload);

	$query = "update notes set content='" .htmlspecialchars($inputPayload->content). "', ".
		"categoryid=" .$inputPayload->categoryid. " where id=" .$inputPayload->id;

	$dbresult = mysql_query($query);

	if(mysql_affected_rows()>0)
		$result = array("success"=>true,"message"=>"Updated");
	else
		$result = array("success"=>false,"message"=>mysql_error());

	mysql_close();
}

if (isset($_REQUEST["callback"])) {
	header("Content-Type: text/javascript");
	echo $_REQUEST["callback"]. "(" .json_encode($result). ");";
}
else {
	header("Content-Type: application/x-json");
	echo json_encode($result);
}
?>