<?php

namespace Model;

class CommentDataMapper implements DataMapperInterface
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
     * @param Comment $object
     * @return int
     */
    public function persist($object)
    {
        if (null === $object->getId()) {
            $this->con->executeQuery(
                    "INSERT INTO comments (username, body, created_at) VALUES (:username, :body, :created_at)",
                    array(
                            'username'   => $object->getUsername(),
                            'body'       => $object->getBody(),
                            'created_at' => $object->getCreatedAt()->format('Y-m-d H:i:s'),
                        )
                );
            return $this->con->lastInsertId();
        }
        else {
            $this->con->executeQuery(
                    "UPDATE comments SET username = :username, body = :body WHERE id = :id",
                    array(
                            'id'        => $object->getId(),
                            'username'  => $object->getUsername(),
                            'body'      => $object->getBody(),
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
                "DELETE FROM comments WHERE id = :id",
                array('id' => $object->getId())
            );
    }

}
