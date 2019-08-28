<?php

namespace Src;

class Dispatcher
{
    public function dispatch($callback, $params = [], $namespace = "App\\")
    {
        if (is_callable($callback)) {
            return call_user_func_array($callback, array_values($params));
        } elseif (is_string($callback)) {
            if (!!strpos($callback, '@') !== false) {
                $callback = explode('@', $callback);
                $controller = $namespace.$callback[0];
                $method = $callback[1];

                $rc = new \ReflectionClass($controller);

                if ($rc->isInstantiable() && $rc->hasMethod($method)) {
                    return call_user_func_array(array(new $controller, $method), array($params));
                } else {
                    throw new \Exception("Erro ao despachar: Controller ou Método não implementados");
                }
            }
        } else {
            throw new \Exception("Erro ao despachar: Método não implementado");
        }
    }
}
