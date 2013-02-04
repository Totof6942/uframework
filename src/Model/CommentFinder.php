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
     * Constructor, load datas from the file
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
        $sth = $this->con->prepare("SELECT * FROM locations");
        $sth->execute();
        $datas = $sth->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($datas as $cur) {
            $date = ($cur['created_at'] != '0000-00-00 00:00:00') ? new \DateTime($cur['created_at']) : null;
            $this->locations[$cur['id']] = new Location($cur['id'], $cur['name'], $date);
        }

        return $this->locations;
    }

    /**
     * Retrieve an element by its id.
     *
     * @param  mixed      $id
     * @return null|mixed
     */
    public function findOneById($id)
    {
        $sth = $this->con->prepare("SELECT * FROM locations WHERE id = :id");
        $sth->bindValue(':id', $id);
        $sth->execute();
        $cur = $sth->fetch(\PDO::FETCH_ASSOC);

        if (!empty($cur)) {
            $date = ($cur['created_at'] != '0000-00-00 00:00:00') ? new \DateTime($cur['created_at']) : null;
            return new Location($cur['id'], $cur['name'], $date);
        }

        return null;
    }
    
}