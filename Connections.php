<?php
/**
 * Created by IntelliJ IDEA.
 * User: johnfg10
 * Date: 17/01/18
 * Time: 09:38
 */

namespace john\database;

use PDO;

class Connections{

    public const DATASOURCENAME = "mysql:host=localhost;port=3306;dbname=jg_bullitin";

    public const PDOUSERNAME = "root";

    public const PDOPASSWORD = "";

    public static function GetConnection() : PDO {
        return new PDO(Connections::DATASOURCENAME, Connections::PDOUSERNAME, Connections::PDOPASSWORD);
    }

}