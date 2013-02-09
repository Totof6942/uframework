<?php 

namespace Model;

use Exception\HttpException;

class CommentFinder implements FinderInterface
{

    /**
     * @var ressource
     */
    private $con;

    /**
     * @var array
     */
    private $comments;
    
    /**
     * Constructor
     *
     * @param ressource $con Instance of Connection
     */
    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    /**
     * Returns all elements.
     *
     * @return array
     */
    public function findAll() 
    {
        $sth = $this->con->prepare("SELECT * FROM comments");
        $sth->execute();
        $datas = $sth->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($datas as $cur) {
            $this->comments[$cur['id']] = $this->hydrate($cur);
        }

        return $this->comments;
    }

    /**
     * Retrieve an element by its id.
     *
     * @param  mixed      $id
     * @return null|mixed
     */
    public function findOneById($id) 
    {
        $sth = $this->con->prepare("SELECT * FROM comments WHERE id = :id");
        $sth->bindValue(':id', $id);
        $sth->execute();
        $cur = $sth->fetch(\PDO::FETCH_ASSOC);

        if (!empty($cur)) {
            return $this->hydrate($cur);
        }

        return null;
    }

    /**
     * Returns all comments for a location.
     *
     * @param Location $location
     *
     * @return array
     */
    public function findAllForLocation(Location $location) 
    {
        $sth = $this->con->prepare("SELECT * FROM comments WHERE location_id = :location_id ORDER BY created_at DESC");
        $sth->bindValue(':location_id', $location->getId());
        $sth->execute();
        $datas = $sth->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($datas as $cur) {
            $this->comments[$cur['id']] = $this->hydrate($cur);
        }

        return $this->comments;
    }

    /**
     * Create a Comment
     * 
     * @param $cur array
     *
     * @return Comment
     */
    private function hydrate($cur)
    {
        $date = (null === $cur['created_at']) ? null : new \DateTime($cur['created_at']);
        $location = new Comment($cur['username'], $cur['body'], $date);
        $location->setId($cur['id']);
        return $location;
    }
    
}
