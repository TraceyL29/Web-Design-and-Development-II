<?php


// Start the session
session_start();

//when there is no data coming from client
if (empty($_POST['page'])) {
  $display_type=null;
  $error_msg_username = null;
  $error_msg_password = null;
  include('include/startpage.php');
  exit();
}

//start page 
require('include/model.php');
if ($_POST['page']=='StartPage') {
  $command= $_POST['command'];
  switch ($command) {
    //Sign In command
    case 'SignIn':
      if (check_validity($_POST['username'], $_POST['password'])){
	$_SESSION['userName'] = $_POST['username'];
     $username= $_POST['username'];
	$id= get_user_id($_POST['username']);
	$display_type='none';
     include('include/mainpage.php');
      }
      else{
        $error_msg_username = '* Wrong username';
        $error_msg_password = '* Wrong password';
        $display_type="signin";
        include('include/startpage.php');
      }
      exit();
      break;
    //Join command
    case 'Join':
      if (check_existence($_POST['username'], $_POST['password'])){
          $error_msg_username = '* Username already exists';
		$display_type="join";
          include('include/startpage.php');
      }
      else{
		if(join_user($_POST['username'], $_POST['password'], $_POST['email']))
		$username= $_POST['username'];
		$_SESSION['userName'] = $_POST['username'];
		$display_type='none';
        include('include/mainpage.php');
      exit();
      break;
      }
    }
}

//main page
if($_POST['page']=='MainPage'){
	$command= $_POST['command'];
	switch($command){
		case 'changeprofile-unsubscribe':
		include('include/changeprofile_unsubscribe.php');
		exit();
		break;
		case 'viewscore':
		include('include/viewscore.php');
		exit();
		break;
		case 'listranking':
		include('include/listranking.php');
		exit();
		break;
		case 'suggest':
		include('include/suggestedquestion.php');
		exit();
		break;
		case 'play':
		include('include/play.php');
		exit();
		break;
		case 'share':
		include('include/sharegame.php');
		exit();
		break;
		case 'logout':
		session_unset();
        	session_destroy();
		include('include/startpage.php');
		exit();
		break;

}
}



//change profile page
if($_POST['page']=='changeprofile-unsubscribePage'){
	$command= $_POST['command'];
	switch($command){
		case 'unsubscribe':
			$userid=get_user_id($_POST['playername']);
			echo json_encode(unsubscribe($userid));
			break;
		case 'changeprofile':
			$userid=get_user_id($_SESSION['userName']);
			//player new name
			$_SESSION['userName']=$_POST['playername'];
			echo $userid;
			echo json_encode(change_profile($userid, $_POST['playername'], $_POST['playeremail'], $_POST['playerpassword']));
			break;
	    case 'back';
			include ('include/mainpage.php');
			break;
}
}

//view score page
require('include/model2.php');
if($_POST['page']=='viewscorePage'){
	$command= $_POST['command'];
	switch($command){
	case 'viewscore':
		$userid= get_user_id($_POST['playername']);
		echo json_encode(view_score($userid));
		break;
	case 'back':
		include ('include/mainpage.php');
		break;
}
}

//list ranking page
require('include/model3.php');
if($_POST['page']=='listrankingPage'){
	$command= $_POST['command'];
	switch($command){
	case 'ranking':
	$score=ranking_score();
	$name=ranking_name($score);
	echo json_encode(list_ranking($score, $name));
	break;
	case 'back':
	include ('include/mainpage.php');
}
}


//suggested question and answer page
if($_POST['page']=='SuggestedQuestionPage'){
	$command= $_POST['command'];
	switch($command){
	case 'back':
	include ('include/mainpage.php');
	break;
	case 'suggest':
	$user_id=get_user_id($_POST['playername']);
	echo json_encode(question_answer($user_id, $_POST['question'],$_POST['answer'],$_POST['answer2'],$_POST['answer3'],$_POST['correctanswer']));
}
}

//play page
if($_POST['page']=='PlayPage'){
	$command= $_POST['command'];
	switch($command){
	case 'play':
		$question_answer= get_question();
		echo json_encode($question_answer);
		break;
	case 'sendscore':
	case 'stop':
		$user_id=get_user_id($_POST['playername']);
		echo json_encode(post_score($user_id, $_POST['playerscore']));
		break;
	case 'back':
		include ('include/mainpage.php');
		break;
}
}

//share page
if($_POST['page']=='ShareGamePage'){
	$command= $_POST['command'];
	switch($command){
	case 'share':
		echo json_encode($_POST['playername'], $_POST['mail']);
		break;
	case 'back':
		include ('include/mainpage.php');
		break;
}
}

?>
