<?php

namespace Src;

use Src\Dispatcher;
use Src\RouteCollection;

class Router
{
    protected $collection;
    protected $dispatcher;

    public function __construct()
    {
        $this->collection = new RouteCollection;
        $this->dispatcher = new Dispatcher;
    }

    public function get($pattern, $callback)
    {
        $this->collection->add('get', $pattern, $callback);
        return $this;
    }

    public function post($pattern, $callback)
    {
        $this->collection->add('post', $pattern, $callback);
        return $this;
    }

    public function put($pattern, $callback)
    {
        $this->collection->add('put', $pattern, $callback);
        return $this;
    }

    public function delete($pattern, $callback)
    {
        $this->collection->add('delete', $pattern, $callback);
        return $this;
    }

    public function find($type_request, $pattern)
    {
        return $this->collection->find($type_request, $pattern);
    }

    protected function dispatch($route, $namespace = "App\\")
    {
        return $this->dispatcher->dispatch($route->callback, $route->uri, $namespace);
    }

    protected function notFound()
    {
        return header("HTTP/1.0 404 Not Found", true, 404);
    }

    public function resolve($request)
    {
        $route = $this->find($request->method(), $request->uri());

        if ($route) {
            return $this->dispatch($route);
        }
        return $this->notFound();
    }
}
