	var score = 0;
	var score_false = 0;
	var audio_true = new Audio('../asset/audio/true.wav');
	var audio_false = new Audio('../asset/audio/false.wav');
	var vn = "";
	function render() {
		var item = getItem();
		// console.log(item.length);
		var i = Math.floor((Math.random() * item.length));
		var arr = [item[i].vn,item[i].vn_f1,item[i].vn_f2];
		var arr_shuffle = arr;
		shuffle(arr_shuffle);
		console.log(arr_shuffle);
		en = item[i].vn;
		document.getElementById('word_en').innerHTML = item[i].en;
		document.getElementById('word_choice1').innerHTML = arr_shuffle[0];
		document.getElementById('word_choice2').innerHTML = arr_shuffle[1];
		document.getElementById('word_choice3').innerHTML = arr_shuffle[2];
		document.getElementById("score").innerHTML = score;
		document.getElementById("score_false").innerHTML = score_false;
	}
	function test(vn,text){
		if (text == vn) {
			score +=1;
		    audio_true.play();
		}
		else{
			audio_false.play();
		    score_false++;
		}
	}
	function choice(choice){
		var choice_sub = "word"+choice;

		switch(choice) {
		    case 1:
		        document.getElementById("alert_chose").innerHTML = "Correct!";
		        document.getElementById("alert_chose").className = "text-success";
				var text = $('#word_choice1').text();
		        test(en,text);
		        break;
		    case 2:
		        document.getElementById("alert_chose").innerHTML = "Incorrect";
		        document.getElementById("alert_chose").className = "text-danger";
				var text = $('#word_choice2').text();
		        test(en,text);
		        break;
		    case 3:
		        document.getElementById("alert_chose").innerHTML = "Incorrect";
		        document.getElementById("alert_chose").className = "text-danger";
				var text = $('#word_choice3').text();
		        test(en,text);
		        break;
		    
		}
		render();
		console.log(text);
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