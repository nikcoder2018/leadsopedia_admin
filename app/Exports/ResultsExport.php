<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ResultsExport implements FromArray, WithHeadings
{
    public $header;
    public $body;
    public $map;
    function __construct($header, $body, $map = array()){
        $this->header = $header;
        $this->body = $body;
        $this->map = $map;
    }

    public function array(): array
    {
        return [$this->body];
    }

    public function headings(): array
    {
        return $this->header;
    }
}
