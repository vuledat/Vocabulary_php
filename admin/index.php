<?php 
    // ob_start();
    // session_start();    
    include '../connect.php';
    if (isset($_POST["submit"])) {
       	$en = $_POST['en'];
       	$vn = $_POST['vn'];
       	$vnf1 = $_POST['vnf1'];
       	$vnf2 = $_POST['vnf2'];
       	$sql = "INSERT INTO words(en,vn,mem,vn_f1,vn_f2) VALUES ('$en','$vn','1','$vnf1','$vnf2')";
       	$query = mysqli_query($con,$sql);
       	echo "<div class='alert alert-success'>
		    <strong>Success!</strong> Đã thêm thành công
		  </div>";
       }   
?>
<!DOCTYPE html>
<html>
<head>
	<title>Vocabulary</title>
	<link rel="stylesheet" type="text/css" href="../asset/css/bootstrap.css">
    <script type="text/javascript" src="../asset/js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../asset/js/bootstrap.js"></script>
</head>
<body>
	<div class="container">
		<form method="post">
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<label for="in_en">EN</label>
						<input type="text" class="form-control" id="in_en" placeholder="EN" name="en" required="">

					</div>
					<div class="form-group">
						<label for="in_vn">VN</label>
						<input type="text" class="form-control" id="in_vn" placeholder="VN" name="vn" required="">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label for="in_en_f1">VN Fale 1</label>
						<input type="text" class="form-control" id="in_en" placeholder="Vn_f1" name="vnf1" required="">

					</div>
					<div class="form-group">
						<label for="in_vn_f2">VN Fale 2</label>
						<input type="text" class="form-control" id="in_vn" placeholder="Vn_f2" name="vnf2" required="">
					</div>
				</div>
			</div>
			<table>
				<tr>
					<td></td>
				</tr>
			</table>
			<button type="submit" name="submit" class="btn btn-primary">Add</button>
		</form>
	</div>
</body>
</html>