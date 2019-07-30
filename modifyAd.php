<?php
$ID = $_POST['ID'];
$content = $_POST['content'];
$title = $_POST['title'];
$link = $_POST['link'];
$smallTitle = $_POST['smallTitle'];
$type = $_POST['type'];


$sqllink=mysqli_connect("localhost", "nectaus1", "XYt96583!", "nectaremote");
if (mysqli_connect_errno($sqllink))
{
    die("");
}
mysqli_query($sqllink, "SET NAMES UTF8");


$pic = $_FILES['picture'];
$picture = '';
//传过来的是个文件
if(!empty($pic['tmp_name'])){

    $base_path = "./imgs/";
    $extension = pathinfo($pic['name'], PATHINFO_EXTENSION);
    $unique = md5(uniqid(microtime(true),true)).'.'.$extension;
    $target_path = $base_path . "/" . $unique;

    if (move_uploaded_file($pic['tmp_name'], $target_path )) {
        $picture = $unique;
    }
    $sql = 'select picture from ads where ID = '.$ID;
    // echo($sql);
    $result = mysqli_query($sqllink, $sql);
    if($result){
        while($row = mysqli_fetch_array($result)){
            $picUrl = $row['picture'];
        }
        unlink('imgs/'.$picUrl);
    }

   

}else{
    $picture = substr($_POST['picture'],5);

}
$pic2 = $_FILES['icon'];
$icon = '';
if(!empty($pic2['tmp_name'])){
    $base_path = "./imgs/";
    $extension = pathinfo($pic2['name'], PATHINFO_EXTENSION);
    $unique = md5(uniqid(microtime(true),true)).'.'.$extension;
    $target_path = $base_path . "/" . $unique;

    if (move_uploaded_file($pic2['tmp_name'], $target_path )) {
        $icon = $unique;
    }
    $sql = 'select icon from ads where ID = '.$ID;
    // echo($sql);
    $result = mysqli_query($sqllink, $sql);
    if($result){
        while($row = mysqli_fetch_array($result)){
            $iconUrl = $row['icon'];
        }
        unlink('imgs/'.$iconUrl);
    }
}else{
    //由此返回图片路径的时候添加了imgs/,如何用户不重新选择图片，那么前端传过来的数据将会带有imgs/的前缀，所以，在保存到数据库时需要将它截掉
    $icon = substr($_POST['icon'],5);
    

}



$sql = "update ads set title = '".$title."',content='".$content."',link='".$link."',smallTitle='".$smallTitle."',type='".$type."',picture='".$picture."',icon='".$icon."' where ID=".$ID;

$result = mysqli_query($sqllink, $sql);
if(result){
    $arr = array ('result'=>"OK");
}else{
    $arr = array ('result'=>"fail","reason"=>$sql);
}
echo json_encode($arr);
mysqli_close($sqllink);
?>