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
    public function findAll() {}

    /**
     * Retrieve an element by its id.
     *
     * @param  mixed      $id
     * @return null|mixed
     */
    public function findOneById($id) {}

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
            $date = ($cur['created_at'] != '0000-00-00 00:00:00') ? new \DateTime($cur['created_at']) : null;
            $this->comments[$cur['id']] = new Comment($cur['id'], $location, $cur['username'], $cur['body'], $date);
        }

        return $this->comments;

    }
    
}
