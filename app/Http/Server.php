<?php

declare(strict_types=1);

namespace App\Http;


use FastRoute\RouteCollector;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use React\EventLoop\Factory;

use React\Http\Server as HttpServer;
use React\Socket\Server as SocketServer;
use Throwable;

final class Server
{
    private int $port = 8000;

    private string $host = "127.0.0.1";

    private array $requestHandlers = [];

    public function useRouters(RouteCollector $collector)
    {
        $this->requestHandlers[] = new Router($collector);
    }

    public function useContainer(ContainerInterface $container)
    {
        $this->requestHandlers[] = $container;
    }

    public function run()
    {
        $loop = Factory::create();

        $server = new HttpServer([new ErrorHandler(), new JsonRequestDecoder(), ...$this->requestHandlers]);

        $socket = new SocketServer($this->host.":".$this->port, $loop);

        $server->listen($socket);
        $server->on('error', fn(Throwable $error) => $error->getMessage());

        echo 'Listening on ' . str_replace('tcp:', 'http:', $socket->getAddress()) . "\n";

        $loop->run();
    }
}
