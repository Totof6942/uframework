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
     * @var
     */
    private $created_at;

    public function __construct($id, $name, $created_at)
    {
        $this->id = $id;
        $this->name = $name;
        $this->created_at = $created_at;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return name
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
        $this->$name = $name;
    }

}
