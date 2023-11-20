<?php
$keyword = strval($_POST['queryaddr']);
$search_param = "{$keyword}%";
$conn =new mysqli('localhost', 'root', 'OSXVD2XSQk1PhOvD' , 'inventorydatabase');

$sql = $conn->prepare("SELECT *FROM tbladdress WHERE isdelete = 1 AND category_id = 2 AND addr_name LIKE ?");
$sql->bind_param("s",$search_param);			
$sql->execute();
$result = $sql->get_result();
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$addr_id = $row['addr_id'];
		$addr_name = $row['addr_name'];
		$addressResult[] = array("id" => $addr_id,"value" =>$addr_name);
		//$addressResult[] = $row["addr_name"];
	}
	echo json_encode($addressResult);
}
else {
	$addressResult[] = array("id" => "","value" =>"");
	echo json_encode($addressResult);
	//echo "echo json_encode('')";
}
$conn->close();
?>