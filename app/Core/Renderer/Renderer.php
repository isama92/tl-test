<?php

namespace App\Core\Renderer;

use App\Core\Container\ContainerInterface;
use App\Core\CoreAbstract;
use App\Core\Request\RequestInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Renderer extends CoreAbstract implements RendererInterface
{
    /**
     * Path where views are stored
     *
     * @var string|mixed
     */
    protected string $viewsDirPath;

    /**
     * Path where views will be cached
     *
     * @var string|null
     */
    protected string|null $cachePath;

    /**
     * @var \Twig\Environment
     */
    protected Environment $twig;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $rootDir = $container->getRootDir();
        $configs = $container->config()->get('views');
        $this->viewsDirPath = $rootDir . $configs['dir'];
        $this->cachePath = !is_null($configs['cache'])? $rootDir . $configs['cache'] : null;

        $this->createTwig();

        $this->twig->addGlobal('csrfField', RequestInterface::REQUEST_CSRF_TOKEN_KEY);
        $this->twig->addGlobal('csrfValue', $container->session()->token());
    }

    /**
     * @return void
     */
    protected function createTwig(): void
    {
        $configs = [];

        if(!is_null($this->cachePath)) {
            $configs['cache'] = $this->cachePath;
        }

        $loader = new FilesystemLoader($this->viewsDirPath);
        $this->twig = new Environment($loader, $configs);
    }

    /**
     * @inheritDoc
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function render(string $view, array $params = []): string
    {
        return $this->twig->render($view, $params);
    }
}
