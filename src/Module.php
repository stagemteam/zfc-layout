<?php

namespace Stagem\ZfcLayout;

use Zend\Mvc\Controller\AbstractController;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\ModuleRouteListener;
use Zend\View\Model\JsonModel;
use Zend\View\ViewEvent;
use Zend\View\Renderer\PhpRenderer;
use Zend\Console\Request as ConsoleRequest;
use Zend\Http\Request as HttpRequest;
use Zend\Http\Response as HttpResponse;

class Module
{
    public function getConfig()
    {
        $config = include __DIR__ . '/../config/module.config.php';
        //$config['service_manager'] = $config['dependencies'];
        //unset($config['dependencies']);

        return $config;
    }

    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $sharedEvents = $eventManager->getSharedManager();

        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        // Register the event listener method.
        $sharedEvents->attach(AbstractController::class, MvcEvent::EVENT_DISPATCH, [$this, 'handleDispatch']);
        $sharedEvents->attach(AbstractController::class, MvcEvent::EVENT_DISPATCH_ERROR, [$this, 'handleError']);

        #$eventManager->attach(MvcEvent::EVENT_DISPATCH, [$this, 'handleDispatch']);
        #$eventManager->attach(MvcEvent::EVENT_DISPATCH_ERROR, [$this, 'handleError']);
    }

    public function handleDispatch(MvcEvent $e)
    {
        $request = $e->getRequest();
        // inject global variables in layout after controller initialization
        if ($request instanceof HttpRequest
            && $request->isXmlHttpRequest()
            && !$e->getViewModel()->terminate()
        ) {
            // set empty layout for all not terminated ajax request
            $controller = $e->getTarget();
            $controller->layout()->setTemplate('layout/ajax');
        }
    }

    public function handleError(MvcEvent $e)
    {
        if (($request = $e->getRequest()) instanceof HttpRequest
            && $request->isXmlHttpRequest()
            && ($request->getServer('APPLICATION_ENV') !== 'development') // @todo Improve
        ) {
            /** @var \Exception $exception */
            $exception = $e->getParam('exception');
            $model = new JsonModel([
                'error' => $exception->getMessage(),
            ]);
            $e->setResult($model);

            if ($exception->getCode()) {
                $response = $e->getResponse();
                $response->setStatusCode($exception->getCode());
            }
        }
    }

    protected function isXmlHttpRequest()
    {

    }
}
