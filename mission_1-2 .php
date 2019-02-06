<?php
$filename = 'mission_1-2_(Shinoda).txt';
$fp = fopen($filename,'w');
fwrite($fp, 'Success!');
fclose($fp);
?>