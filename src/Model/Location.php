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

    public function __construct($name, \DateTime $created_at=null)
    {
        $this->name = strip_tags($name);

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name sring
     */
    public function setName($name)
    {
        $this->name = strip_tags($name);
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
