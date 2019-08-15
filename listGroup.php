<?php

require_once('init.php');
$sqllink=init();

$sql = "select * from groups";
$result = mysqli_query($sqllink, $sql);
$num_rows = mysqli_num_rows($result);
if($num_rows <= 0){
    $arr = array('result'=>'OK','number'=>0);
    echo json_encode($arr);
}else{
    $members = array();
    while($row = mysqli_fetch_array($result)){
        $groupID = $row['groupID'];
        $groupName = $row['groupName'];
        $ads=$row['ads'];
        $arr2 = array();
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
            $member2 = array('groupID'=>$groupID,'groupName'=>$groupName,'ads'=>$arr2);
            array_push($members,$member2);
            // $arr = array('result'=>'OK','number'=>$num_rows,'list'=>$member2);
            // echo json_encode($arr);

        }else{
            $member2 = array('groupID'=>$groupID,'groupName'=>$groupName,'ads'=>$arr2);
            array_push($members,$member2);
        }



        // $sql2="select a.*,b.* from relative a left join ads b on a.adID=b.ID where groupID=".$groupID;
        // $result2 = mysqli_query($sqllink, $sql2);
        // $num_rows2 = mysqli_num_rows($result2);
        // $array = array();
        // if($num_rows2 >0){
            
        //     while($row2 = mysqli_fetch_array($result2)){
        //         $adID = $row2['adID'];
        //         $title = $row2['title'];
        //         $smallTitle = $row2['smallTitle'];
        //         $content = $row2['content'];
        //         $link = $row2['link'];
        //         $picture = $row2['picture'];
        //         $type = $row2['type'];
        //         $icon = $row2['icon'];
        //         $arra = array('adID'=>$adID,'title'=>urldecode($title),'smallTitle'=>urldecode($smallTitle),'content'=>urldecode($content),'link'=>urldecode($link),'picture'=>'imgs/'.$picture,
        //         'type'=>$type,'icon'=>'imgs/'.$icon);
        //         array_push($array,$arra);
        //     }
        // }
        // $arr = array('groupID'=>$groupID,'groupName'=>$groupName,'ads'=>$array);
        // array_push($members,$arr);
    }
    $arr = array('result'=>'OK','number'=>$num_rows,'list'=>$members);
    echo json_encode($arr);
}

mysqli_close($sqllink);

?>