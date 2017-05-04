<?php
/*
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::                                                
::  Advance file uploader Version 1.0 by Dhaval koradiya - https://www.linkedin.com/in/Dhavalkoradiya  
::                                               
::  https://github.com/Dhavalkoradiya/File-Uploder                                               
::                                               
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
*/

//Database connection
$db = mysql_connect("localhost","root","");
$conn = mysql_select_db("test",$db);

if(isset($_POST["submit"])) {	
  $target_dir = "uploads/"; ##set directory path

  $uploadOk = 1;
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
  // Check if image file is a actual image or fake image

  $realname = $_FILES["fileToUpload"]["name"];
  $type = $_FILES["fileToUpload"]["type"];
  //insert data to database
  $inset = mysql_query("INSERT INTO `filedata`(`realname`, `type`) VALUES ('".$realname."','".$type."')") or die(mysql_error());
  $fileId = mysql_insert_id();
  $newFileName = $fileId;
  $target_file = $target_dir . $newFileName;
    //upload file in directory
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }

}

//Download file code
if(isset($_GET["download"])) {
	$id = $_GET["download"];
	$select1 = mysql_query("SELECT * FROM `filedata` WHERE `id` = ".$id) or die(mysql_error());
	$fetch1 = mysql_fetch_assoc($select1);
	
	$target_dir = "uploads/";
	$filename = $target_dir . $fetch1['id'];
	
  if (file_exists($filename)) {
    // send headers to browser to initiate file download
    header('Content-Length: '.filesize($filename));
    // Pass the mimetype so the browser can open it
    header('Cache-control: private');
    header('Content-Type: ' . $fetch1['type']);
    //header('Content-Disposition: attachment; filename="' . rawurlencode($fetch1['realname']) . '"');
    header('Content-Disposition: attachment; filename="' . ($fetch1['realname']) . '"');
    // Apache is sending Last Modified header, so we'll do it, too
    $modified=filemtime($filename);
    header('Last-Modified: '. date('D, j M Y G:i:s T', $fetch1['modified']));   // something like Thu, 03 Oct 2002 18:01:08 GMT
    readfile($filename);
  } else {
    echo 'message_file_does_not_exist';
  }
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Advance File Upload</title>
</head>

<body>
  <form method="post" enctype="multipart/form-data">
    Select file to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload" name="submit">
  </form>
  <br />
  <br />
  <table border="1" cellpadding="5" cellspacing="3" width="50%">
    <?php
        //fetch record from database
    $select = mysql_query("SELECT * FROM `filedata`") or die(mysql_error());
    while($fetch = mysql_fetch_assoc($select)){
      ?>
      <tr>
       <th><?php echo $fetch['id'];?></th>
       <td><?php echo $fetch['realname'];?></td>
       <td><?php echo $fetch['type'];?></td>
       <td><a href="?download=<?php echo $fetch['id']; ?>">Download</a></td>
     </tr>
     <?php
   }
   ?>
 </table>
</body>
</html>