<?php

/**
 * Description of Response
 *
 */
class Response {
    use tSingleton;
    
    protected int $code = 200;
    protected array $headers = [];
    
    public function setHeader(string $k, $v): self {
        $this->headers[$k] = $v;
        return $this;
    }
    
    public function hasHeader(string $k): bool {
        return array_key_exists($k, $this->headers);
    }
    
    public function delHeader(string $k): self {
        if($this->hasHeader($k)) {
            unset($this->headers[$k]);
        }
        return $this;
    }
    
    public function res($res, ?int $code = null) {
        http_response_code(empty($code)? $this->code : $code);
        foreach($this->headers as $k => $v) {
            header(''.$k.': '.(is_string($v)? $v:implode('; ', $v)));
        }
        echo $res;
        exit;
    }
    
    public function json($o, ?int $code = null) {
        $this->setHeader('Content-Type', 'application/json');
        $this->res(json_encode($o), $code);
    }
}
