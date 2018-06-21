<?php
/**
 * Created by IntelliJ IDEA.
 * User: johnfg10
 * Date: 15/01/18
 * Time: 18:53
 */
namespace john\auth;

require_once $_SERVER['DOCUMENT_ROOT'] ."/Connections.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Snowflake.php";

use john\database\Connections;
use johnfg10\utils\Snowflake;

/**
 * Class Login
 * Table required users: id: long, email: varchar(255),
 * username: varchar(50), password: varchar(256), firstname: varchar(50),
 * surname: varchar(50)
 * @package john\auth
 */
class Login{
    /**
     * @var string contains construction commands
     */
    public static $databaseConnectionString = "mysql:host=localhost;dbname=todo";
    /**
     * @var string|null the username to access the database
     */
    public static $databaseUserName = null;
    /**
     * @var string|null the password to access the database
     */
    public static $databasePassword = null;
    /**
     * @var string the table users will be stored in
     */
    public static $databaseUserTable = "credentials";

    /**
     * @var string the table tokens will be stored in
     */
    public static $databaseUserTokens = "tokens";

    /**
     * @param $email string the email to get from the database
     * @return mixed will return the user if found otherwise false
     */
    public static function GetUser($email) {
        try{
            $connection = Connections::GetConnection();
            $prepStatement = $connection->prepare("SELECT * FROM ".Login::$databaseUserTable." WHERE `email` = ?");
            $execBool = $prepStatement->execute([$email]);
            if($execBool){
                while ($fetchedUser = $prepStatement->fetch()){
                    $user = new User($fetchedUser["id"], $fetchedUser["email"], $fetchedUser["username"], $fetchedUser["password"], $fetchedUser["firstname"], $fetchedUser["surname"]);
                    return $user;
                }
            }
        }finally{
            $connection = null;
            $prepStatement = null;
        }

        return false;
    }

    /**
     * @param $userId
     * @return bool|\john\auth\User
     */
    public static function GetUserId($userId){
        try{
            $connection = Connections::GetConnection();
            $prepStatement = $connection->prepare("SELECT * FROM ".Login::$databaseUserTable." WHERE `id` = ?");
            $execBool = $prepStatement->execute([$userId]);
            if($execBool){
                while ($fetchedUser = $prepStatement->fetch()){
                    $user = new User($fetchedUser["id"],
                        $fetchedUser["email"],
                        $fetchedUser["username"],
                        $fetchedUser["password"],
                        $fetchedUser["firstname"],
                        $fetchedUser["surname"]);
                    return $user;
                }
            }
        }finally{
            $connection = null;
            $prepStatement = null;
        }

        return false;
    }

    /**
     * @param $user User the user to be searched for
     * @return bool returns weather or not the user exists0
     */
    public static function DoesUserExist($user) : bool {
        try{
            $connection = Connections::GetConnection();
            $prepStatement = $connection->prepare("SELECT * FROM ".Login::$databaseUserTable." WHERE `id` = ?, `email` = ?, `username` = ?, `password` = ?, `firstname` = ?, `surname` = ?");
            $execBool = $prepStatement->execute([$user->getUserId(), $user->getEmail() , $user->getUserName(), $user->getPassword(), $user->getFirstName(), $user->getSurname()]);
            if ($execBool){
                if ($prepStatement->rowCount() > 0){
                    return true;
                }
            }
        }finally{
            $connection = null;
            $prepStatement = null;
        }

        return false;
    }

    /**
     * @param $user User the user to be inserted
     * @return mixed returns true if the user was created otherwise false
     */
    public static function CreateUser($user) : bool {
        try{
            $connection = Connections::GetConnection();
            if (!self::DoesUserExist($user)){
                $prepStatement = $connection->prepare("INSERT INTO ".Login::$databaseUserTable." (`id`, `email`, `username`, `password`, `firstname`, `surname`) VALUES (? ,? ,? ,? ,?,?)");
                $execBool = $prepStatement->execute([$user->getUserId(), $user->getEmail() , $user->getUserName(), $user->getPassword(), $user->getFirstName(), $user->getSurname()]);
                echo implode(" ", $prepStatement->errorInfo());
                return $execBool;
            }
        }finally{
            $connection = null;
            $prepStatement = null;
        }


        return false;
    }

    /**
     * @param $email string
     * @return bool|string
     */
    public static function GetUserPassword($email){
        try{
            $connection = Connections::GetConnection();
            $prepStatement = $connection->prepare("SELECT `password` FROM ".Login::$databaseUserTable." WHERE `email` = ?");
            $execBool = $prepStatement->execute([$email]);
            if($execBool){
                while ($fetchedUser = $prepStatement->fetch()){
                    return $fetchedUser["password"];
                }
            }
        }finally{
            $connection = null;
            $prepStatement = null;
        }

        return false;
    }

    /**
     * @param $user User
     * @param $newpass string
     * @return int
     */
    public static function SetUserPassword($user, $newpass) : int {
        $passHash = password_hash($newpass, PASSWORD_BCRYPT);
        $userid = $user->getUserId();
        $connection = Connections::GetConnection();
        $sql = "UPDATE ".self::$databaseUserTable." SET `password` = '$passHash' WHERE `id` = $userid";
        echo $sql;
        return $connection->exec($sql);
    }

    /**
     * @param $token
     * @return bool|\john\auth\User
     */
    public static function GetUserFromToken($token){
        try{
            $connection = Connections::GetConnection();
            $prepStatement = $connection->prepare("SELECT `id` FROM ".self::$databaseUserTokens." WHERE `token` = ?");
            $execBool = $prepStatement->execute([$token]);
            if ($execBool){
                while ($fetchedUser = $prepStatement->fetch()){
                    $userID = $fetchedUser["userid"];
                    return Login::GetUserId($userID);
                }
            }
        }finally{
            $connection = null;
            $prepStatement = null;
        }

        return false;
    }

    /**
     * @param $user User
     * @return bool
     */
    public static function CreateTokenFromUser($user){
        try{
            $connection = Connections::GetConnection();
            $prepStatement = $connection->prepare("INSERT INTO ".Login::$databaseUserTokens." (`token`, `id`) VALUES ( ?, ?)");
            $token = Snowflake::getUniqueId();
            $execBool = $prepStatement->execute([$token, $user->getUserId()]);
            if ($execBool){
                return $token;
            }
        }finally{
            $connection = null;
            $prepStatement = null;
        }

        return false;
    }

    /**
     * @param $token string token to destroy
     * @return bool if it was successful or not
     */
    public static function DestroyToken($token){
        try{
            $connection = Connections::GetConnection();
            $prepStatement = $connection->prepare("DELETE FROM ".Login::$databaseUserTokens." WHERE `token` = ?");
            $execBool = $prepStatement->execute([$token]);
        }finally{
            $connection = null;
            $prepStatement = null;
        }

        return $execBool;
    }
}