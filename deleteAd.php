<?php
$ID = $_GET['ID'];


$sqllink=mysqli_connect("localhost", "nectaus1", "XYt96583!", "nectaremote");
if (mysqli_connect_errno($sqllink))
{
    die("");
}

$sql = 'select icon,picture from ads where ID = '.$ID;
    // echo($sql);
    $result = mysqli_query($sqllink, $sql);
    if($result){
        while($row = mysqli_fetch_array($result)){
            $iconUrl = $row['icon'];
            $picture = $row['picture'];
        }
        unlink('imgs/'.$iconUrl);
        unlink('imgs/'.$picture);
    }


mysqli_query($sqllink, "SET NAMES UTF8");
$sql = "delete from ads where ID=".$ID;
$result = mysqli_query($sqllink, $sql);

if(result){
    $arr =array('result'=>'OK');
}else{
    $arr = array('result' => 'fail','reason'=>$sql);
}
echo json_encode($arr);
mysqli_close($sqllink);


?>