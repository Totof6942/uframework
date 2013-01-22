<?php 

namespace Model;

use Exception\HttpException;

class Location implements FinderInterface, PersistenceInterface
{
	/**
	 * @var array
	 */
	private $locations = array(
			'63113'	=> array(
					'name' 		=> 'Clermont-Ferrand',
					'country'	=> 'France',
					'region'	=> 'Auvergne',
					'postal' 	=> '63000',
				),
			'63014'	=> array(
					'name' 		=> 'Aubiere',
					'country'	=> 'France',
					'region'	=> 'Auvergne',
					'postal' 	=> '63170',
				),
			'42104'	=> array(
					'name' 		=> 'La Gresle',
					'country'	=> 'France',
					'region'	=> 'Rhone-Alpes',
					'postal' 	=> '42460',
				),
			'42187'	=> array(
					'name' 		=> 'Roanne',
					'country'	=> 'France',
					'region'	=> 'Rhone-Alpes',
					'postal' 	=> '42300',
				),
			'43157'	=> array(
					'name' 		=> 'Le Puy-en-Velay',
					'country'	=> 'France',
					'region'	=> 'Auvergne',
					'postal' 	=> '43000',
				),
		);
	
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
			return $this->locations[$id];
		else 
			throw new HttpException(404, "Object doesn't exist");
	}

	/**
	 * @param string $name Name of the new location
	 *
	 * @return int Id of the new location
	 */
	public function create($name)
	{

	}

	public function update($id, $name)
	{

	}

	public function delete($id)
	{
		
	}
	
}