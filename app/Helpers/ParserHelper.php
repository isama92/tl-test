<?php

namespace App\Helpers;

class ParserHelper
{
    /**
     * Convert a CSV string to an array
     *
     * @param string $str
     * @param string $separator
     * @param string $enclosure
     * @param string $escape
     *
     * @return array
     */
    public function csvToArray(
        string $str,
        string $separator = ',',
        string $enclosure = '"',
        string $escape = '\\'
    ): array {
        $lines = preg_split('/\r\n|[\r\n]/', $str);
        $arr = [];

        foreach ($lines as $l) {
            $arr[] = str_getcsv($l, $separator, $enclosure, $escape);
        }

        return $arr;
    }
}
