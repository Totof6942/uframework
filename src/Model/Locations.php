<?php 

namespace Model;

use Exception\HttpException;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

class Locations implements FinderInterface, PersistenceInterface
{

    /**
     * @var string
     */
    private $fileName = '../data/locations.json';

    /**
     * @var array
     */
    private $locations;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * Constructor, load datas from the file
     */
    public function __construct()
    {
        $this->loadDatas();

        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());

        $this->serializer = new Serializer($normalizers, $encoders);
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

        $ret = file_put_contents($this->fileName, $this->serializer->serialize($this->locations), LOCK_EX);

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
        if (array_key_exists($id, $this->locations))
            return array($id => $this->locations[$id]);

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