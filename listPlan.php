<?php
require_once('init.php');
$sqllink = init();


$planID = $_GET['planID'];

$sql="select a.planID,a.beginTime,a.endTime,a.groupID,b.groupName from plan a left join groups b on a.groupID = b.groupID order by a.planID DESC";
if(!empty($planID)){
    $sql=$sql." where planID=".$planID;
}
$result = mysqli_query($sqllink, $sql);
$num_rows = mysqli_num_rows($result);
if($num_rows <= 0){
    $arr = array ('result'=>"OK", 'number'=>0);
    echo json_encode($arr);
}else{
    $members = array(); 
    while($row = mysqli_fetch_array($result)){
        $planID=$row['planID'];
        $beginTime=$row['beginTime'];
        $endTime=$row['endTime'];
        $groupID=$row['groupID'];
        $groupName=$row['groupName'];
        $arr = array ('planID'=>$planID, 'beginTime'=>$beginTime,'endTime'=>$endTime, 
                'groupID'=>$groupID,'groupName'=>$groupName);
                
        array_push($members, $arr);
    }
    $arr = array ('result'=>"OK", 'number'=>$num_rows, 'list'=>$members);
    echo json_encode($arr);
}

mysqli_close($sqllink);

?>