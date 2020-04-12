<?php

declare(strict_types=1);

namespace App\Http;


use FastRoute\RouteCollector;
use Psr\Container\ContainerInterface;
use React\EventLoop\StreamSelectLoop;

use React\Http\Server as HttpServer;
use React\Socket\Server as SocketServer;
use Throwable;

final class Server
{
    private int $port;
    private string $host;
    private RouteCollector $collector;
    private ContainerInterface $container;

    public function __construct(int $port, string $host)
    {
        $this->port = $port;
        $this->host = $host;
    }

    public function useRouters(RouteCollector $collector)
    {
        $this->collector = $collector;
    }

    public function useContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function run()
    {
        $loop = new StreamSelectLoop();
        $socket = new SocketServer($this->host.":".$this->port, $loop);

        $server = new HttpServer([new ErrorHandler(), new JsonRequestDecoder(), new Router($this->collector), $this->container]);

        $server->listen($socket);
        $server->on('error', fn(Throwable $error) => $error->getMessage());

        $loop->run();
    }
}
