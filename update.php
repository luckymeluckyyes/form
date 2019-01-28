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
			$('#update').click(function(){
				var u = $('#uid').val();
				var nm = $('#name').val();
				var em = $('#mail').val();
				// var gen = $('#gender').val();
				var gen = $("input[name='gender']:checked").val();
				var ag = $('#age').val();
				//var hb = $('#hob').val();
				var hb = [];

            	$.each($("input[name='hobbies']:checked"), function(){            

                hb.push($(this).val());

            	});
            	// alert("My favourite sports are: " + hb.join(", "));
				var p = $('#pass').val();
				var cp = $('#cpass').val();
				$('.error').remove();
				var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
				var validEmail = reg.test(em);

				if(u.length < 1){
					$('#uid').after('<span class="error">Update Id is required</span>');
					return false;
				}
				else if(nm.length < 1){
					$('#name').after('<span class="error">This field is required</span>');
					return false;
				}
				else if(em.length < 1){
					$('#mail').after('<span class="error">This field is required</span>');
					return false;
				}
				else if(!validEmail){
					$('#mail').after('<span class="error">Enter a valid email</span>');
					return false;
				}
				if(!gen){
					$('.gender').after('<span class="error">This field is required</span>');
					return false;
				}
				else if(ag.length == ""){
					$('#age').after('<span class="error">This field is required</span>');
					return false;
				}
				else if(hb.length < 1){
					$('.hob').after('<span class="error">This field is required</span>');
					return false;
				}
				else if(p.length < 1){
					$('#pass').after('<span class="error">This field is required</span>');
					return false;
				}
				else if(cp.length < 1){
					$('#cpass').after('<span class="error">This field is required</span>');
					return false;
				}

				else if (p != cp) {
                $('#cpass').after('<span class="error">Password not match.</span>');
                return false;
            	} else
				console.log("Starting ajax");
				$.ajax({
					url: "./records.php",
					type: "post",
					data: {
						uid:u,
						name:nm,
						mail:em,
						gender:gen,
						age:ag,
						hobbies:hb,
						pass:p,
						cpass:cp
					},
					success:function(data) {
						alert('done');
					}
				});
			});
		});
	</script>
 </head>
 <body>
 	<?php 
 		if(isset($_GET['id'])) {
 			$id = $_GET['id'];
 			$query = mysqli_query($conn, "SELECT * FROM form WHERE my_id = '".$id."' ");
 			$q = mysqli_fetch_array($query);
 		}
 	 ?>
 	 <a href="view.php">View</a>
 	<form>
		<table>
			<tr>
				<td>Name</td>
				<td><input type="text" name="name" id="name" value="<?= $q['name']; ?>"></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input type="text" name="mail" id="mail" value="<?= $q['email']; ?>"></td>
			</tr>
			<tr>
				<td>Gender</td>
				<td>Male<input type="radio" name="gender" id="gender" class="gender" value="male" <?php if($q['gender']=="male"){ echo "checked";}?>>
				Female<input type="radio" name="gender" id="gender1" class="gender" value="female" <?php if($q['gender']=="female"){ echo "checked";}?>></td>
			</tr>
			<tr>
				<td>Age </td>
				<td>
					<select name="age" id= "age" value="<?= $q['age']; ?>">
						<option value="<?= $q['age']; ?>"><?= $q['age']; ?></option>
						<?php
    						for ($i=1; $i<=100; $i++)
    						{
        				?>
            			<option><?php echo $i;?></option>
        				<?php
   							}
						?>
					</select>
				</td>
			</tr>
			<tr> 
				<td>Hobbies</td>
				<td>
					<?php $hobby=explode(",",$q['hobbies']); ?>

					<input type="checkbox" name="hobbies" value="chess"<?php if(in_array("chess",$hobby)) { ?> checked="checked" <?php } ?> class="hob" id="hob">Chess
					<input type="checkbox" name="hobbies" value="cricket" <?php if(in_array("cricket",$hobby)) { ?> checked="checked" <?php } ?> class="hob" id="hob1">Cricket
					<input type="checkbox" name="hobbies" value="football" <?php if(in_array("football",$hobby)) { ?> checked="checked" <?php } ?> class="hob" id="hob2">Football
					<input type="checkbox" name="hobbies" value="hockey" <?php if(in_array("hockey",$hobby)) { ?> checked="checked" <?php } ?> class="hob" id="hob3">Hockey
				</td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" name="pass" id="pass" value="<?= $q['pass']; ?>"></td>
			</tr>
			<tr>
				<td>Confirm Password</td>
				<td><input type="password" name="cpass" id="cpass" value="<?= $q['cpass']; ?>"></td>
			</tr>
			<tr>
				<td><input type="hidden" name="uid" id="uid" value="<?= $id ?>"></td>
				<!-- <td><input type="submit" name="update" id="update" value="update"></td> -->
				<td><button type="button" name="update" id="update">Update</button></td>
				<!-- <?php 
				// if(isset($_GET['id']) > 1) 
				{
				?>
    			<input type = "submit" class = "btn btn-primary" style="width:49%" value = "Save" name = "submit">
				<?php
					// } else {
				?>
    			<input type = "submit" class = "btn btn-primary" style="width:49%" value = "Update" name = "submit">
				<?php 
				} 
				?> -->
			</tr>
		</table>
	</form>
 
 </body>
 </html>