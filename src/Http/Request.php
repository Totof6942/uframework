<?php

use Negociation\Negociator;

namespace Http;

class Request
{
    /**
     * @var string
     */
    const GET    = 'GET';

    /**
     * @var string
     */
    const POST   = 'POST';

    /**
     * @var string
     */
    const PUT    = 'PUT';

    /**
     * @var string
     */
    const DELETE = 'DELETE';

    /**
     * @var array
     */
    private $parameters = array();

    /**
     * Constructor
     * @param $query   Is an array of GET parameters ($_GET)
     * @param $request Is an array of POST parameters ($_POST)
     */
    public function __construct(array $query = array(), array $request = array())
    {
        $this->parameters = array_merge($query, $request);
    }

    /**
     * Create this class
     *
     * @return Request Instance of Request
     */
    public static function createFromGlobals()
    {
        return new self($_GET, $_POST);
    }

    /**
     * Get a paramter in $_GET or $_POST
     *
     * @param string $name    Name of the parameter
     * @param mixed  $default The value used if the parameter not exist
     *
     * @return mixed The value of the parameter
     */
    public function getParameter($name, $default = null)
    {
        if (array_key_exists($name, $this->parameters)) {
            return $this->parameters[$name];
        }

        return $default;
    }

    /**
     * Get the HTTP verb
     * 
     * @return string The HTTP verb of the request
     */
    public function getMethod()
    {
        $method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : self::GET;

        if (self::POST === $method) {
            return $this->getParameter('_method', $method);
        }

        return $method;
    }

    /**
     * Get the URI
     *
     * @return string The URI
     */
    public function getUri()
    {
        $uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
        
        if ($pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }

        return $uri;
    }

    public function guessBestFormat()
    {
        $negociator = new Negociator();

        $acceptHeader = isset($_SERVER['HTTP_ACCEPT']) ? $_SERVER['HTTP_ACCEPT'] : 'text/html';
        $priorities = array('html', 'json', '*/*');

        return $negociator->getBest($acceptHeader, $priorities);
    }
}
