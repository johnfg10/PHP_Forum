<?php
/**
 * Created by IntelliJ IDEA.
 * User: johnfg10
 * Date: 18/01/18
 * Time: 13:12
 */

namespace johnfg10\cms;

require_once $_SERVER['DOCUMENT_ROOT']."/Connections.php";

use john\database\Connections;

class CMSManager
{
    public static $commenttable = "comments";

    /**
     * @param $comment Comment
     * @return bool
     */
    public static function CreateComment($comment) : bool {
        try{
            $connection = Connections::GetConnection();
            $prepStatement = $connection->prepare('INSERT INTO ' . self::$commenttable. ' (`id`, `thread`, `comment`, `author`) VALUES (?,?,?,?)');
            $execBool = $prepStatement->execute([$comment->getId(), $comment->getThread() ,$comment->getComment(), $comment->getAuthor()]);
            if ($execBool == false){
                echo $prepStatement->errorCode();
                echo implode(",", $prepStatement->errorInfo());
            }
            return $execBool;
        }finally{
            $connection = null;
            $prepStatement = null;
        }
    }

    /**
     * @param $amount int
     * @return bool|array
     */
    public static function SelectComments($amount){
        try{
            $connection = Connections::GetConnection();
            if ($amount == 0){
                $prepStatement = $connection->prepare('SELECT * FROM `'.self::$commenttable.'`');
                $execBool = $prepStatement->execute();
                if ($execBool){
                    return self::toCommentsArray($prepStatement);
                }

                return false;
            }else{
                $prepStatement = $connection->prepare('SELECT * FROM `'.self::$commenttable.'` LIMIT '.$amount);
                $execBool = $prepStatement->execute();
                if ($execBool){
                    return self::toCommentsArray($prepStatement);
                }

                return false;
            }
        }finally{
            $connection = null;
            $prepStatement = null;
        }
    }

    /**
     * @param $prepStatement \PDOStatement
     * @return array
     */
    public static function toCommentsArray($prepStatement){
        $comments = array();
        while ($fetched = $prepStatement->fetch()){
            $comments[] = new Comment($fetched["id"], $fetched["thread"], $fetched["comment"], $fetched["author"], $fetched["creation"]);
        }
        return $comments;
    }
}