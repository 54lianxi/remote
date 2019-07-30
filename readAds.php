<?php
$sqllink=mysqli_connect("localhost", "nectaus1", "XYt96583!", "nectaremote");
if (mysqli_connect_errno($sqllink))
{
    die("");
}
mysqli_query($sqllink, "SET NAMES UTF8");
$sql = 'select * from ads';
$result = mysqli_query($sqllink, $sql);
$num_rows = mysqli_num_rows($result);
if($num_rows <= 0){
    $arr = array ('result'=>"OK", 'number'=>0);
    echo json_encode($arr);
}else{

    $members = array();
    
    while($row = mysqli_fetch_array($result)){
        $ID=$row['ID'];
        $content=$row['content'];
        $title=$row['title'];
        $link=$row['link'];
        $picture=$row['picture'];
        $smallTitle=$row['smallTitle'];
        $type=$row['type'];
        $icon = $row['icon'];
        $arr = array ('ID'=>$ID, 'content'=>$content,'title'=>$title, 
                'link'=>$link,'pictureURL'=>'imgs/'.$picture, 'smallTitle'=>$smallTitle,'type'=>$type,'icon'=>'imgs/'.$icon);
                
        array_push($members, $arr);
    }
    $arr = array ('result'=>"OK", 'number'=>$num_rows, 'list'=>$members);
    echo json_encode($arr);
}
mysqli_close($sqllink);




?>