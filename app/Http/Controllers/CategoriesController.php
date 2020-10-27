<?php

namespace App\Http\Controllers;

use App\Http\Resources\Category as CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

use App\Category;

use DataTables;
class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['categories'] = Category::all();
        return view('contents.category', $data);
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newcategory = Category::create([
            'name' => $request->name,
            'cat_id' => $request->cat_id
        ]);

        if($newcategory)
            return response()->json(array('success' => true, 'msg' => 'New Category Added.'));
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
      
        // File Details 
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $fileSize = $file->getSize();
    
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
                    $importData[$i][] = htmlspecialchars($filedata[$c]);
                }

                $i++;
            }

            fclose($file);
            foreach($importData as $data){
                $categoryData = array();
                foreach($data as $i=>$lead){
                    $categoryData[$header[$i]] = $lead;
                }

                if(count(Category::where($categoryData)->get()) <= 0){
                    Category::create($categoryData);
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $categoryData = Category::find($request->id);
        return response()->json($categoryData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $category = Category::find($request->id);
        $category->name = $category->name;
        $category->cat_id = $category->cat_id;
        $category->save();

        if($category){
            return response()->json(array('success' => true,'msg' => 'Category Successfully Updated.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $delete = Category::find($request->id)->delete();
        if($delete){
            return response()->json(array('success' => true, 'msg' => 'Category Deleted.'));
        }
    }
    public function destroyMany(Request $request)
    {
        $categoryIds = array();

        foreach($request->category_ids as $id){
            array_push($categoryIds,$id);
        }

        $delete = Category::whereIn('id',$categoryIds)->delete();

        if($delete){
            return response()->json(array('success' => true, 'msg' => 'Categories Deleted.'));
        }
    }
    public function getCategoryAPI(){
        $categories = Category::all();
        return DataTables::of($categories)->toJson();
    }
    public function getCategoryJsonAPI(){
        $categories = Category::all();
        return CategoryResource::collection($categories);
    }
    
}
