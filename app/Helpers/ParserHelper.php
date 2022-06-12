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
        // split csv string rows
        $lines = preg_split('/\r\n|[\r\n]/', $str);
        $lines = $lines !== false ? $lines : [];
        $arr = [];

        // extract data from the csv string single line
        foreach ($lines as $l) {
            $l = strip_tags($l);
            $arr[] = str_getcsv($l, $separator, $enclosure, $escape);
        }

        // if it hasn't at least 2 lines (1 line for headers and 1 for data)
        if (count($arr) < 2) {
            return [];
        }

        // map each row with its headers

        $data = [];
        $headers = array_shift($arr);

        foreach ($arr as $row) {
            $rowData = [];
            foreach ($row as $i => $col) {
                if (array_key_exists($i, $headers)) {
                    $rowData[$headers[$i]] = $col;
                }
            }
            $data[] = $rowData;
        }

        return $data;
    }
}
