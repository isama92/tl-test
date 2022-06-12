<?php

namespace App\FactoryMethods\Helper;

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
