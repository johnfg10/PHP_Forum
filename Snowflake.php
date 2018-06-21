<?php
/**
 * Created by IntelliJ IDEA.
 * User: johnfg10
 * Date: 18/01/18
 * Time: 12:05
 */

namespace johnfg10\utils;

require_once $_SERVER['DOCUMENT_ROOT'] . "/dist/snowflake.php";

class Snowflake
{
    /** @var null|\SnowFlake */
    private static $snowflake = null;

    public static function getUniqueId() : string {
        if (snowflake::$snowflake == null){
            snowflake::$snowflake = new \SnowFlake(1,1);
        }

        $id = snowflake::$snowflake->generateID();
        if ($id == 4128){
            return rand();
        }else{
            return $id;
        }
    }
}