<?php
session_start();
include('includes/config.php');
$id = $_SESSION["id"];

$query = mysqli_query($mysqli, "SELECT * FROM `users` WHERE `id`='$id'");
$fetch = mysqli_fetch_array($query);

$id=$fetch["id"];
$name=$fetch["name"];


if(isset($_POST["freeupload"]))
{

    $year = $_POST["year"];
    $title = $_POST["title"];
	
	$des = $_POST["desc"];
	$tech = $_POST["tech"];
	$domain = $_POST["domain"];
	$proj = $_FILES["proj"]["name"];
    $proj_tmp = $_FILES["proj"]["tmp_name"];

    // The name of the directory that we need to create.
    $directoryName = "../admin/freeuploads/".$domain;

    // Check if the directory already exists.
    if(!is_dir($directoryName))
    {
        // Directory does not exist, so lets create it.
        mkdir($directoryName, 0755);

        $tmp = $directoryName."/".$proj;
        moveFile($proj_tmp, $tmp);
    }

    $tmp = $directoryName."/".$proj;
    moveFile($proj_tmp, $tmp);

 $query = mysqli_query($mysqli,"INSERT INTO `proj` (title, year, des, tech, domain, proj, status, uid, user, type) VALUES ('$title', '$year', '$des', '$tech', '$domain', '$proj', 'ACTIVE','$id','$name', 'FREE')");
     if($query == true)
    {
        header("location: uppro.php?upload=freesuccess");
    }
    else
    {
        header("location: uppro.php?upload=freefail");
    }

}

function moveFile($a, $b) 
{
    move_uploaded_file($a, $b);
}


?>