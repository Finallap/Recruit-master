<?php

 class RandChar{

  function getRandChar($length){
   $str = null;
   $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
   $max = strlen($strPol)-1;

   for($i=0;$i<$length;$i++){
    $str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
   }

   return $str;
  }
 }

 global $randCharObj;
 $randCharObj = new RandChar();
 
//  $randCharObj = new RandChar();
//  $a=$randCharObj->getRandChar(10);
//  $b=$randCharObj->getRandChar(10);
//  echo $a."<br>".$b;