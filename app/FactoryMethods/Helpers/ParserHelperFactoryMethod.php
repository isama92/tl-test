<?php

namespace App\FactoryMethods\Helpers;

use App\Helpers\ParserHelper;

trait ParserHelperFactoryMethod
{
    /**
     * @return \App\Helpers\ParserHelper
     */
    public function createParserHelper(): ParserHelper
    {
        return new ParserHelper();
    }
}
