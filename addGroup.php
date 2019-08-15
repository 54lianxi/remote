<?php
$groupName = $_GET['groupName'];
if(empty($groupName)){
    $arr = array('result'=>'fail','reason'=>'分组名不能为空');
    echo json_encode($arr);
    return;
}


$ads = $_GET['ads'];

$sqllink=mysqli_connect("localhost", "nectaus1", "XYt96583!", "nectaremote");
if (mysqli_connect_errno($sqllink))
{
    die("");
}

mysqli_query($sqllink, "SET NAMES UTF8");

$sql = " insert into groups(`groupName`,`ads`) values('".$groupName."','".$ads."')";
$result = mysqli_query($sqllink, $sql);
$ID = mysqli_insert_id($sqllink);
if($result){
    $arr = array('result'=>'OK');
    echo json_encode($arr);
}else{
    $arr = array('result'=>'fail','reason'=>$sql);
    echo json_encode($arr);
}

// if(!empty($ads)){
//     $ads = json_decode($ads);
//     for($x = 0 ; $x < count($ads) ; $x++){
//         $sql = " insert into relative(`groupID`,`adID`) values('".$ID."','".$ads[$x]."')";
//         $result = mysqli_query($sqllink, $sql);
//     }
    
// }


mysqli_close($sqllink);








?>