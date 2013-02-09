<?php

namespace Model;

class LocationDataMapper implements DataMapperInterface
{

    /**
     * @var ressource
     */
    private $con;

    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    /**
     * @param  Location $object
     * @return int
     */
    public function persist($object)
    {
        if ($this->isNew($object)) {
            $this->con->executeQuery(
                    "INSERT INTO locations (name, created_at) VALUES (:name, :created_at)",
                    array(
                            'name'       => $object->getName(),
                            'created_at' => $object->getCreatedAt()->format('Y-m-d H:i:s'),
                        )
                );

            return $this->con->lastInsertId();
        } else {
            $this->con->executeQuery(
                    "UPDATE locations SET name = :name WHERE id = :id",
                    array(
                            'id'   => $object->getId(),
                            'name' => $object->getName(),
                        )
                );

            return $object->getId();
        }
    }

    /**
     * @param Location $object
     */
    public function remove($object)
    {
        $this->con->executeQuery(
                "DELETE FROM locations WHERE id = :id",
                array('id' => $object->getId())
            );
    }

    /**
     * Test if is it a new location
     *
     * @return boolean
     */
    private function isNew(Location $location)
    {
        return null === $location->getId();
    }

}
