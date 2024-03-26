<?php 
include('connection.php');
?>

<!DOCTYPE html>
<html>
<head>


</head>
<body>

<select id="parentbox">
<option>Select Category</option>

<?php
$sql="select * from category";
$result=mysqli_query($conn,$sql);

while($data=mysqli_fetch_array($result))
{?>
<option value="<?php echo $data['id']?>"><?php echo $data['name'];?></option>
<?php } ?>

</select>

<select id="childbox">
<option>Select Course</option>
</select>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script>

$("#parentbox").change(function()
{
	$category=$("#parentbox").val();
	
	$.ajax({
		
		url:'data.php',
		method:'POST',
		data:{'category':$category},
		success:function(response)
		{
			$("#childbox").html(response);
		}
		
	});
	
});

</script>

</body>
</html>
