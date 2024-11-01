<?php

require_once 'filters/FilterRepository.php';

class RoleManager
{
    const TYPE_NOT_VALID = -1;
    const TYPE_UNSPECIFIED = 0;
    const TYPE_ONLY = 1;
    const TYPE_EXCEPT = 2;

    private static $VALIDKEYS = [
      'only', 'except'
    ];

    private static $ROLES = [
      'visitor', 'subscriber', 'contributor', 'author', 'editor', 'administrator'
    ];

    /**
     * Get the operation
     *
     * @param $attribute
     * @return int
     */
    public static function getOperation($attribute)
    {
        if(count($attribute) == 0 || count($attribute) > 1)
        {
            return null;
        }
        if(!static::isValidKey(array_keys($attribute)[0])){
            return null;
        }
        $type = static::getType(array_keys($attribute)[0]);
        return static::getAffected($type, array_values($attribute)[0]);
    }


    /**
     * Get the type of operation
     *
     * @param $key
     * @return int
     */
    public static function getType($key)
    {
        if($key == 'only'){
            return static::TYPE_ONLY;
        }

        if($key == 'except'){
            return static::TYPE_EXCEPT;
        }
    }

    /**
     * Get instance of the filter Class
     *
     * @param $type
     * @param $affected
     * @return null|void
     */
    public static function getAffected($type, $affected)
    {
        list($affectedArray, $selected)= [explode('|', $affected), []];

        $filter = FilterRepository::generate($type);
        foreach($affectedArray as $role){
            if(in_array($role, static::$ROLES)){
                $selected[] = $role;
            }
        }
        return $filter->select($selected);
    }

    /**
     * Check if the key is valid
     *
     * @param $key
     * @return bool
     */
    public static function isValidKey($key){
        return in_array($key, static::$VALIDKEYS);
    }
}