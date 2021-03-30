<?php 

namespace App\Helpers;
use Illuminate\Support\Str;

use App\Exports\ResultsExport;
use Maatwebsite\Excel\Facades\Excel;

class Download{
    public $filename;
    public $header;
    public $body;

    public function __construct($filename, $header = array(), $body = array()){
        $this->filename = $filename;
        $this->header = $header;
        $this->body = $body;
    }

    public function csv(){
        $fileName = Str::slug($this->filename, '_').'.csv';

        return (object)[
            'callback' => new ResultsExport($this->header, $this->body),
            'fileName' => $fileName
        ];
    }

    public function excel(){
        $fileName = Str::slug($this->filename, '_').'.xlsx';

        return (object)[
            'callback' => new ResultsExport($this->header, $this->body),
            'fileName' => $fileName
        ];
    }
    public function pdf(){
        $fileName = Str::slug($this->filename, '_').'.pdf';

        return (object)[
            'callback' => new ResultsExport($this->header, $this->body),
            'fileName' => $fileName
        ];;
    }
}