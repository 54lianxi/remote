<?php
$groupID = $_GET['groupID'];
if(empty($groupID)){
    $arr = array('result'=>'fail','reason'=>'分组ID不能为空');
    echo json_encode($arr);
    return;
}

require_once('init.php');
$sqllink = init();

$sql = "update groups set is_default=NULL";
$result = mysqli_query($sqllink, $sql);

if(!$result){
    $arr = array('result'=>'fail','reason'=>$sql);
    echo json_encode($arr);
    return;
}
$sql2 = "update groups set is_default=1 where groupID=".$groupID;
$result2 = mysqli_query($sqllink, $sql2);
if($result2){
    $arr = array('result'=>'OK');
    echo json_encode($arr);
}else{
    $arr = array('result'=>'fail','reason'=>$sql2);
    echo json_encode($arr);
}


mysqli_close($sqllink);


?>