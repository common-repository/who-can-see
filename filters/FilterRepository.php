<?php

require_once 'ShowFilter.php';
require_once 'HideFilter.php';

final class FilterRepository
{
    private function __construct(){}

    public static function generate($type)
    {
        if($type == RoleManager::TYPE_ONLY){
            return new ShowFilter();
        }
        if($type == RoleManager::TYPE_EXCEPT){
            return new HideFilter();
        }
    }
}