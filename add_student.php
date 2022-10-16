<?php
require('top.inc.php');

$name='';
$Email='';
$mobile='';
$department_id='';
$address='';
$birthday='';
$id='';
if(isset($_GET['id'])){
	$id=mysqli_real_escape_string($con,$_GET['id']);
	if($_SESSION['ROLE']!==1 && $_SESSION['USER_ID']!=$id){
		die('Access denied');
	}
	$res=mysqli_query($con,"select * from student where id='$id'");
	$row=mysqli_fetch_assoc($res);
	$name=$row['name'];
	$Email=$row['Email'];
	$mobile=$row['mobile'];
	$department_id=$row['department_id'];
	$address=$row['address'];
	$birthday=$row['birthday'];
}
if(isset($_POST['submit'])){
	$name=mysqli_real_escape_string($con,$_POST['name']);
	$Email=mysqli_real_escape_string($con,$_POST['Email']);
	$mobile=mysqli_real_escape_string($con,$_POST['mobile']);
	$password=mysqli_real_escape_string($con,$_POST['password']);
	$department_id=mysqli_real_escape_string($con,$_POST['department_id']);
	$address=mysqli_real_escape_string($con,$_POST['address']);
	$birthday=mysqli_real_escape_string($con,$_POST['birthday']);
	if($id>0){
		$sql="update student set name='$name',Email='$Email',mobile='$mobile',password='$password',department_id='$department_id',address='$address',birthday='$birthday' where id='$id'";
	}else{
		$sql="insert into student(name,Email,mobile,password,department_id,address,birthday,role) values('$name','$Email','$mobile','$password','$department_id','$address','$birthday','2')";
	}
	mysqli_query($con,$sql);
	header('location:student.php');
	die();
}
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Leave Type</strong><small> Form</small></div>
                        <div class="card-body card-block">
                           <form method="post">
							   <div class="form-group">
									<label class=" form-control-label">Name</label>
									<input type="text" value="<?php echo $name?>" name="name" placeholder="Enter student name" class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Email</label>
									<input type="Email" value="<?php echo $Email?>" name="Email" placeholder="Enter student Email" class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Mobile</label>
									<input type="text" value="<?php echo $mobile?>" name="mobile" placeholder="Enter student mobile" class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Password</label>
									<input type="password"  name="password" placeholder="Enter student password" class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Department</label>
									<select name="department_id" required class="form-control">
										<option value="">Select Department</option>
										<?php
										$res=mysqli_query($con,"select * from department order by department desc");
										while($row=mysqli_fetch_assoc($res)){
											if($department_id==$row['id']){
												echo "<option selected='selected' value=".$row['id'].">".$row['department']."</option>";
											}else{
												echo "<option value=".$row['id'].">".$row['department']."</option>";
											}
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Address</label>
									<input type="text" value="<?php echo $address?>" name="address" placeholder="Enter student address" class="form-control" required>
								</div>
								<div class="form-group">
									<label class=" form-control-label">Birthday</label>
									<input type="date" value="<?php echo $birthday?>" name="birthday" placeholder="Enter student birthday" class="form-control" required>
								</div>
							   <?php if($_SESSION['ROLE']==1){?>
							   <button  type="submit" name="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">Submit</span>
							   </button>
							   <?php } ?>
							  </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
                  
<?php
require('footer.inc.php');
?>