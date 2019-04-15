<?php
$files = @$_FILES["files"];

if($files["name"] != '') {

  $newPath=$_SERVER['DOCUMENT_ROOT'] ."/kokosarevicLV2/images/";
  $fullPath = $_REQUEST["path"].$files["name"];
  $realFullPath = $newPath . $fullPath;
  echo($fullPath . "<br><br>");

    if(move_uploaded_file($files['tmp_name'], $realFullPath)) {

      //echo($fileName);
      $put = realpath($fullPath);

      $imageString = file_get_contents($put);
      $encryptedImage = crypt($imageString, '$5$somethin$');

      echo($encryptedImage ."<br><br>");
      echo($realFullPath);
      $encryptedName = substr($realFullPath, 0, -4);

      $myfile = fopen("$encryptedName.sha256", "w") or die("Unable to open file!");
      fwrite($myfile, $encryptedImage);
      fclose($myfile);


      echo "<h1><a href='$fullPath'>OK-Click here!</a></h1>";
    }
}
echo '<html>
<head>
<title>Upload files...</title>
</head>
<body>
<form method=POST enctype="multipart/form-data" action="">
<input type=text name=path>
<input type="file" name="files">
<input type=submit value="Up">
</form>
</body></html>';
?>
