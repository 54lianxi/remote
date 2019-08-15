<?php
$array = array("planID","groupID","beginTime","endTime");
$array2 = array("计划ID","分组ID","开始时间","结束时间");

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


$sql = "update plan set groupID=".$_GET['groupID'].",beginTime='".$_GET['beginTime']."',endTime='".$_GET['endTime']."' where planID=".$_GET['planID'];
$result = mysqli_query($sqllink, $sql);
if($result){
    $arr = array('result'=>'OK');
    echo json_encode($arr);

}else{
    $arr = array('result'=>'fail','reason'=>$sql);
    echo json_encode($arr);
}



mysqli_close($sqllink);





?>