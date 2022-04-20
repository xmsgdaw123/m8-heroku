<?php
	
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	
	ini_set('display_errors','1');
	$domain=$_SERVER['HTTP_HOST'];
	if($domain=="toni.cesnuria.com"){
		$conf='config.ini';
	}else{
		$conf='config.dev.ini';
	}
	
	include 'entry.php';