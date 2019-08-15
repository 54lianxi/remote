<?php
function init(){
    
    $sqllink=mysqli_connect("localhost", "nectaus1", "XYt96583!", "nectaremote");
    if (mysqli_connect_errno($sqllink))
    {
        die("");
    }

    mysqli_query($sqllink, "SET NAMES UTF8");
    return $sqllink;
}


?>