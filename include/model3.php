<?php
$conn = mysqli_connect('localhost', 'tlaif20', 'independentlife', 'C354_tlaif20');
if (mysqli_connect_errno())
    echo 'Failed to connect to SQL: ' . mysqli_connect_error();
//insert question and answers/correct answer into table 
function question_answer($userid,$question, $answer, $answer2, $answer3, $correctanswer){
		global $conn;
		$sql= "insert into SuggestedQuestion (id, userid, question, answer, answer2, answer3, correctanswer) values (NULL, '$userid', '$question', '$answer', '$answer2','$answer3','$correctanswer')";
		if(mysqli_query($conn, $sql)){
		return TRUE;
		}
		else{
		return FALSE;
		}

}

function get_question(){
	global $conn;
	$sql= "select question, answer, answer2, answer3, correctanswer from SuggestedQuestion";
	$result= mysqli_query($conn, $sql);
	$question_answer=[];
	while($rows= mysqli_fetch_assoc($result))
		$question_answer[]= $rows;
	return $question_answer;
}

function post_score($userid, $playerscore){
	global $conn; 
	$current_date = date("Ymd");
	$sql= "insert into Score (id, userid, score, date) values (NULL, $userid, $playerscore,$current_date)";
	$result=mysqli_query($conn, $sql);
	if($result){return true;}
	else{return false;}
}

function share_game($playername, $sendto){
	$header='From'.$playername;
	if(@mail('<'.$sendto.'>',"Calculator Game","http://cs.tru.ca/~tlaif20/Project/controller.php", $header))
	return true;
	else
	return false;
}
?>