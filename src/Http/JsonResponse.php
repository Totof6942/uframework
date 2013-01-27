<?php

namespace Http;

class JsonResponse extends Response
{

    public function __construct($content, $statusCode = 200, array $headers = array())
    {
        $this->content    = json_encode($content);
        $this->statusCode = $statusCode;
        $this->headers    = array_merge(array('Content-Type' => 'application/json'), $headers);
    }

}
