<?php

class Dateformat {

    function indonesia($date){
    	$test = new DateTime($date);
  		$hari= $this->_isday(date_format($test, 'l'));
  		$month= $this->_ismonth(date_format($test, 'm'));
  		$tahun= date_format($test, 'Y');
  		$tanggal= date_format($test, 'd');
    	return $hari.", ".$tanggal." ".$month." ".$tahun;
    }
    function _isday($value)
    {
    	$array_dayEng= array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
    	$array_dayInd= array("Senin","Selasa","Rabu","Kamis","Jum'at","Sabtu","Minggu");
    	$i=0;
    	foreach ($array_dayEng as $key) {
    		if ($key==$value) {
    			break;
    		}
    		$i++;
    	}
    	return $array_dayInd[$i];
    }
    function _ismonth($value)
    {
    	$array_Eng= array("1","2","3","4","5","6","7","8","9","10","11","12");
    	$array_Ind= array("Januari","February","Maret","April","Mei","Juni","Juli" ,"Agustus","September","Oktober","November","Desember");
    	$i=0;
    	foreach ($array_Eng as $key) {
    		if ($key==$value) {
    			break;
    		}
    		$i++;
    	}
    	return $array_Ind[$i];
    }
}