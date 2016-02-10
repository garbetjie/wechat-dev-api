<?php

namespace WeChat\MockApi;

use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Factory as ViewFactory;
use Illuminate\View\FileViewFinder;
use Interop\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;

class View
{
    private $factory;
    private $templatePath;
    private $container;

    /**
     * View constructor.
     *
     * @param ContainerInterface $container - The container used for the application.
     */
    public function __construct (ContainerInterface $container)
    {
        $settings = $container->get('settings');
        $compiledPath = $settings['storagePath'] . DIRECTORY_SEPARATOR . 'views';
        
        $resolver = new EngineResolver();
        $resolver->register('blade', function () use ($compiledPath) {
            return new CompilerEngine(new BladeCompiler(new Filesystem(), $compiledPath));
        });
        
        $finder = new FileViewFinder(new Filesystem(), [$settings['templatePath']]);
        $factory = new ViewFactory($resolver, $finder, new Dispatcher());
        
        $this->factory = $factory;
        $this->container = $container;
    }

    /**
     * Renders the given template, and returns the contents.
     * 
     * @param string $path
     * @param array  $data
     *
     * @return string
     */
    public function render ($path, array $data = [])
    {
        // Format path.
        $path = $this->container->get('settings')['templatePath'] . DIRECTORY_SEPARATOR . $path;
        $path = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path);
        $path .= '.blade.php';
        return $this->factory->file($path, $data)->render();
    }

    /**
     * Sends the given value as JSON encoded content.
     * 
     * @param mixed $json
     *
     * @return ResponseInterface
     */
    public function json ($json)
    {
        $response = $this->container->get('response');
        /* @var ResponseInterface $response */
        
        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode($json));
        
        return $response;
    }
}
