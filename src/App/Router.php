<?php

namespace OnlineShop\App;


class Router
{
    private array $handlers;
    private $notFoundHandler;
    private const METHOD_POST = 'POST';
    private const METHOD_GET = 'GET';

    public function get(string $path, $handler): void
    {
        $this->addHandler(method: self::METHOD_GET, path:$path, handler:$handler);
    }

    public function post(string $path, $handler): void
    {
        $this->addHandler(method:self::METHOD_POST, path:$path, handler:$handler);
    }

    public function addNotFoundHandler($handler): void
    {
        $this->notFoundHandler = $handler;
    }

    private function addHandler(string $method, string $path, $handler): void
    {
        $this->handlers[$method . $path] = [
            'path' => $path,
            'method' => $method,
            'handler' => $handler,
        ];
    }

    public function run()
    {
        $requestUri = parse_url($_SERVER['REQUEST_URI']);
        $requestPath = $requestUri['path'];
        $method = $_SERVER['REQUEST_METHOD'];

        $callback = null;
        foreach ($this->handlers as $handler){
            if ($handler['path'] === $requestPath && $method === $handler['method']){
                $callback = $handler['handler'];
            }
        }

        if(is_string($callback)){
            $parts = explode('::', $callback);
            if (is_array($parts)){
                $className = array_shift(array:$parts);
                $handler = new $className;

                $method = array_shift(array: $parts);
                $callback = [$handler, $method];
            }
        }

        if (!$callback){
            header(header: "HTTP/1.0 404 N=T FOUND");
            if (!empty($this->notFoundHandler)){
                $callback = $this->notFoundHandler;
            }
        }

        call_user_func_array($callback, [
            array_merge($_GET, $_POST)
        ]);
    }
}