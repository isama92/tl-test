<?php

namespace App\Core\Router;

use App\Core\Container\ContainerInterface;
use App\Core\CoreAbstract;
use App\Core\Request\RequestInterface;
use App\Core\Response\Response;
use App\Core\Response\ResponseInterface;
use App\Exceptions\Router\ControllerNotFoundException;
use App\Exceptions\Router\RouteNotFoundException;

class Router extends CoreAbstract implements RouterInterface
{
    /**
     * @var \App\Core\Container\ContainerInterface
     */
    protected ContainerInterface $container;

    /**
     * @param \App\Core\Container\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Get routes from config
     *
     * @return array
     */
    protected function getRoutes(): array
    {
        return $this->container->config()->get('routes');
    }

    /**
     * Check if given route exists
     *
     * @param array  $routes
     * @param string $route
     * @param string $method
     *
     * @return bool
     */
    protected function isRouteAvailable(array $routes, string $route, string $method): bool
    {
        // check if route exists
        if(!array_key_exists($route, $routes)) {
            return false;
        }

        // check if method exists
        if(!array_key_exists($method, $routes[$route])) {
            return false;
        }

        return true;
    }

    /**
     * Check if given controller and its method they exists
     *
     * @param string $controllerName
     * @param string $controllerMethod
     *
     * @return bool
     */
    protected function isControllerAvailable(string $controllerName, string $controllerMethod): bool
    {
        if(!class_exists($controllerName)) {
            return false;
        }

        if(!method_exists($controllerName, $controllerMethod)) {
            return false;
        }

        return true;
    }

    /**
     * @inheritDoc
     * @throws \App\Exceptions\Router\RouteNotFoundException
     * @throws \App\Exceptions\Router\ControllerNotFoundException
     */
    public function handle(RequestInterface $request): ResponseInterface
    {
        $routes = $this->getRoutes();
        $route = $request->getRoute();
        $method = $request->getMethod();

        if(!$this->isRouteAvailable($routes, $route, $method)) {
            throw new RouteNotFoundException($route);
        }

        [$controllerName, $controllerMethod] = $routes[$route][$method];

        if(!$this->isControllerAvailable($controllerName, $controllerMethod)) {
            throw new ControllerNotFoundException($controllerName, $controllerMethod);
        }

        // TODO: implements error 404 if controller not found + add error template

        $controller = new $controllerName($this->container);
        return new Response($controller->{$controllerMethod}());
    }
}
