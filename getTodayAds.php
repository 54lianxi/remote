<?php
date_default_timezone_set('PRC');

require_once('init.php');
$sqllink = init();
$dateTime = date('Y-m-d H:i:s');

$sql = "select * from plan where endTime>='".$dateTime."' and beginTime<='".$dateTime."' order by planID desc limit 1";
$result = mysqli_query($sqllink, $sql);
$num_rows = mysqli_num_rows($result);

//计划列表里面没有此时需要的广告
if($num_rows <= 0){
    $sql2 = "select * from groups where is_default=1";
    $result2 = mysqli_query($sqllink, $sql2);
    $num_rows2 = mysqli_num_rows($result2);
    if($num_rows2>0){
        $arr2 = array();
        while($row = mysqli_fetch_array($result2)){
            $groupID = $row['groupID'];
            $groupName = $row['groupName'];
            $ads = $row['ads'];
            
            if(!empty($ads)){
                $ads = json_decode($ads);
                if(count($ads)>0){ 
                    for($x=0;$x<count($ads);$x++){
                        $sql2="select * from ads where ID=".$ads[$x];
                        $result2 = mysqli_query($sqllink,$sql2);
                        while($row2 = mysqli_fetch_array($result2)){
                            $adID = $row2['ID'];
                            $title = $row2['title'];
                            $smallTitle = $row2['smallTitle'];
                            $content = $row2['content'];
                            $link = $row2['link'];
                            $picture = $row2['picture'];
                            $type = $row2['type'];
                            $icon = $row2['icon'];
                            $arra = array('adID'=>$adID,'title'=>urldecode($title),'smallTitle'=>urldecode($smallTitle),'content'=>urldecode($content),'link'=>urldecode($link),'picture'=>'imgs/'.$picture,
                            'type'=>$type,'icon'=>'imgs/'.$icon);
                        }
                        array_push($arr2,$arra);
                    }

                }


            }
        }
        $arr = array('result'=>"OK",'number'=>count($ads),'list'=>$arr2);
        echo json_encode($arr);
    }else{
        $arr = array('result'=>"OK",'number'=>0,'list'=>[]);
        echo json_encode($arr);
    }
}else{
    while($row = mysqli_fetch_array($result)){
        $planID=$row['planID'];
        $beginTime=$row['beginTime'];
        $endTime=$row['endTime'];
        $groupID=$row['groupID'];
    }
    $sql2 = "select ads from groups where groupID = ".$groupID;
    $result2 = mysqli_query($sqllink ,$sql2);
    $num_rows2 = mysqli_num_rows($result2);
    if($num_rows2>0){
        $member = array();
        while($row = mysqli_fetch_array($result2)){
            $ads = $row['ads'];
        }
        if(!empty($ads)){
            
            $ads = json_decode($ads); 
            $arr2 = array();  
            if(count($ads)>0){
                for($x=0;$x<count($ads);$x++){
                    $sql2="select * from ads where ID=".$ads[$x];
                    $result2 = mysqli_query($sqllink,$sql2);
                    while($row2 = mysqli_fetch_array($result2)){
                        $adID = $row2['ID'];
                        $title = $row2['title'];
                        $smallTitle = $row2['smallTitle'];
                        $content = $row2['content'];
                        $link = $row2['link'];
                        $picture = $row2['picture'];
                        $type = $row2['type'];
                        $icon = $row2['icon'];
                        $arra = array('adID'=>$adID,'title'=>urldecode($title),'smallTitle'=>urldecode($smallTitle),'content'=>urldecode($content),'link'=>urldecode($link),'picture'=>'imgs/'.$picture,
                        'type'=>$type,'icon'=>'imgs/'.$icon);
                    }
                    array_push($arr2,$arra);
                }
                
            }
            $arr = array('result'=>"OK",'number'=>count($ads),'list'=>$arr2);
            echo json_encode($arr);

        }
        // $arr = array('result'=>"OK",'number'=>$num_rows2,'list'=>$member);
        // echo json_encode($arr);

    }else{
        $arr = array('result'=>"OK",'number'=>0,'list'=>[]);
        echo json_encode($arr);

    }
}
mysqli_close($sqllink);




?>