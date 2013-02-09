<?php 

namespace Model;

class Comment
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $body;

    /**
     * @var DateTime
     */
    private $created_at;

    public function __construct($username, $body, \DateTime $created_at=null)
    {
        $this->username = strip_tags($username);
        $this->body     = strip_tags($body);

        $created_at = (empty($created_at)) ? $this->created_at = new \DateTime() : $created_at;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id int
     */
    public function setId($id)
    {
        return $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param $username string
     */
    public function setUsername($username)
    {
        $this->username = strip_tags($username);
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param $body string
     */
    public function setBody($body)
    {
        $this->body = strip_tags($body);
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    
}
