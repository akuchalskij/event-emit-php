<?php

declare(strict_types=1);

namespace App\Http;

use FastRoute\Dispatcher;
use FastRoute\Dispatcher\GroupCountBased;
use FastRoute\RouteCollector;
use LogicException;
use Psr\Http\Message\ServerRequestInterface;
use React\Http\Response;


final class Router
{
    private GroupCountBased $dispatcher;

    public function __construct(RouteCollector $collector)
    {
        $this->dispatcher = new GroupCountBased($collector->getData());
    }

    public function __invoke(ServerRequestInterface $request)
    {
        $routeInfo = $this->dispatcher->dispatch(
            $request->getMethod(),
            $request->getUri()->getPath()
        );

        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                return new Response(404, ['Content-Type' => 'text/plain'], 'Not found');
            case Dispatcher::METHOD_NOT_ALLOWED:
                return new Response(405, ['Content-Type' => 'text/plain', 'Method not allowed']);
            case Dispatcher::FOUND:
                return $routeInfo[1]($request, ...array_values($routeInfo[2]));
        }

        throw new LogicException('Something went wrong');
    }
}
