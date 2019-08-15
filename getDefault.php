<?php
require_once('init.php');
$sqllink = init();

$sql="select * from groups where is_default=1";
$result = mysqli_query($sqllink, $sql);
if($result){
    $num_rows = mysqli_num_rows($result);
    if($num_rows>0){
        $members = array(); 
        while($row = mysqli_fetch_array($result)){
            $groupID=$row['groupID'];
            $groupName=$row['groupName'];
            $arr = array ('groupID'=>$groupID, 'groupName'=>$groupName);     
            array_push($members, $arr);
        }
        $arr = array ('result'=>"OK", 'number'=>$num_rows, 'list'=>$members);
    }else{
        $arr = array ('result'=>"OK", 'number'=>0);       
    }
}else{
    $arr = array('result'=>'fail','reason'=>$sql);
}

echo json_encode($arr);

mysqli_close($sqllink);



?>