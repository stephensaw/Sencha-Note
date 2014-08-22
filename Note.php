<?php
$current_page = 1;
$offset_page = 0;
$limit_per_page = 25;
$fp = fopen('NoteLog.txt', 'a+');
$link = mysqli_connect("localhost","root","fo8xj8qv");

mysqli_select_db($link, "senchanote");

if (!isset($_REQUEST["action"])) {
    fwrite($fp, "No action defined\n");
	$result = array("notes"=>array(),"total"=>0);

	$current_page = $_REQUEST["page"];
	$limit_per_page = $_REQUEST["limit"];
	$offset_page = $_REQUEST["start"];
	
	$keyword = "";

	if (isset($_REQUEST["keyword"]))
		$keyword = $_REQUEST["keyword"];
    fwrite($fp, 'Keyword: '.$keyword."\n");

	$query = "select n.id,content,categoryid,name from notes n left join categories c on n.categoryid = c.id where content like concat('%','" .$keyword. "','%') limit " .$limit_per_page. " offset " .$offset_page;
    fwrite($fp, 'Query: '.$query."\n");

	$dbresult = mysqli_query($link,$query);

	if (mysqli_affected_rows($link) > 0) {
		while($row = mysqli_fetch_array($dbresult))
		{
			array_push($result["notes"],array("id"=>$row["id"],
				"content"=>addslashes((string)$row["content"]),
				"categoryid"=>$row["categoryid"],
				"category"=>(string)$row["name"]));
                fwrite($fp, 'Result (limited & offset): '.$row["id"].";".$row["content"].";".$row["categoryid"].";".$row["name"]."\n");
		}
	}

	$query = "select * from notes where content like concat('%','" .$keyword. "','%')";
	$dbresult = mysqli_query($link,$query);
	$result["total"] = mysqli_affected_rows($link);
    fwrite($fp, 'Results total: '.$result["total"]."\n");
	mysqli_close($link);
} else if ($_REQUEST["action"] == "create") {
	$inputPayload = file_get_contents("php://input");
    fwrite($fp, 'Payload: '.$inputPayload."\n");
    $inputPayload = json_decode($inputPayload);

    fwrite($fp, 'Create payload content: '.htmlspecialchars($inputPayload->content)."\n");

	$query = "insert into notes values(NULL,'" .htmlspecialchars($inputPayload->content). "',".
		$inputPayload->categoryid. ")";
    fwrite($fp, "Add query: $query\n");
	$dbresult = mysqli_query($link,$query);

	if(mysqli_affected_rows($link)>0) {
        fwrite($fp, "Note added\n");
		$result = array("success"=>true,"message"=>"Note added");
    }else {
        fwrite($fp, 'Error :'.mysqli_error($link)."\n");
        $result = array("success"=>false,"message"=>mysqli_error($link));
    }

	mysqli_close($link);
} else if ($_REQUEST["action"] == "update") {
	$inputPayload = file_get_contents("php://input");
    fwrite($fp, 'Payload: '.$inputPayload."\n");
    $inputPayload = json_decode($inputPayload);

	$query = "update notes set content='" .htmlspecialchars($inputPayload->content). "', ".
		"categoryid=" .$inputPayload->categoryid. " where id=" .$inputPayload->id;
    fwrite($fp, "Update query: $query\n");

	$dbresult = mysqli_query($link,$query);

	if(mysqli_affected_rows($link)>0)
		$result = array("success"=>true,"message"=>"Updated");
	else
		$result = array("success"=>false,"message"=>mysqli_error($link));

	mysqli_close($link);
}

if (isset($_REQUEST["callback"])) {
	header("Content-Type: text/javascript");
	echo $_REQUEST["callback"]. "(" .json_encode($result). ");";
}
else {
	header("Content-Type: application/x-json");
	echo json_encode($result);
}
fclose($fp);

?>