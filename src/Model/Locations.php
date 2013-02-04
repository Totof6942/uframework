<?php 

namespace Model;

use DAL\Connection;
use Exception\HttpException;

class Locations implements FinderInterface, PersistenceInterface
{

    /**
     * @var ressource
     */
    private $con;

    /**
     * @var string
     */
    private $fileName = '../data/locations.json';

    /**
     * @var array
     */
    private $locations;

    /**
     * Constructor, load datas from the file
     *
     * @param ressource $con Instance of Connection
     */
    public function __construct(Connection $con)
    {
        $this->con = $con;
      //  $this->loadDatas();
    }

    /**
     * Load datas from the file 
     */
    protected function loadDatas()
    {
        if (file_exists($this->fileName)) {
            $this->locations = json_decode(file_get_contents($this->fileName, true));
        }
        else {
            $this->locations = null;
        }
    }

    /**
     * Save datas in the file
     */
    protected function saveDatas()
    {
        if (!file_exists($this->fileName)) {
            fopen($this->fileName, 'w');
        }

        $ret = file_put_contents($this->fileName, json_encode($this->locations), LOCK_EX);
    
        if (!$ret) {    
            throw new Exception("Error : write in the file.", 1);
        }   
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

    /**
     * Create a new Location and save it in the file 
     *
     * @param string $name Name of the new location
     *
     * @return int Id of the new location
     */
    public function create($name)
    {
        if (strlen(trim($name)) > 0) {
            $this->locations[] = trim($name);
            $this->saveDatas();
            
            $keys = array_keys($this->locations);
            return count($keys) - 1;
        }
    }

    /**
     * Update an existing location and save the change in the file
     *
     * @param int    $id   Id of the location for update
     * @param string $name New name of the location
     */
    public function update($id, $name)
    {
        if (array_key_exists($id, $this->locations)) {

            if (strlen(trim($name)) > 0) {
                $this->locations[$id] = $name;
                $this->saveDatas();
            }
        }
    }

    /**
     * Delete an existing location and save the change in the file
     *
     * @param int $id Id of the location for delete
     */
    public function delete($id)
    {
        if (array_key_exists($id, $this->locations)) {
            array_splice($this->locations, $id, 1);
            $this->saveDatas();
        }
    }
    
}