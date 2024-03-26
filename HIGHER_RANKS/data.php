<?php

include('connection.php');

$category=$_POST['category'];

$sql="select cname from course where catid='".$category."'";
$result=mysqli_query($conn,$sql);

$output='<option>Select Course</option>';

while($data=mysqli_fetch_array($result))
{
	$output.="<option>".$data['cname']."</option>";
}

echo $output;

?>