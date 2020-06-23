<?php
//including the database connection file
include_once("config.php");

//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$result = mysqli_query($mysqli, "SELECT * FROM users ORDER BY id DESC"); // using mysqli_query instead



if(isset($_GET['action']) == 'testFunction') {	
	$name = mysqli_real_escape_string($mysqli, $_POST['name']);
	$age = mysqli_real_escape_string($mysqli, $_POST['age']);
	$email = mysqli_real_escape_string($mysqli, $_POST['email']);
			
		// checking empty fields
	if(empty($name) || empty($age) || empty($email)) {
				
		if(empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
		if(empty($age)) {
			echo "<font color='red'>Age field is empty.</font><br/>";
		}
		
		if(empty($email)) {
			echo "<font color='red'>Email field is empty.</font><br/>";
		}
		
		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		// if all the fields are filled (not empty) 
			
		//insert data to database	
		$result = mysqli_query($mysqli, "INSERT INTO users(name,age,email) VALUES('$name','$age','$email')");
		
		//display success message
		echo "<font color='green'>Data added successfully.";
		echo "<br/><a href='index.php'>View Result</a>";
			
		header("location:index.php");
	}

}

?>

<html>
<head>	
	<title>Homepage</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<style>
		.hide{
			display: none;	
		}
		.button{
			background-color: grey;
			text-decoration: unset;
			padding: 5px 22px;
			border-radius: 6px;
		}
		</style>
</head>

<body>
	<div id="nav_button" class="container">
		<a id ="button-add" href="javascript:;">Add New Data</a><br/><br/>
	</div>
	<div id="add_container" class="container hide">
		
			<form action="?action=testFunction" method="post" name="form1">
				<table width="25%" border="0">
					<tr> 
						<td>Name</td>
						<td><input type="text" name="name"></td>
					</tr>
					<tr> 
						<td>Age</td>
						<td><input type="text" name="age"></td>
					</tr>
					<tr> 
						<td>Team</td>
						<td><input type="text" name="team"></td>
					</tr>
					<tr> 
						<td><a class="button " href="javascript:;" id="back" >Back</button></td>
						<td><input class="" type="submit" name="testFunction" value="Add"></td>
					</tr>
				</table>
			</form>
		</div>
	<div id="list_container" class="">
		<table width='80%' border=0>
		<tr bgcolor='#CCCCCC'>
			<td>Name</td>
			<td>Age</td>
			<td>Email</td>
			<td>Update</td>
		</tr>
		<?php 
		//while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
		
		while($res = mysqli_fetch_array($result)) { 		
			echo "<tr>";
			echo "<td>".$res['name']."</td>";
			echo "<td>".$res['age']."</td>";
			echo "<td>".$res['email']."</td>";	
			echo "<td><a href=\"edit.php?id=$res[id]\">Edit</a> | <a href=\"delete.php?id=$res[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";		
		}
		?>
		</table>
	</div>
	
	
	
</body>


<script>

$("#button-add, #back").click(function(){
	$(".container").toggle();
});

</script>


</html>
