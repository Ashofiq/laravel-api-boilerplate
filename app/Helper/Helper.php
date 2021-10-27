<?php 
namespace App\Helper;
use Hash;

class Helper{

    public static function add(){
        return 'ok';
    }

    // remove unNessary or danger attact
    public static function removeDanger($str){
        return htmlspecialchars($str);
    }

    // Make Hash
    public static function makeHash($str){
        return Hash::make($str);
    }
}