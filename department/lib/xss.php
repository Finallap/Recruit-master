<?PHP

	header("Content-type: text/html;charset=utf-8");
/**
 * @blog http://www.phpddt.com
 * @param $string
 * @param $low 安全别级低
 */
function clean_xss(&$string, $low = False)
{
	if (! is_array ( $string ))
	{
		$string = trim ( $string );
		$string = strip_tags ( $string );
		$string = htmlspecialchars ( $string );
		if ($low)
		{
			return True;
		}
// 		$string = str_replace ( array ('"', "\\", "'", "/", "..", "../", "./", "//" ), '', $string );
		$no = '/%0[0-8bcef]/';
		$string = preg_replace ( $no, '', $string );
		$no = '/%1[0-9a-f]/';
		$string = preg_replace ( $no, '', $string );
		$no = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S';
		$string = preg_replace ( $no, '', $string );
		return True;
	}
	$keys = array_keys ( $string );
	foreach ( $keys as $key )
	{
		clean_xss ( $string [$key] );
	}
}

//just a test
// $str = 'phpddt.com<meta http-equiv="refresh" content="0;"><!DOCTYPE html>
// <html>
// <head>
// 	<title></title>
// 	<script>alert("xss")</script>
// </head>
// <body>

// </body>
// </html>';
// clean_xss($str); 
// echo $str;
?>