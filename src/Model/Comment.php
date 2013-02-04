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

    /**
     * @var Location
     */
    private $location;

    public function __construct($id, $username, $body, \DateTime $created_at=null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->body = $body;

        if (empty($created_at)) {
            $this->created_at = new \DateTime();
        }
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setBody($body)
    {
        $this->body = $body;
    }
    
}
