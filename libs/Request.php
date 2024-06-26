<?php

/**
 * Description of Request
 *
 */
class Request {
    use tSingleton;
    
    const METHOD_GET = 'get';
    const METHOD_POST = 'post';
    const METHOD_HEAD = 'head';
    const METHOD_DELETE = 'delete';
    const METHOD_PUT = 'put';
    const METHOD_OPTIONS = 'options';
    
    protected ?string $method = null;
    protected array $headers = [];
    protected $body = null;
    protected array $data = [];
    
    protected function __construct() {
        $this->method = strtolower($_SERVER['REQUEST_METHOD']);
        foreach($_SERVER as $k => $v) { // this emulates getallheaders
            $k = strtolower($k);
            if(str_starts_with($k, 'http_')) {
                // get the standard header name
                $sk = str_replace(' ', '-', ucwords(str_replace('_', ' ', substr($k, 5))));
                $this->headers[$sk] = $v;
            }
        }
        $this->body = file_get_contents('php://input');
        if(str_contains($this->getHeader('Content-Type', ''), '/json')) {
            $this->data = json_decode($this->body, true);
        } else {
            $this->data = $_REQUEST;
        }
    }
    
    public function getMethod(): ?string {
        return $this->method;
    }
    
    public function hasHeader(string $k): bool {
        return array_key_exists($k, $this->headers);
    }
    
    public function getHeaders(): array {
        return $this->headers;
    }
    
    public function getHeader(string $k, $def = null) {
        return $this->hasHeader($k)? $this->headers[$k]:$def;
    }
    
    public function is(string $method): bool {
        return ($this->method == strtolower($method));
    }
    
    public function hasData(string $k): bool {
        return array_key_exists($k, $this->data);
    }
    
    public function getAllData(): array {
        return $this->data;
    }
    
    public function getData(string $k, $def = null) {
        return $this->hasData($k)? $this->data[$k]:$def;
    }
}
