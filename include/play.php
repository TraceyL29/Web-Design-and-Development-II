
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Calculator game</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
	#timer, #score, #accuracy{
	font-size: 200%;
	}
	#stop{
	display: table-cell;
	}
	.btn-primary{
	width: 20%;	
	}
    </style>
  </head>


  <body>
	<div class="container" style="margin-top: 10px;">
	<form action='controller.php' method='post'>
	 <input type='hidden' name='page' value="PlayPage">
	 <input type='hidden' name='command' value="back">
      <button type="submit" class="btn btn-success btn-lg" id='back'>BACK</button>
	</form>
	</div>
	<div class="container" style=" width: 100%; text-align: center;">
	<button type='button' class='btn btn-success btn-lg' id='stop'>Stop!Save score</button>
	</div>

    <div class="container" style="border-color: red; border-style: solid; width: 500px; height: 100px; text-align: center;">
      <p id="timer">timer</p>
    </div>

    <div class="container" style="border-color: red; border-style: solid; width: 500px; height: 100px; text-align: center;">
      <p id="score">score</p>
     </div>

     <div class="container" style="border-color: red; border-style: solid; width: 500px; height: 100px; text-align: center;">
        <p id="equation">equation</p>
	</div>

     <div class="container" id="button" style="border-color: red; border-style: solid;   width: 1200px; height: 100px; text-align: center;">
		<button type="button" class="btn btn-primary btn-lg" id="answer1">Info</button>
		<button type="button" class="btn btn-primary btn-lg" id="answer2">Info</button>
		<button type="button" class="btn btn-primary btn-lg" id="answer3">Info</button>
      </div>
   
	<div class="container" style="border-color: red; border-style: solid;   width: 500px; height: 100px; text-align: center;">
	<p id='accuracy'></p>
	</div>

  </body>
</html>

<script>
	var usedquestion=[];
	var positionAns;
	var question=[];
	var answer=[];
	var answer2=[];
	var answer3=[];
	var correctanswer=[];
	var score=0;
     var interval;
	var seconds_left=0;
	var correct_answer=0;
	var wrong_answer=0;
	var url='controller.php';
	var accuracy=0;
	var wrong_check=true;
	var query={page: 'PlayPage', command: 'play'};
	$.post(url, query, function(data){
	var rows=JSON.parse(data);
	//alert('data'+data);
	//create arrays that contain question, answers and correct answer
	for(var i=0; i< rows.length; i++){
		for(var p in rows[i]){
		if(p=='question'){	
			question.push(rows[i][p]);}
		else if(p=='answer'){
			answer.push(rows[i][p]);}
		else if(p=='answer2'){
			answer2.push(rows[i][p]);}
		else if(p=='answer3'){
			answer3.push(rows[i][p]);}
		else if(p=='correctanswer'){
			correctanswer.push(rows[i][p]);}
	}
}
	
	var indexQuestion= Math.floor(Math.random()*question.length);
	usedquestion.push(indexQuestion);

//start the first equation
	positionAns=set_equation_answer(indexQuestion,question,answer, answer2, answer3, correctanswer);	
	timer();

	//stop click 
	$('#stop').click(function(){
		clearInterval(interval);
		var url='controller.php';
		var query={page: 'PlayPage', command: 'stop',playername: "<?php echo $_SESSION['userName'];?>", playerscore: score};
		$.post(url, query, function(data){
			if(data=='true'){
				//alert('Score send');
				//alert('Number of question:'+usedquestion.length);
				//alert('wrong answer points: '+wrong_answer);
				if(score==0){
					$('#accuracy').html('Accuracy: 0%');}
				else{
				var accuracy= (((usedquestion.length*5+wrong_answer)/5)/(usedquestion.length))*100;
				$('#accuracy').html('Accuracy: '+accuracy.toFixed(0)+'%');
				}
		}		
		});	
	});
	
	//answer1 button click
	$('#answer1').click(function() {

	//alert('wrong_answer top'+wrong_answer);

	//correct answer click 

	if(positionAns==1){
		score+=5;
		correct_answer+=5;
		$('#score').html(score);

	//check if the array still have questions or not 
		if(usedquestion.length < question.length){
		var bool=true;

		//random index
		indexQuestion= Math.floor(Math.random()*question.length);

		//while loop to check if the index is taken or not
		while(bool){
			var check = search(usedquestion, indexQuestion);
			if(check){
			indexQuestion= Math.floor(Math.random()*question.length);
			}else{

			//if the index question has not been used, put in the usedquestion array
			usedquestion.push(indexQuestion);
			bool=false;
			}
		
		}
		clearInterval(interval);
		timer();
		set_equation_answer(indexQuestion, question, answer, answer2, answer3, correctanswer);
		wrong_check=true;
		}
		
	//out of question
		else{
		clearInterval(interval);
		var url='controller.php';
		var query={page: 'PlayPage', command: 'stop',playername: "<?php echo $_SESSION['userName'];?>", playerscore: score};
		$.post(url, query, function(data){
			if(data=='true'){
				//alert('Score send');
				//alert('Number of question:'+usedquestion.length);
				//alert('wrong answer points: '+wrong_answer);
				if(score==0){
					$('#accuracy').html('Accuracy: 0%');
				}else{
				var accuracy= (((usedquestion.length*5+wrong_answer)/5)/(usedquestion.length))*100;
				$('#accuracy').html('Accuracy: '+accuracy.toFixed(0)+'%');
				}
		}		
	});	
	
	}
	}else{
		if(wrong_check){
		//wrong answer variable only counts one time even user clicks wrong twice in the same equation, used for calculating accuracy 
		wrong_answer-=5;
		//alert('wrong_answer'+wrong_answer+'points');
		wrong_check=false;
		}
		//score variable used for display
		score-=5;
		$('#score').html(score);}
	});



	$('#answer2').click(function() {
	//alert('wrong_answer top'+wrong_answer);

	if(positionAns==2){
		score+=5;
		correct_answer+=5;
		$('#score').html(score);
		if(usedquestion.length < question.length){
		var bool=true;
		indexQuestion= Math.floor(Math.random()*question.length);
		while(bool){
			var check = search(usedquestion, indexQuestion);
			if(check){
			indexQuestion= Math.floor(Math.random()*question.length);
			}else{
			usedquestion.push(indexQuestion);
			bool=false;
			}
		}
		clearInterval(interval);
		timer();
		set_equation_answer(indexQuestion, question, answer, answer2, answer3, correctanswer);
		wrong_check=true;
	}
		else{
		alert('out of question');	
		clearInterval(interval);
		var url='controller.php';
		var query={page: 'PlayPage', command: 'stop',playername: "<?php echo $_SESSION['userName'];?>", playerscore: score};
		$.post(url, query, function(data){
			if(data=='true'){
				//alert('Score send');
				//alert('Number of question:'+usedquestion.length);
				//alert('wrong answer points: '+wrong_answer);
				if(score==0){
					$('#accuracy').html('Accuracy: 0%');
				}else{
				var accuracy= (((usedquestion.length*5+wrong_answer)/5)/(usedquestion.length))*100;
				$('#accuracy').html('Accuracy: '+accuracy.toFixed(0)+'%');
				}
	}		
	});	
	
		
	}
	}else{
		if(wrong_check){
		wrong_answer-=5;
		//alert('wrong_answer'+wrong_answer+'points');
		wrong_check=false;}
		
		score-=5;
		$('#score').html(score);

	}
	});


	$('#answer3').click(function() {
	//alert('wrong_answer top'+wrong_answer);

	if(positionAns==3){			
		score+=5;
		correct_answer+=5;
		$('#score').html(score);
		if(usedquestion.length < question.length){

		var bool=true;
		indexQuestion= Math.floor(Math.random()*question.length);
		while(bool){
			
			var check = search(usedquestion, indexQuestion);
			if(check){
			indexQuestion= Math.floor(Math.random()*question.length);
			}else{
			usedquestion.push(indexQuestion);
			bool=false;
			}
		}
	
		clearInterval(interval);
		timer();
		set_equation_answer(indexQuestion, question, answer, answer2, answer3, correctanswer);
		wrong_check=true;
	}
		else{
		alert('out of question');
		clearInterval(interval);
		var url='controller.php';
		var query={page: 'PlayPage', command: 'stop',playername: "<?php echo $_SESSION['userName'];?>", playerscore: score};
		$.post(url, query, function(data){
			if(data=='true'){
				//alert('Score send');
				//alert('Number of question:'+usedquestion.length);
				//alert('wrong answer points: '+wrong_answer);
				if(score==0){
					 $('#accuracy').html('Accuracy: 0%');
				}
				else{
				var accuracy= (((usedquestion.length*5+wrong_answer)/5)/(usedquestion.length))*100;
				$('#accuracy').html('Accuracy: '+accuracy.toFixed(0)+'%');
				}
	}		
	});	
	
		}
	}
		else{
		if(wrong_check){
		wrong_answer-=5;
		//alert('wrong_answer'+wrong_answer+'points');
		wrong_check=false;}
		score-=5;
		$('#score').html(score);

	}
	});



function timer(){
      seconds_left = 60;
      interval = setInterval(function() {
      document.getElementById('timer').innerHTML = "00 : "+(--seconds_left)+"s";
      if (seconds_left <= 0)
        {
           document.getElementById('timer').innerHTML = 'Time out';
		clearInterval(interval);
		 var url='controller.php';
		//sending scofe if time out 
     	 var query={page: 'PlayPage', command: 'sendscore', playername: "<?php echo $_SESSION['userName'];?>", playerscore: score};
            $.post(url, query, function(data){
				if(data=='true'){ 
					//alert('wrong asnswer points'+wrong_answer+'used'+usedquestion.length);
					alert(score);
					if(score == 0) {
						$('#accuracy').html('Accuracy: 0%');
						}else{
				 	accuracy= (((usedquestion.length*5+wrong_answer)/5)/(usedquestion.length))*100;
					$('#accuracy').html('Accuracy: '+accuracy.toFixed(0)+"%");
					}
				}

			});
          }
      }, 1000);
      }		 	

function positionRan(){
      var position;
      position=Math.floor((Math.random() * 3) + 1);
      return position;	
     }

function search(array, elementsearch){
	for(var i=0; i<array.length; i++){
		if(elementsearch==array[i])
			return true;
}
	return false;
}
function set_equation_answer(indexQuestion, question, answer, answer2, answer3, correctanswer){
	 positionAns= positionRan();
	//random position for correct answer
	if(positionAns==1){
		$('#equation').html(question[indexQuestion]);
		$('#answer1').html(correctanswer[indexQuestion]);
	//if correct answer has been placed radomly at certain button, the other buttons will have wrong answers
		if(correctanswer[indexQuestion]==answer[indexQuestion]){
		$('#answer2').html(answer2[indexQuestion]);
		$('#answer3').html(answer3[indexQuestion]);
		}
		else if(correctanswer[indexQuestion]==answer2[indexQuestion]){
		$('#answer2').html(answer[indexQuestion]);
		$('#answer3').html(answer3[indexQuestion]);
		}
		else if(correctanswer[indexQuestion]==answer3[indexQuestion]){
		$('#answer2').html(answer[indexQuestion]);
		$('#answer3').html(answer2[indexQuestion]);
		}
	}
	else if(positionAns==2){
		$('#equation').html(question[indexQuestion]);
		$('#answer2').html(correctanswer[indexQuestion]);
		if(correctanswer[indexQuestion]==answer[indexQuestion]){
		$('#answer1').html(answer2[indexQuestion]);
		$('#answer3').html(answer3[indexQuestion]);
		}
		else if(correctanswer[indexQuestion]==answer2[indexQuestion]){
		$('#answer1').html(answer[indexQuestion]);
		$('#answer3').html(answer3[indexQuestion]);
		}
		else if(correctanswer[indexQuestion]==answer3[indexQuestion]){
		$('#answer1').html(answer[indexQuestion]);
		$('#answer3').html(answer2[indexQuestion]);
		}
	}else{
		$('#equation').html(question[indexQuestion]);
		$('#answer3').html(correctanswer[indexQuestion]);
		if(correctanswer[indexQuestion]==answer[indexQuestion]){
		$('#answer1').html(answer2[indexQuestion]);
		$('#answer2').html(answer3[indexQuestion]);
		}
		else if(correctanswer[indexQuestion]==answer2[indexQuestion]){
		$('#answer1').html(answer[indexQuestion]);
		$('#answer2').html(answer3[indexQuestion]);
		}
		else if(correctanswer[indexQuestion]==answer3[indexQuestion]){
		$('#answer1').html(answer[indexQuestion]);
		$('#answer2').html(answer2[indexQuestion]);
		}
	}
	
	return positionAns;
}

});




   </script>
