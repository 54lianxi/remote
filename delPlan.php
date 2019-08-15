<?php
$planID = $_GET['planID'];
if(empty($planID)){
    $arr = array('result'=>'fail','reason'=>'计划ID不能为空');
    echo json_encode($arr);
    return;

}

require_once('init.php');
$sqllink = init();

$sql = "delete from plan where planID=".$planID;
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