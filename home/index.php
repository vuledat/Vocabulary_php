<?php   
    include '../connect.php';
	
	$startTime = date("Y-m-d H:i:s");
    $date_curently = date("Y-m-d H:i:s",  strtotime($startTime)-86400);
    
    $sql = "SELECT `en`, `vn`, `mem`, `vn_f1`, `vn_f2` FROM `words` ";
    $sql2 = "SELECT `en`, `vn`, `mem`, `vn_f1`, `vn_f2` FROM `words` WHERE `created_at`> '$date_curently'";
    $query=mysqli_query($con,$sql);
    $query2=mysqli_query($con,$sql2);
    $rr = array();
    $rr2 = array();
    while ($row= mysqli_fetch_array($query)){
    	array_push($rr, (array)$row);
			}
	while ($row= mysqli_fetch_array($query2)){
    	array_push($rr2, (array)$row);
			}

		$voca = json_encode((array)$rr);
		$voca2 = json_encode((array)$rr2);


	// echo ;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Vocabulary</title>
	<link rel="stylesheet" type="text/css" href="../asset/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../asset/css/style.css">
    <script type="text/javascript" src="../asset/js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../asset/js/bootstrap.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<h1 class="text-center text-success">
			<a href="http://localhost/Vocabulary_php/home/">VOCABULARY</a>
			
		</h1>
		
			<div class="col-lg-12 col-sm-12 col-md-12" style="padding: 0; margin-bottom: 10px;">
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
			


			<!-- request -->
			<div class="col-lg-6 col-sm-12 col-md-12">
				<div class="space" style="position: relative;padding: 20px;height: 170px;">
					<div class="answer"></div>
					
					<!-- Group of default radios - option 1 -->	
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

			<!-- réponse -->
			<div class="col-lg-6 col-sm-12 col-md-12">
				<div style="margin-bottom: 10px;padding: 10px; position: relative;">
					<div class="answer"></div>
					<h4 class="text-success text-center" >
						<i class="fas fa-check"></i> <span class="text-success" id="score"></span>  <span class="text-danger" id="score"> <i class="fas fa-times"></i> </span><span class="text-danger" id="score_false"></span>
					</h4>
					<div class=" text-success text-center" id="alert">
						<strong id="alert_chose"><h5>chose</h5></strong> 
					</div>
					<div class="" style="">
						<div style="">
							<table class="table text-center">
								<thead class="text-info">
									<tr>
										<th scope="col">English</th>
										<th scope="col">Vietnamese</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td id="word_en_answer">...</td>
										<td id="word_vn_answer">...</td>
									</tr>

								</tbody>
							</table>
						</div>
					</div>
					<!-- <div class="alert alert-success" style="display: none;">
						<strong>Success!</strong> Indicates a successful or positive action.
					</div> -->
				</div>
			</div>

		</div>

		<h5 class="text-center"> 
			<span id="demo">A</span>
			<span id="tested" class="text-center text-warning">50</span> 
			<span id="total" class="text-center text-danger">100</span> 
		</h5>

		<div id="list" style="display: none;">
			<table class="table text-center">
								<thead class="text-info">
									<tr>
										<th scope="col">English</th>
										<th scope="col">Vietnamese</th>
									</tr>
								</thead>
								<tbody id="list_tr">
									<?php
										foreach ($rr as $key => $value) {
											?>
									
									<tr>
										<td id="word_en_list"><?php echo $value['en']; ?></td>
										<td id="word_vn_list"><?php echo $value['vn'] ?></td>
									</tr>
									<?php
											
										}
									?>
								</tbody>
							</table>
		</div>
	</div>
	
</body>

</html>
<!-- progress -->
	
<div id="progress_bg">
	
	<div id="progress">

	</div>
</div>

<div id="try">
	<div class="text-center" style="padding: 20%; ">

		<button class="btn btn-success" onclick="try_again()">
			Your Score is: <h5 class="text-center text-danger" id="score_try">5</h5>
			Try Again
		</button>
	</div>
</div>

<div id="sound" onclick="sound()">
	<i id="sound_on" class="fas fa-volume-up"></i>
	<i id="sound_off" class="fas fa-microphone-alt-slash"></i>
	<i id="new"  class="fab fa-neos fa-3x" onclick="load_new()"></i>
</div>


<script type="text/javascript">
	var score = 0;
	var score_false = 0;
	var audio_true = new Audio('../asset/audio/true.wav');
	var audio_false = new Audio('../asset/audio/false.wav');
	var vn = "";
	var en  ="";
	var rr = <?php echo ($voca) ?>;
	var count = 5;
	var delay = 1000;

	var item_default = getItem(rr);
	var item = getItem(rr);
	var total = item_default.length;

	function render() {
		
		
		if (item.length > 0) 
		{
			var i = Math.floor((Math.random() * item.length));
			var arr = [item[i].vn,item[i].vn_f1,item[i].vn_f2];
			var arr_shuffle = arr;
			shuffle(arr_shuffle);
			
			vn = item[i].vn;
			en = item[i].en;
			document.getElementById('total').innerHTML = total +' words';
			document.getElementById('word_en').innerHTML = item[i].en;
			document.getElementById('word_choice1').innerHTML = arr_shuffle[0];
			document.getElementById('word_choice2').innerHTML = arr_shuffle[1];
			document.getElementById('word_choice3').innerHTML = arr_shuffle[2];
			document.getElementById("score").innerHTML = score;
			document.getElementById("score_false").innerHTML = score_false;
			document.getElementById("tested").innerHTML = score_false+score;
			item.splice(i,1);
		}

		else{
			var audio_win = new Audio('../asset/audio/win.mp3');
			audio_win.play();
			document.getElementById("try").style = "display: block";
			// alert("Your Score is: "+ score);
			document.getElementById("score_try").innerHTML = score;
			item = getItem(rr);
			score = 0;
			score_false = 0;

		}
		
	}
	function try_again(){
		rr = <?php echo ($voca) ?>;
		item_default = getItem(rr);
		item = getItem(rr);
		total = item_default.length;
		score = 0;
		score_false = 0;
		render();
	}
	function load_new() {
		rr = <?php echo ($voca2) ?>;
		item_default = getItem(rr);
		item = getItem(rr);
		total = item_default.length;
		score = 0;
		score_false = 0;
		render();
		console.log(item_default.length);
	}

	function restart(){
        var conf=confirm("Your Score is:");
        item = item_default;
        score = 0;
       	score_false = 0;
		var i = Math.floor((Math.random() * item.length));
        return conf;
    }
	
	function test(vn,text){
		if (text == vn) {
			score +=1;
		    audio_true.play();
		    document.getElementById("alert_chose").innerHTML = "Correct!";
		    document.getElementById("alert_chose").className = "text-success";
		}
		else{
			audio_false.play();
			document.getElementById("alert_chose").innerHTML = "Incorrect";
		    document.getElementById("alert_chose").className = "text-danger";
		    score_false++;
		}
	}

	function answer(en,vn) {
		document.getElementById('word_en_answer').innerHTML = en;
		document.getElementById('word_vn_answer').innerHTML = vn;
	}

	function choice(choice){
		var choice_sub = "word"+choice;
		answer(en,vn);
		count = 5;
		switch(choice) {
		    case 1:
		        
				var text = $('#word_choice1').text();
		        test(vn,text);
		        break;
		    case 2:
		       
				var text = $('#word_choice2').text();
		        test(vn,text);
		        break;
		    case 3:
		        
				var text = $('#word_choice3').text();
		        test(vn,text);
		        break;
		    // default:
		    //     document.getElementById("alert").style = "visibility: visible;opacity: 0;transition: visibility 0s linear 1000ms, opacity 1000ms;";
		}

		render();
		// count_down();
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
	
	
	function count_down() {
		var x = setInterval(function() {
	    if (count >=0) {
	    	// score_false++;
	    	document.getElementById("demo").innerHTML = "Time: " + count;
	    	document.getElementById("progress").style = "width: "+((score_false + score)/total)*100+"%";
	    	count--;
	    }
	    else{
	    	render();
	    	count = 5;
	    	audio_false.play();
	    }
	    
	}, 1000);
	}

	count_down();
	function getItem(arr){
		var item = arr;
		return item;
	}
	render();
	var set_sound = 0;
	function sound(argument) {
		
		if (set_sound == 0) {
			set_sound = 1;
			audio_true = new Audio("../asset/audio/silent.mp3");
			audio_false = new Audio("../asset/audio/silent.mp3");
			document.getElementById('sound_on').style = "visibility: visible";
			document.getElementById('sound_off').style = "visibility: hidden";
			console.log("click");
		}
		if (set_sound){
			
			audio_true = new Audio('../asset/audio/true.wav');
			audio_false = new Audio('../asset/audio/false.wav');
			document.getElementById('sound_on').style = "visibility: hidden";
			document.getElementById('sound_off').style = "visibility: visible";
		}

	}

	$("#total").click(function(){
        $("#list").toggle(1000);
        var words = getItem(rr);
        
       	
       	
    });

    $("#try").click(function(){
        $("#try").fadeOut(1000);
       
    });
</script>