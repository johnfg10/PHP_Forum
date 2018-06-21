<?php
/**
 * Created by IntelliJ IDEA.
 * User: johnfg10
 * Date: 15/01/18
 * Time: 18:56
 */

namespace john\auth;

use johnfg10\utils\Snowflake;

class User{
    /** the users id
     * @var string
     */
    private $userId;
    /** the users email address
     * @var string
     */
    private $email;
    /** the users selected username
     * @var string
     */
    private $userName;
    /** the users hashed password
     * @var string
     */
    private $password;
    /** the users firstname
     * @var string
     */
    private $firstName;
    /** the users surname
     * @var string
     */
    private $surname;

    /**
     * User constructor.
     * @param $userid string
     * @param $email string
     * @param $username string
     * @param $password string
     * @param $firstname string
     * @param $surname string
     */
    public function __construct($userid, $email, $username, $password, $firstname, $surname){
        $this->userId = $userid;
        $this->email = $email;
        $this->userName = $username;
        $this->password = $password;
        $this->firstName = $firstname;
        $this->surname = $surname;

    }

    public static function GeneratedId($email, $username, $password, $firstname, $surname) : User {
        $id = Snowflake::getUniqueId();
        return new User($id, $email, $username, $password, $firstname, $surname);
    }

    public static function GeneratedIdAndHashPassword($email, $username, $password, $firstname, $surname) : ?User{

        $passHash = password_hash($password, PASSWORD_BCRYPT);
        if ($passHash == false)
            return null;

        return self::GeneratedId($email, $username, $passHash, $firstname, $surname);
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     */
    public function setUserName(string $userName): void
    {
        $this->userName = $userName;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     */
    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    public function __toString() : string
    {
        return "{\"userid\":$this->userId, \"email\":$this->email, \"username\":$this->userName, \"firstname\":$this->firstName, \"surname\":$this->surname }";
    }
}