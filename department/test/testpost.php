<?php
/*
 * Created by wolf on 2015年8月18日 下午5:54:46
 */

error_reporting(0);
$display_block=<<<END_OF_TEXT
<form action="" method="post">
<input type="submit" id="" name="change2" value="123123" class="btn btn-primary">
END_OF_TEXT;




if ($_POST['change2']) {
    echo $_POST['change2'];
}

echo $display_block;