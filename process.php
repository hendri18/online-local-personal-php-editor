<?php
$fp = fopen("result.php", "w") or die("Unable to open file!");
$editorCode = $_POST['input'];
fwrite($fp, $editorCode);
fclose($fp);