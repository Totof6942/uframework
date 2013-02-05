<?php 

namespace Model;

class Comment
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Location
     */
    private $location;

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

    public function __construct($id, Location $location, $username, $body, \DateTime $created_at=null)
    {
        $this->id       = $id;
        $this->location = $location;
        $this->username = $username;
        $this->body     = $body;

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
        return $this->username;
    }

    /**
     * @param string
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    
}
