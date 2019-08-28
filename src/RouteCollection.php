<?php

namespace Src;

class RouteCollection
{
    protected $routes_post = [];
    protected $routes_get = [];
    protected $routes_put = [];
    protected $routes_delete = [];

    public function add($type_request, $pattern, $callback)
    {
        switch ($type_request) {
            case 'post':
                return $this->addPost($pattern, $callback);
                break;
            case 'get':
                return $this->addGet($pattern, $callback);
                break;
            case 'put':
                return $this->addPut($pattern, $callback);
                break;
            case 'delete':
                return $this->addDelete($pattern, $callback);
                break;
            default:
                throw new \Exception('Tipo de requisição não implementado');
        }
    }

    public function find($type_request, $pattern)
    {
        switch ($type_request) {
            case 'post':
                return $this->findPost($pattern);
                break;
            case 'get':
                return $this->findGet($pattern);
                break;
            case 'put':
                return $this->findPut($pattern);
                break;
            case 'delete':
                return $this->findDelete($pattern);
                break;
            default:
                throw new \Exception('Tipo de requisição não implementado');
        }
    }

    protected function parseUri($uri)
    {
        return implode('/', array_filter(explode('/', $uri)));
    }

    protected function findPost($pattern_sent)
    {
        $pattern_sent = $this->parseUri($pattern_sent);

        foreach ($this->routes_post as $pattern => $callback) {
            if (preg_match($pattern, $pattern_sent, $pieces)) {
                return (object) ['callback' => $callback, 'uri' => $pieces];
            }
        }
        return false;
    }

    protected function findGet($pattern_sent)
    {
        $pattern_sent = $this->parseUri($pattern_sent);

        foreach ($this->routes_post as $pattern => $callback) {
            if (preg_match($pattern, $pattern_sent, $pieces)) {
                return (object) ['callback' => $callback, 'uri' => $pieces];
            }
        }
        return false;
    }

    protected function findPut($pattern_sent)
    {
        $pattern_sent = $this->parseUri($pattern_sent);

        foreach ($this->routes_post as $pattern => $callback) {
            if (preg_match($pattern, $pattern_sent, $pieces)) {
                return (object) ['callback' => $callback, 'uri' => $pieces];
            }
        }
        return false;
    }

    protected function findDelete($pattern_sent)
    {
        $pattern_sent = $this->parseUri($pattern_sent);

        foreach ($this->routes_post as $pattern => $callback) {
            if (preg_match($pattern, $pattern_sent, $pieces)) {
                return (object) ['callback' => $callback, 'uri' => $pieces];
            }
        }
        return false;
    }

    protected function definePattern($pattern)
    {
        $pattern = implode('/', array_filter(explode('/', $pattern)));

        return '/^' . str_replace('/', '\/', $pattern) . '$/';
    }

    protected function addPost($pattern, $callback)
    {
        $this->routes_post[$this->definePattern($pattern)] = $callback;

        return $this;
    }

    protected function addGet($pattern, $callback)
    {
        $this->routes_get[$this->definePattern($pattern)] = $callback;

        return $this;
    }

    protected function addPut($pattern, $callback)
    {
        $this->routes_put[$this->definePattern($pattern)] = $callback;

        return $this;
    }

    protected function addDelete($pattern, $callback)
    {
        $this->routes_delete[$this->definePattern($pattern)] = $callback;

        return $this;
    }
}
