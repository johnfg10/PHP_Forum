<?php
/**
 * Created by IntelliJ IDEA.
 * User: johnfg10
 * Date: 17/01/18
 * Time: 22:06
 */

set_error_handler('handleError');


/**
 * @param $errno int
 * @param $errstr string
 * @param $errfile string
 * @param $errline int
 * @param $errContent array
 * @return bool
 */
function handleError($errno, $errstr, $errfile, $errline, $errContent) : bool {
    $prepStatement = \john\database\Connections::GetConnection()->prepare("INSERT INTO `phperrors` (`errorLevel`, `errorString`, `errorFile`, `errorLine`, `errorContent`) VALUES (?,?,?,?,?)");
    $execBool = $prepStatement->execute([$errno, $errstr, $errfile, $errline, json_encode($errContent)]);

    return $execBool;
}
