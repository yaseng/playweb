<?php
/**
 * @id       common.php-2014-3-29
 * @desc     公共函数库
 * @author   Yaseng  WwW.Yaseng.Me [Yaseng@UAUC.NET]
 * @project  github.com/yaseng/playweb
 **/

/**
 * @desc   随机字符串
 * @param  $length  字符串长度
 **/
function  rand_str($length =10){

	$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_ []{}<>~`+=,.;:/?|';
	$str = '';
	for ( $i = 0; $i < $length; $i++ )
	{
		$str .= $chars[ mt_rand(0, strlen($chars) - 1) ];
	}
	return $str;

}
/**
 * @desc     获取唯一的hash值
 * @return   string 长度为 15 的 唯一 hash 值
 **/
function  get_hash(){

	return substr(md5(rand_str().time()),0,15);

}

function  str_encode($str,$key){

	$strlength=strlen($str);
	$baselength=strlen($key);
	$ret="";
	for($i=0;$i<$strlength;$i++){

		$ret.=chr((ord($str[$i])+ord($key[$i % $baselength]))%256);

	}

	return  base64_encode($ret);
}

function  str_decode($str,$key){

	$str=base64_decode($str);
	$strlength=strlen($str);
	$baselength=strlen($key);
	$ret="";
	for($i=0;$i<$strlength;$i++){
    
     $ret.=chr((ord($str[$i])-ord($key[$i % $baselength]))%256);
    
    }  
	
	  return  $ret;
}

?>