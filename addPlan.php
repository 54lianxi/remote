<?php
$array = array("groupID","beginTime","endTime");
$array2 = array("分组ID","开始时间","结束时间");

for($x=0 ; $x<count($array) ; $x++){
    $one = $_GET[$array[$x]];
    if(empty($one)){
        $arr = array('result'=>'fail','reason'=>$array2[$x].'不能为空');
        echo json_encode($arr);
        return;
    }
}

require_once('init.php');
$sqllink = init();


$sql = "insert into plan(`groupID`,`beginTime`,`endTime`) values('".$_GET['groupID']."','".$_GET['beginTime']."','".$_GET['endTime']."')";
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