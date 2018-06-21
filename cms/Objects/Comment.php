<?php
/**
 * Created by IntelliJ IDEA.
 * User: johnfg10
 * Date: 18/01/18
 * Time: 11:22
 */

namespace johnfg10\cms;


use john\auth\User;
use johnfg10\utils\Snowflake;

class Comment
{
    /**
     * @var string (is actually a 64 bit int but this deals with crossplatform issues)
     */
    private $id;

    /**
     * @var string
     */
    private $thread;

    /**
     * @var string
     */
    private $comment;

    /**
     * @var string (is actually a 64 bit int but this deals with crossplatform issues)
     */
    private $author;

    /**
     * @var \DateTime
     */
    private $creation;

    public function __construct($id, $thread, $comment, $author, $creation)
    {
        $this->id = $id;
        $this->thread = $thread;
        $this->comment = $comment;
        $this->author = $author;
        $this->creation = $creation;
    }

    public static function GeneratedId($thread, $comment, $author) : Comment {
        $id = Snowflake::getUniqueId();
        return new Comment($id, $thread, $comment, $author, new \DateTime());
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getThread(): string
    {
        return $this->thread;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @return \DateTime
     */
    public function getCreation(): \DateTime
    {
        return $this->creation;
    }


}