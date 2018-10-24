<?php 
    // ob_start();
    // session_start();    
    include '../connect.php';
    $sql = "SELECT * FROM `words` ";
    $query=mysqli_query($con,$sql);
    $rr = array();
    while ($row= mysqli_fetch_array($query)){
    	array_push($rr, (array)$row);
			}
		$voca = json_encode((array)$rr);
	// echo($voca);
	// echo($voca['1']['id']);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Vocabulary</title>
	<link rel="stylesheet" type="text/css" href="../asset/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../asset/css/style.css">
    <script type="text/javascript" src="../asset/js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../asset/js/bootstrap.js"></script>
</head>
<body>
	<div class="container">
		<h1 class="text-center text-success">
			VOCABULARY
		</h1>
		
			<div class="col-lg-12 col-sm-12" style="padding: 0; margin-bottom: 10px;">
				<div style="border: 1px solid #007BFF; border-radius: 10px;">
					<table class="table text-center">
						<thead class="text-info">
							<tr>
								<th scope="col">English</th>
								<th scope="col">Vietnamese</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td id="word_en">Hello</td>
								<td id="word_vn">...?</td>
							</tr>
							
						</tbody>
					</table>
				</div>
			</div>
		<div class="row">
			<!-- réponse -->
			<div class="col-lg-6 col-sm-12">
				<div style="border: 1px solid #007BFF; border-radius: 10px;margin-bottom: 10px;padding: 10px;">

					<h4 class="text-warning text-center" >
						True: <span class="text-success" id="score"></span>  False: <span class="text-danger" id="score_false"></span>
					</h4>
					<div class="alert alert-success text-center" id="alert">
						<strong id="alert_chose">chose the best aswer!</strong> 
					</div>
					<!-- <div class="alert alert-success" style="display: none;">
						<strong>Success!</strong> Indicates a successful or positive action.
					</div> -->
				</div>
			</div>


			<!-- request -->
			<div class="col-lg-6 col-sm-12">
				<div class="" id="answer">
					<!-- Group of default radios - option 1 -->
					<?php
					// $arr = array(
					// 	"<div class='custom-control custom-radio'>
					// 	 <button class='btn btn-success btchoice' onclick='choice(1)' >A.</button>
					// 	<label id='word_choice1' for='word1'>Option 1</label>
					// </div><div class='space'></div>",
					// 	"<div class='custom-control custom-radio'>
					// 	 <button class='btn btn-success btchoice' onclick='choice(2)' >B.</button>
					// 	<label id='word_choice2' for='word2'>Option 2</label>
					// </div><div class='space'></div>",
					// "<div class='custom-control custom-radio'>
					// 	 <button class='btn btn-success btchoice' onclick='choice(3)' >C.</button>
					// 	<label id='word_choice3' for='word3'>Option 3</label>
					// </div><div class='space'></div>"
					// );
					// $arr_select = array(0,1,2,);
					// shuffle($arr);
					// foreach ($arr as $key => $value) {
					// 	echo $value;
					// 	switch ($key) {
					// 		case '1':
					// 			# code...
					// 			break;
					// 		case '2':
					// 			# code...
					// 			break;
					// 		case '2':
					// 			# code...
					// 			break;
					// 	}
					// }
					
					?>
					
					<div class='custom-control custom-radio'>
						 <button class='btn btn-success btchoice' onclick='choice(1)' >A.</button>
						<label id='word_choice1' for='word1'>Option 1</label>
					</div>
					<div class='space'></div>
					<!-- Group of default radios - option 2 -->
					<div class="custom-control custom-radio" >
						
						<button class="btn btn-success btchoice " onclick="choice(2)">B.</button>
						<label id="word_choice2"  class=" " for="word2">Option 2</label>
					</div>
					<div class='space'></div>
					
					<!-- Group of default radios - option 3 -->
					<div class="custom-control custom-radio" >
						
						<button class="btn btn-success btchoice" onclick="choice(3)">C.</button>
						<label class="" id="word_choice3" for="word3">Option 3</label>
					</div>
				</div>
			
			</div>

		</div>

	</div>
</body>
</html>
<script type="text/javascript">
	var score = 0;
	var score_false = 0;
	var audio_true = new Audio('../asset/audio/true.wav');
	var audio_false = new Audio('../asset/audio/false.wav');
	
	function render() {
		var item = getItem();
		// console.log(item.length);
		var i = Math.floor((Math.random() * item.length));
		var arr = [item[i].vn,item[i].vn_f1,item[i].vn_f2];
		shuffle(arr);
		console.log(arr);
		document.getElementById('word_en').innerHTML = item[i].en;
		document.getElementById('word_choice1').innerHTML = item[i].vn;
		document.getElementById('word_choice2').innerHTML = item[i].vn_f1;
		document.getElementById('word_choice3').innerHTML = item[i].vn_f2;
		document.getElementById("score").innerHTML = score;
		document.getElementById("score_false").innerHTML = score_false;
	}

	function choice(choice){
		var choice_sub = "word"+choice;

		switch(choice) {
		    case 1:
		        document.getElementById("alert_chose").innerHTML = "Correct!";
		        document.getElementById("alert_chose").className = "text-success";
		        score +=1;
		        audio_true.play();
		        break;
		    case 2:
		        document.getElementById("alert_chose").innerHTML = "Incorrect";
		        document.getElementById("alert_chose").className = "text-danger";
		        audio_false.play();
		        score_false++;
		        break;
		    case 3:
		        document.getElementById("alert_chose").innerHTML = "Incorrect";
		        document.getElementById("alert_chose").className = "text-danger";
		        audio_false.play();
		        score_false++;
		        break;
		    // default:
		    //     document.getElementById("alert").style = "visibility: visible;opacity: 0;transition: visibility 0s linear 1000ms, opacity 1000ms;";
		}
		render();
		console.log(choice_sub);
	}
	function shuffle(array) {
    let counter = array.length;

    // While there are elements in the array
    while (counter > 0) {
        // Pick a random index
        let index = Math.floor(Math.random() * counter);

        // Decrease counter by 1
        counter--;

        // And swap the last element with it
        let temp = array[counter];
        array[counter] = array[index];
        array[index] = temp;
    }

    return array;
}
	function getItem(){
		var item = <?php echo (json_encode((array)$rr)) ?>;
		return item;
	}
	render();
</script>