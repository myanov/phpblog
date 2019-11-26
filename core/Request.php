<?php


namespace core;


class Request
{
    const METHOD_POST = 'POST';
    const METHOD_GET = 'GET';

    private $get;
    private $post;
    private $server;
    private $cookie;
    private $files;
    private $session;

    public function __construct($get, $post, $server, $cookie, $files, $session)
    {
        $this->get = $get;
        $this->post = $post;
        $this->server = $server;
        $this->cookie = $cookie;
        $this->files = $files;
        $this->session = $session;
    }

    public function get($key = null)
    {
        if(!$key) {
            return $this->get;
        }
        if(isset($this->get[$key])) {
            return $this->get[$key];
        }

        return null;
    }

    public function getValue(string $massive, $key = null)
    {
        if(isset($this->$massive)) {
            if(!$key) {
                return $this->$massive;
            }
            if(isset($this->$massive[$key])) {
                return $this->$massive[$key];
            }
            return null;
        } else {
            return null;
        }
    }

    public function isPost()
    {
        return $this->server['REQUEST_METHOD'] === self::METHOD_POST;
    }

    public function isGet()
    {
        return $this->server['REQUEST_METHOD'] === self::METHOD_GET;
    }
}