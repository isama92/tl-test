<?php

namespace App\Core\Router;

use App\Core\Container\ContainerInterface;
use App\Core\CoreAbstract;
use App\Core\Request\RequestInterface;
use App\Core\Response\ResponseInterface;
use App\Exceptions\ExceptionAbstract;
use App\Exceptions\Router\ControllerNotFoundException;
use App\Exceptions\Router\RouteMethodNotFoundException;
use App\Exceptions\Router\RouteNotFoundException;
use App\FactoryMethods\Response\ResponseFactoryMethod;
use Throwable;

class Router extends CoreAbstract implements RouterInterface
{
    use ResponseFactoryMethod;

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
     * Check if given route exists
     *
     * @param array  $routes
     * @param string $route
     *
     * @return bool
     */
    protected function isRouteAvailable(array $routes, string $route): bool
    {
        return array_key_exists($route, $routes);
    }

    /**
     * Check if given method exists in the given route
     *
     * @param array  $routes
     * @param string $route
     * @param string $method
     *
     * @return bool
     */
    protected function isMethodAvailable(array $routes, string $route, string $method): bool
    {
        if(!$this->isRouteAvailable($routes, $route)) {
            return false;
        }
        return array_key_exists($method, $routes[$route]);
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
     * @param \App\Core\Request\RequestInterface $request
     *
     * @return array
     * @throws \App\Exceptions\Router\ControllerNotFoundException
     * @throws \App\Exceptions\Router\RouteMethodNotFoundException
     * @throws \App\Exceptions\Router\RouteNotFoundException
     */
    protected function resolveController(RequestInterface $request): array
    {
        $routes = $this->container->config()->get('routes');
        $route = $request->getRoute();
        $method = $request->getMethod();

        if(!$this->isRouteAvailable($routes, $route)) {
            throw new RouteNotFoundException($route);
        }

        if(!$this->isMethodAvailable($routes, $route, $method)) {
            throw new RouteMethodNotFoundException($route, $method);
        }

        [$controllerName, $controllerMethod] = $routes[$route][$method];

        if(!$this->isControllerAvailable($controllerName, $controllerMethod)) {
            throw new ControllerNotFoundException($controllerName, $controllerMethod);
        }

        return [$controllerName, $controllerMethod];
    }

    /**
     * @inheritDoc
     * @throws \App\Exceptions\Router\ControllerNotFoundException
     */
    public function handle(): ResponseInterface
    {
        $request = $this->container->request();
        $response = $this->container->response();
        $response->setStatus($response::HTTP_STATUS_CODE_OK);

        try {
            [$controllerName, $controllerMethod] = $this->resolveController($request);
            $controller = new $controllerName($this->container);
            $response->setResponse($controller->{$controllerMethod}());
        } catch(Throwable $e) {
            // TODO: log exception message and trace
            $status = $response::HTTP_STATUS_CODE_ERROR;
            if($e instanceof ExceptionAbstract) {
                $status = $e->getStatusCode();
            }

            $errorPage = $this->container->renderer()->render('error.twig', [
                'statusCode' => $status,
                'message' => $e->getMessage(),
            ]);

            $response->setStatus($status);
            $response->setResponse($errorPage);
        }

        return $response;
    }
}
