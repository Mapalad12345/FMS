<?php 
$conn= new mysqli('localhost','root','','fms_db')or die("Could not connect to mysql".mysqli_error($conn));

if (isset($_GET['delete'])){
	$id = $_GET['delete'];
	$conn->query("DELETE FROM users WHERE id=$id");
	header("location: index.php?page=users");
	
}

?>



<div class="container-fluid">
	
	<div class="row">
	<div class="col-lg-12">
			<button class="btn btn-primary float-right btn-sm" id="new_user"><i class="fa fa-plus"></i> New user</button>
	</div>
	</div>
	<br>
	<div class="row">
		<div class="card col-lg-12">
			<div >
				<table width="100%"cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" style="margin-top: 12px;">
			<thead style="background-color: gray;">
				<tr>
					<th class="text-center" style="text-align: center; color:white;">#</th>
					<th class="text-center" style="text-align: center; color:white;">Name</th>
					<th class="text-center" style="text-align: center; color:white;">Username</th>
					<th class="text-center" style="text-align: center; color:white;">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
 					include 'db_connect.php';
 					$users = $conn->query("SELECT * FROM users order by name asc");
 					$i = 1;
 					while($row= $users->fetch_assoc()):
				 ?>
				 <tr>
				 	<td>
				 		<?php echo $i++ ?>
				 	</td>
				 	<td>
				 		<?php echo $row['name'] ?>
				 	</td>
				 	<td>
				 		<?php echo $row['username'] ?>
				 	</td>
				 	<td>
				 		<center>
								<div class="btn-group">
								  <button type="button" class="btn btn-primary">Action</button>
								  <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    <span class="sr-only" style="height: 3px;">Toggle Dropdown</span>
								  </button>
								  <div class="dropdown-menu">
								    <a class="dropdown-item edit_user" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Edit</a>
								    <div class="dropdown-divider"></div>
								    <a href="users.php?delete=<?php echo $row['id'];?>"
									class="alter-danger" style="margin-left: 23px; color:red;">Delete</a>
								  </div>
								</div>
								</center>
				 	</td>
				 </tr>
				<?php endwhile; ?>
			</tbody>
		</table>
			</div>
		</div>
	</div>

</div>
<script>
	
$('#new_user').click(function(){
	uni_modal('New User','manage_user.php')
})
$('.edit_user').click(function(){
	uni_modal('Edit User','manage_user.php?id='+$(this).attr('data-id'))
})

</script>