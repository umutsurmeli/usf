<?php

function view($yol,$degiskenler=array(),$degerdondur=true)
{
    $umutsurmeli = \umutsurmeli\system\controller\us_controller::$_constructor;
    $rtrn = $umutsurmeli->load->view($yol,$degiskenler,$degerdondur);
    return $rtrn;

}
function config($key)
{
    $rtrn = \umutsurmeli\system\controller\us_controller::$_constructor->config->item($key);
    return $rtrn;
}
/**
 * 
 * @global type $umutsurmeli : Ana kontroller.
 * @param type $classShortPath 
 * @return type : "\namespace\?\?\className" 
 */
function library($classShortPath,$run=false)
{
    $umutsurmeli = \umutsurmeli\system\controller\us_controller::$_constructor;
    $rtrn = $umutsurmeli->load->library($classShortPath,$run);
    return $rtrn;
}
function systemlibrary($classShortPath)
{
    $umutsurmeli = \umutsurmeli\system\controller\us_controller::$_constructor;
    $rtrn = $umutsurmeli->load->systemlibrary($classShortPath);
    return $rtrn;
}
/**
 * 
 * @param type $classShortPath model klasörü altındaki yol belirtilir.
 * @param type $createNew  true için yeni nesne döndürür.
 * @return type nesne ya da namespace\class stringi döndürür.
 */
function model($classShortPath,$createNew=true)
{

    $umutsurmeli = \umutsurmeli\system\controller\us_controller::$_constructor;
    $rtrn = $umutsurmeli->load->model($classShortPath,$createNew);
    return $rtrn;

}
function systemmodel($classShortPath,$createNew=true)
{

    $umutsurmeli = \umutsurmeli\system\controller\us_controller::$_constructor;
    $rtrn = $umutsurmeli->load->systemmodel($classShortPath,$createNew);
    return $rtrn;

}
function &get_instance() {
    $umutsurmeli = \umutsurmeli\system\controller\us_controller::$_constructor;
    return $umutsurmeli;
}