<?php
$groupID = $_GET['groupID'];
if(empty($groupID)){
    $arr = array('result'=>'fail','reason'=>'分组ID不能为空');
    echo json_encode($arr);
    return;

}

require_once('init.php');
$sqllink = init();

$sql = "delete from groups where groupID=".$groupID;
$result = mysqli_query($sqllink, $sql);

if($result){
    $arr = array('result'=>'OK');
    echo json_encode($arr);

}else{
    $arr = array('result'=>'fail','reason'=>$sql);
    echo json_encode($arr);
    return;
}

// $sql2 = "delete from relative where groupID = ".$groupID;
// mysqli_query($sqllink, $sql2);


mysqli_close($sqllink);





?>