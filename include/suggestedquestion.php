<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Calculator game</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </head>
<body>
	<div class="container" style='margin-top: 10px;'>
	<form action='controller.php' method='post'>
	 <input type='hidden' name='page' value="PlayPage">
	 <input type='hidden' name='command' value="back">
      <button type="submit" class="btn btn-success btn-lg">BACK</button>
	 </form>
	</div>

	<div class="container">
	<h1 style="text-align: center;" class="h1">Suggested Question and Answer</p><br>
  	<label>Question:</label>
  	<input type="text" id="question" name="question" placeholder="Question"><br><br>
  	<label>Answer 1:</label>
  	<input type="text" id="answer" name="answer" placeholder="Answer"><br><br>
	<label>Answer 2:</label>
	<input type="text" id="answer2" name="answer" placeholder="Answer"><br><br>
	<label>Answer 3:</label>
	<input type="text" id="answer3" name="answer" placeholder="Answer"><br><br>
	<label>Correct answer: </label>
	<input type="text" id="correctanswer" name="answer" placeholder="Correct Answer"><br><br>
  	<input type="button" value="Submit" class="btn btn-success btn-lg" id='suggest'>
	<p id='message'></p>
	</div>

</body>
</html>
<script>
$('#suggest').click(function(){
	var url='controller.php';
	var question_submit=$("#question").val();
	var answer_submit=$("#answer").val();
	var answer_submit2=$("#answer2").val();
	var answer_submit3=$("#answer3").val();
	var correct_answer=$("#correctanswer").val();
	var query={page: 'SuggestedQuestionPage', command: 'suggest', playername: "<?php echo $_SESSION['userName'];?>", question: question_submit, 
	answer: answer_submit, answer2: answer_submit2, answer3: answer_submit3, correctanswer: correct_answer};
	$.post(url, query, function(data){
	alert(data);
	if((JSON.parse(data)))
	$('#message').html('successful submit');
});
});

</script>