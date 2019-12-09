

<?php 
require_once '../lib/xss.php';
$str='123<<<<<<<<<<<<<<<<123';
clean_xss($str);
echo $str;

?>