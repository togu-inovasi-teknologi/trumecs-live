<?php

if(!function_exists('ppn_value')){
    function ppn_value($nilai = null){
        
        if($nilai != null){
            return $nilai;
        }else{
            return 0.11;
        }
    }
}