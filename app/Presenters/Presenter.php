<?php

namespace App\Presenters;

use App\FactoryMethods\Response\ResponseFactoryMethod;
use App\Traits\HttpStatusCodeTrait;

abstract class Presenter implements PresenterInterface
{
    use HttpStatusCodeTrait;
    use ResponseFactoryMethod;
}
