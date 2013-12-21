<?php
$file_url = $_GET['file'];
function retrieve_remote_file_size($url){
 $ch = curl_init($url);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
 curl_setopt($ch, CURLOPT_HEADER, TRUE);
 curl_setopt($ch, CURLOPT_NOBODY, TRUE);
 $data = curl_exec($ch);
 $size = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
 curl_close($ch);
 return $size;
}
$filesize = retrieve_remote_file_size($file_url);
if($filesize != -1){
  if($filesize < 52428800){
    if(ini_get('zlib.output_compression')) ini_set('zlib.output_compression', 'Off');
    header("Pragma: public"); // required
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private",false); // required for certain browsers
    header('Content-Type: application/force-download');
    header("Content-Transfer-Encoding: Binary"); 
    header("Content-disposition: attachment; filename=\"".basename($file_url)."\""); 
    header("Content-Length: ".$filesize);
    @readfile($file_url);
  }else{
    echo 'The requested file is too large.';
  }
}else{
  header('HTTP/1.0 404 Not Found');
}
exit;