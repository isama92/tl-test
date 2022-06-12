<?php

namespace App\Presenters;

use App\Core\Response\ResponseInterface;
use App\FactoryMethods\Response\ResponseFactoryMethod;
use App\Traits\HttpStatusCodeTrait;

abstract class Presenter
{
    use HttpStatusCodeTrait;
    use ResponseFactoryMethod;

    /**
     * @return \App\Core\Response\ResponseInterface
     */
    abstract public function present(): ResponseInterface;
}
