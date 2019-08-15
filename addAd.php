<?php

header('Access-Control-Allow-Origin:*');
$title = $_POST['title'];
$smallTitle = $_POST['smallTitle'];
$content = $_POST['content'];
$link = $_POST['link'];
$type = $_POST['type'];

$icon = $_FILES['icon'];
$picture = $_FILES['picture'];

$base_path = "./imgs";
if(!is_dir($base_path)){
    mkdir($base_path,0777,true);
}





    $sqllink=mysqli_connect("localhost", "nectaus1", "XYt96583!", "nectaremote");
	if (mysqli_connect_errno($sqllink))
	{
		die("");
	}
    
    
$string_pic1 = "";
$string_pic2 = "";
if(!empty($icon['tmp_name'])){
    $extension = pathinfo($icon['name'],PATHINFO_EXTENSION);
    $unique = md5(uniqid(microtime(),true)).'.'.$extension;
    $target_path = $base_path."/".$unique;
    if(move_uploaded_file($icon['tmp_name'], $target_path )){
        $string_pic1 = $unique;
    }

}
if(!empty($picture['tmp_name'])){
    $extension = pathinfo($picture['name'],PATHINFO_EXTENSION);
    $unique = md5(uniqid(microtime(),true)).'.'.$extension;
    $target_path = $base_path."/".$unique;
    if(move_uploaded_file($picture['tmp_name'], $target_path )){
        $string_pic2 = $unique;
    }

}
mysqli_query($sqllink, "SET NAMES UTF8");
$sql = "insert into ads(`title`,`smallTitle`,`content`,`link`,`picture`,`type`,`icon`) values('".urlencode($title)."','".urlencode($smallTitle)."','".urlencode($content)."','".urlencode($link)."','".$string_pic2."','".$type."','".$string_pic1."')";
$result = mysqli_query($sqllink, $sql);
if($result){
    $arr = array("result"=>"OK");
    echo json_encode($arr);
}else{
    $arr = array("result"=>"failed","reason"=>$sql);
    echo json_encode($arr);
}

mysqli_close($sqllink);

?>