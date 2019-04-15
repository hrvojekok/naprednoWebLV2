<?php



//funkcija provjerava da li string zavrsava na ".sha256"
function endswith($string) {
    $strlen = strlen($string);
    $testlen = strlen(".sha256");
    if ($testlen > $strlen) return false;
    return substr_compare($string, ".sha256", $strlen - $testlen, $testlen) === 0;
}

if($handle = opendir('./images')) {
    while(false !== ($entry = readdir($handle))) {
      if($entry != "." && $entry != "..") {
          //echo "$entry\n" . "<br>";
          if(endswith($entry) == 1) {
            //
            // $fullPath = $_REQUEST["path"];
            // $put = realpath($fullPath);
            //
            // $imageString = file_get_contents($put);
            // $encryptedImage = decrypt($imageString, '$5$something$');

            $imagePath = $_SERVER['DOCUMENT_ROOT'] ."/kokosarevicLV2/images/" . $entry;
            echo($imagePath . "<br><br>");


            echo "<a href='" . $entry . "'>" . $entry . "</a> <br><br>";

          }
        }
      }
    closedir($handle);
}




?>
