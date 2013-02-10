<?php

use Model\Connection;
use Model\Location;
use Model\LocationDataMapper;

class LocationDataMapperTest extends \TestCase
{
    /**
     * @var ressource
     */
    private $con;

    public function setUp()
    {
        $this->con = new Connection('sqlite::memory:');
        $this->con->exec(<<<SQL
CREATE TABLE IF NOT EXISTS locations(
    id INTEGER NOT NULL PRIMARY KEY,
    name VARCHAR(250) NOT NULL,
    created_at DATETIME 
);
SQL
        );
    }

    public function testPersist()
    {
        $cur = $this->con->query('SELECT COUNT(*) FROM locations')->fetch(\PDO::FETCH_NUM);
        $this->assertEquals(0, $cur[0]);

        (new LocationDataMapper($this->con))->persist(new Location('La Gresle'));

        $cur = $this->con->query('SELECT COUNT(*) FROM locations')->fetch(\PDO::FETCH_NUM);
        $this->assertEquals(1, $cur[0]);
    }
  
    public function testRemove()
    {
        $mapper = new LocationDataMapper($this->con);
        $location = new Location('La Gresle');

        $cur = $this->con->query('SELECT COUNT(*) FROM locations')->fetch(\PDO::FETCH_NUM);
        $this->assertEquals(0, $cur[0]);

        $location->setId($mapper->persist($location));

        $cur = $this->con->query('SELECT COUNT(*) FROM locations')->fetch(\PDO::FETCH_NUM);
        $this->assertEquals(1, $cur[0]);

        $mapper->remove($location);

        $cur = $this->con->query('SELECT COUNT(*) FROM locations')->fetch(\PDO::FETCH_NUM);
        $this->assertEquals(0, $cur[0]);
    }

    public function testUpdate()
    {
        $mapper = new LocationDataMapper($this->con);
        $location = new Location('La Gresle');

        $location->setId($mapper->persist($location));
        $location->setName('Le Puy-en-Velay');
        
        $mapper->persist($location);

        $query = 'SELECT name FROM locations WHERE id = :id';
        $stmt = $this->con->prepare($query);
        $stmt->bindValue(':id', $location->getId());
        $stmt->execute();
        $datas = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $this->assertEquals(1, count($datas));
        $this->assertEquals('Le Puy-en-Velay', $datas[0]['name']);       
    }

}
