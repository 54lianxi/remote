<?php
require_once('init.php');
$sqllink = init();

$groupID = $_GET['groupID'];
if(empty($groupID)){
    $arr = array('result'=>'fail','reason'=>'分组ID不能为空');
    echo json_encode($arr);
    return;
}

$groupName = $_GET['groupName'];
$ads = $_GET['ads'];



if(!empty($ads)){
    $sql = "update groups set groupName = '".$groupName."',ads='".$ads."' where groupID = ".$groupID;
    // $ads = json_decode($ads);
    // $sql2 = "delete from relative where groupID = ".$groupID;
    // $result = mysqli_query($sqllink, $sql2);
    // if(count($ads)>0){     
    //     for($x =0 ; $x < count($ads) ; $x++){
    //         $sql = " insert into relative(`groupID`,`adID`) values('".$groupID."','".$ads[$x]."')";
    //         $result = mysqli_query($sqllink, $sql);
    //     }
    // }
    

}else{
    $sql = "update groups set groupName = '".$groupName."' where groupID = ".$groupID;

}

$result = mysqli_query($sqllink, $sql);
if($result){
    $arr = array('result'=>'OK');
    echo json_encode($arr);
}else{
    $arr = array('result'=>'fail','reason'=>$sql);
    echo json_encode($arr);
    return;
}

mysqli_close($sqllink);

?>