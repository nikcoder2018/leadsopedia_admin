<?php

namespace App\Http\Controllers;

ini_set('MAX_EXECUTION_TIME', '-1');

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use App\Http\Resources\Country as ResourceCountry;
use App\Http\Resources\Currency as ResourceCurrency;
use App\Http\Resources\Languages as ResourceLanguages;

use App\Lead;
use DataTables;

class APIController extends Controller
{
    public function getAllLeads(){
        $leadsData = Lead::all();
        return DataTables::of($leadsData)->toJson();
    }

    public function importLeads(Request $request){
        $file = $request->file('file');
      
        // File Details 
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $tempPath = $file->getRealPath();
        $fileSize = $file->getSize();
        $mimeType = $file->getMimeType();
    
        // Valid File Extensions
        $valid_extension = array("csv");
    
        // 2MB in Bytes
        $maxFileSize = 2097152; 
    
        // Check file extension
        if(in_array(strtolower($extension),$valid_extension)){
    
            // Check file size
            if($fileSize <= $maxFileSize){
    
            // File upload location
            $location = 'uploads';
    
            // Upload file
            $file->move($location,$filename);
    
            // Import CSV to Database
            $filepath = public_path($location."/".$filename);
    
            // Reading file
            $file = fopen($filepath,"r");
    
            $importData = array();
            $header = array();

            $i = 0;
                
            while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                $num = count($filedata );
                
                // Skip first row (Remove below comment if you want to skip the first row)
                if($i == 0){
                    for ($c=0; $c < $num; $c++) {
                        $header[$c] = Str::slug($filedata[$c], '_');
                    }
                    $i++;
                    continue; 
                }

                for ($c=0; $c < $num; $c++) {
                    $importData[$i][] = $filedata [$c];
                }

                $i++;
            }

            fclose($file);

            foreach($importData as $data){
                $leadData = array();
                foreach($data as $i=>$lead){
                    $leadData[$header[$i]] = $lead;
                }

                if(count(Lead::where($leadData)->get()) <= 0){
                    Lead::create($leadData);
                }
                
            }
            
            return response()->json(array('success' => true, 'msg' => 'File Import Successfully.'));
            }else{
            return response()->json(array('success' => false, 'msg' => 'File too large. File must be less than 2MB.'));
            }
    
        }else{
            return response()->json(array('success' => true, 'msg' => 'Invalid File Extension.'));
        }
    }

    public function countries(){
        $contents = file_get_contents('countries.json');
        $contents = json_decode($contents);
        return new ResourceCountry($contents);
    }
    public function currencies(){
        $contents = file_get_contents('currency-symbols.json');
        $contents = json_decode($contents);
        return new ResourceCurrency($contents);
    }
    public function languages(){
        $contents = file_get_contents('languages.json');
        $contents = json_decode($contents);
        return new ResourceLanguages([$contents]);
    }
}
