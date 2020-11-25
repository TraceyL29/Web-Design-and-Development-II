<?php
$conn = mysqli_connect('localhost', 'tlaif20', 'independentlife', 'C354_tlaif20');
if (mysqli_connect_errno())
    echo 'Failed to connect to SQL: ' . mysqli_connect_error();
// view score 
function view_score($userid){
    global $conn;  
    $sql = "select * from Score where userid='$userid'";
    $result = mysqli_query($conn, $sql);
    $data = [];
    while($row = mysqli_fetch_assoc($result))
        $data[] = $row;
    return $data;
}

//ranking score
function ranking_score(){
	global $conn;
	//sort the result in descending order
	$sql="select * from Score order by score DESC";
	$result= mysqli_query($conn, $sql);
	$array=[];
	$ranking=[];
	$test=true;
	$current_position=0;
	while($row=mysqli_fetch_assoc($result)){
		if($test){
			$ranking[]=$row;
			$test=false;
		}
		//if the username have been taken, eliminate the same username 		
		if(!search($ranking,$row['userid'])){	
  			$ranking[]=$row;		
	}
	$array[$current_position++]=$row['userid'];
	}
	return $ranking;	
}

//search the value 
function search($array, $elementsearch){
	for($i=0; $i<count($array); $i++){
		foreach($array[$i] as $key=>$value){
			if($key=='userid'){
				if($elementsearch == $value) return true;
			}
			
		}		
	}
	return false;
}

//ranking name
function ranking_name($array){
	global $conn;
	$array_id=[];
	
	for($i=0; $i<count($array); $i++){
		foreach($array[$i] as $key=>$value)
		{
		
		if($key=='userid'){
			$array_id[]=$value;
			}
	}
	
	}
	for($p=0; $p<count($array_id); $p++){
	$id=$array_id[$p];

	$sql="select username from Players where id='$id'";
	$result= mysqli_query($conn, $sql);
	$array_name[]=mysqli_fetch_assoc($result);
	}
	return $array_name;
	}

//combine 2 arrays
function list_ranking($name, $score){
	$list=array($name, $score);
	return $list;
}



?>