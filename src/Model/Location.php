<?php 

namespace Model;

class Location
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var DateTime
     */
    private $created_at;

    /**
     * @var array
     */
    private $comments;

    public function __construct($id, $name, \DateTime $created_at=null)
    {
        $this->id   = $id;
        $this->name = $name;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param sring $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @return array
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param array
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }
    
}
