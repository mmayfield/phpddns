<?php
include(path/to/curl.php')
$hostname=$_GET['hostname'];
$myip=$_GET['myip'];
$user=$_SERVER['PHP_AUTH_USER'];
$pwd=$_SERVER['PHP_AUTH_PW'];
$newline="";
$changr="";
$file_handle=fopen('path/to/info.txt','rb');
while(!feof($file_handle)) {
  $line_of_text=gets($file_handle);
  $parts=explode('',$line_of_text);
  if($parts[0]==$user) {
    if($parts[1]==$hostname) {
      if (trim($parts[2])==trim($myip)) {
        echo 'nochg' . $myip;
      } else {
        update($hostname, $myip);
        echo 'good' . $myip;
        $newline.=$parts[0] . " " . $parts[1] . " " . $myip . "\n";
        $change='yes';
      }
    } else { echo 'notfqdn'; }
  } else { $newline.=$parts[0] . " " . $parts[1] . " " . $parts[2] . "\n"; }
}
fclose($file_handle);
if ($change=='yes') {
  $file_handle=fopen('path/to/info.txt,'w'');
  $newline=trim($newline);
  fwrite($file_handle, $newline);
  fclose($file_handle);
}
?>
