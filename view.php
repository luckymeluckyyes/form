<?php 
include('config.php');
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 	<script type="text/javascript">
 		$(function(){
 			$('.del').click(function(){
 				var d = $(this).data('id');
 				if(confirm('Are you sure you want to delete ?')) {
 					if(d== '') {
 						alert('This user cant be deleted');
 						return false;
 					} else {
 						$.ajax({
 							url: "./records.php?id="+d,
 							type: "post",
 							data: {
 								del:d
 							},
 							success:function(data) {
 								$('body').html(data);
 							}
 						});
 					}
 				}
 			});
 		});
 	</script>
 </head>
 <body>
 	<a href="index.php">Add</a>
 	<?php 
 		$query = mysqli_query($conn, "SELECT * FROM form");
 	 ?>
 	<table>
 		<tr>
 			<td>Name</td>
 			<td>Email</td>
 			<td>Gender</td>
 			<td>Age</td>
 			<td>Hobbies</td>
 			<td>Password</td>
 			<td>Confitm Password</td>
 			<td>Action</td>
 		</tr>
 		<?php 
 		while($q = mysqli_fetch_array($query)) {
 		 ?>
 		 <tr>
 		 	<td><?= $q['name'] ?></td>
 		 	<td><?= $q['email'] ?></td>
 		 	<td><?= $q['gender'] ?></td>
 		 	<td><?= $q['age'] ?></td>
 		 	<td><?= $q['hobbies'] ?></td>
 		 	<td><?= $q['pass'] ?></td>
 		 	<td><?= $q['cpass'] ?></td>
 		 	<td><a href="update.php?id=<?= $q['my_id']; ?>">Update</a> | <a href="#!" class="del" data-id="<?= $q['my_id']; ?>">Delete</a></td>

 		 </tr>
 		 <?php
 		}
 		?>
 	</table>
 
 </body>
 </html>