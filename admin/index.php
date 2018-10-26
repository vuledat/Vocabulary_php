<?php 
    // ob_start();
    // session_start();    
    include '../connect.php';
    $rr = array();
    $sql = "SELECT * FROM `words` ";
    $query=mysqli_query($con,$sql);
    while ($row= mysqli_fetch_array($query)){
    	array_push($rr,$row['en']);
			}
		$voca = json_encode((array)$rr);

    if (isset($_POST["submit"])) {
       	$en = $_POST['en'];
       	$vn = $_POST['vn'];
       	$vnf1 = $_POST['vnf1'];
       	$vnf2 = $_POST['vnf2'];
       	if (isset($_POST['en'])) {
       		// $sql = "SELECT en FROM `words` ";
       	// $query = mysqli_query($con,$sql);
       	// while ($row= mysqli_fetch_array($query)) {
       		// if ($row != $en) {
       			$sql1 = "INSERT INTO words(en,vn,mem,vn_f1,vn_f2) VALUES ('$en','$vn','1','$vnf1','$vnf2')";
		       	$query1 = mysqli_query($con,$sql1);
		       	echo "<div class='alert alert-success'>
				    <strong>Success!</strong> Đã thêm thành công
				  </div>";
		       // }  
       		// }
       	}
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
	<div class="container" class='alert alert-success '>
		<div id="alert" class="alert alert-success text-center" style="visibility: hidden;">
			
		</div>
		<form method="post">
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						<label for="in_en">EN</label>
						<input type="text" class="form-control" id="in_en" placeholder="EN" name="en" required="" onkeyup="test()">

					</div>
					<div class="form-group">
						<label for="in_vn">VN</label>
						<input type="text" class="form-control" id="in_vn" placeholder="VN" name="vn" required="">
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						<label for="in_en_f1">VN False 1</label>
						<input type="text" class="form-control" id="in_vn_f1" placeholder="Vn_f1" name="vnf1" required="">

					</div>
					<div class="form-group">
						<label for="in_vn_f2">VN False 2</label>
						<input type="text" class="form-control" id="in_vn_f2" placeholder="Vn_f2" name="vnf2" required="">
					</div>
				</div>
			</div>
			<table>
				<tr>
					<td></td>
				</tr>
			</table>
			<button type="submit" name="submit" id="submit" class="btn btn-primary">Add</button>
		</form>
	</div>
</body>
</html>

<script type="text/javascript">

	function test() {
		document.getElementById('alert').style = "visibility: visible";
		var en=document.getElementById('in_en').value;
		var item = getItem();
		var ok =1;
		for (var i = 0; i < item.length; i++){
            if(item[i] == en)
            ok = 0;
        }
        if (!ok) {
				document.getElementById('alert').innerHTML = "Từ đã tồn tại";
				document.getElementById('alert').className = "alert alert-danger text-center";
				document.getElementById('submit').style = "visibility: hidden";
			}
				
			else
            {
                document.getElementById('alert').innerHTML = "Từ chưa có";
                document.getElementById('alert').className = "alert alert-success text-center";
                document.getElementById('submit').style = "visibility: visible";
            }
	}

	function getItem(){
		var item = <?php echo $voca;?>;
		return item;
	}
	window.onload = function(){
	  document.getElementById("in_en").select();
	}
</script>