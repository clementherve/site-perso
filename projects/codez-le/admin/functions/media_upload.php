<?php
if(isset($_FILES["media"])){

    //original name
    $name = $_FILES["media"]["name"];
    
    //get the extension
    $ext = explode(".", $name)[count(explode(".", $name))-1];

    //path to upload files too
    if($ext == "zip"){
        $uploaddir = "../../cours/";
    } else {
        $uploaddir = "../../img/res/";
    }
    
    //chemin
    $uploadfile = $uploaddir.$_POST["name"].".".$ext;
    
    if($_FILES["media"]["size"] > 2000000 or $_FILES["media"]["size"] == 0){
        $resp["status"] = "fail";
        $resp["why"] = "File's too big!";
        die(json_encode($resp));
    }
    
    //upload;
    if(move_uploaded_file($_FILES["media"]["tmp_name"], $uploadfile) == true){
        $resp["status"] = "ok";
        $resp["filename"] = $uploadfile;
        die(json_encode($resp));
    } else {
        $resp["status"] = "fail";
        $resp["why"] = "Unknown error while moving the file";
        die(json_encode($resp));
    }
} else {
    $resp["status"] = "fail";
    $resp["why"] = "No files were sent";
    die(json_encode($resp));
}
?>