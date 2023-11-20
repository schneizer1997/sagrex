<?php
$keyword = strval($_POST['queryvendor']);
//die($keyword); - inputed
$search_param = "{$keyword}%";
$conn =new mysqli('localhost', 'root', 'OSXVD2XSQk1PhOvD' , 'inventorydatabase');

$sql = $conn->prepare("SELECT *FROM tblcustomer where isdelete = 1 AND cust_name LIKE ?");
$sql->bind_param("s",$search_param);			
$sql->execute();
$result = $sql->get_result();
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$cust_id = $row['cust_id'];
		$cust_name = $row['cust_name'];
		$customerResult[] = array("id" => $cust_id,"value" =>$cust_name);
		//$customerResult[] = $row["cust_name"];
	}
	echo json_encode($customerResult);
}
else {
	$customerResult[] = array("id" => "","value" =>"");
	echo json_encode($customerResult);
	//echo "echo json_encode('')";
}
$conn->close();
?>