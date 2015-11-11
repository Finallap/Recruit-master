<?php
/*
 * Created by wolf on 2015年8月13日 下午11:43:35
 */


function sql_checkstr($string) {
    $sql_table=array("select","delete","insert","update","create","drop","exec","from",
        "backup","where","into","alter",
        "add","primary","index","value","top"
    );
    for ($i=0; $i < count($sql_table); $i++) {
        if (stristr($string, $sql_table[$i]) != "") {
            return "illegal";                       //如果想关闭，将 illegal 修改为 ignore 即可
        }
    }
    return "legal";
}

function xss_checkstr($string) {
    $xss_table=array("<");
    for ($i=0; $i < count($xss_table); $i++) {
        if (stristr($string, $xss_table[$i]) != "") {
            return "xss";                       //如果想关闭，将 illegal 修改为 ignore 即可
        }
    }
    return "safe";
}

global $separator;
global $check_sql_inject;
global $check_xss_attack;
$check_sql_inject="";
$check_xss_attack="";
$separator=" # ";



/*  example:

if (sql_checkstr($check_sql_inject)=="illegal") {
    // pdo preparestmt insert blacklist
}

*/