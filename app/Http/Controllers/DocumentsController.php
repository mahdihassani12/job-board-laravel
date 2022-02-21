<?php

namespace App\Http\Controllers;

use App\Document;
use Illuminate\Http\Request;

class DocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        try{

            $this->validate($request,[
                'document_type' => 'required',       
                'document_name' => 'required',       
            ],
             [
                 'document_type.required'  => 'فیلد نوعیت مدرک الزامی میباشد.',
                 'document_name.required' => 'فیلد انتخاب عکس الزامی میباشد.'
             ]);

            if ($files = $request->file('document_name')) {
               $destinationPath = 'uploads/documents/'; // upload path

               foreach($files  as $file){

                    $document_image = uniqid() . "." . $file->getClientOriginalExtension();
                    $file->move($destinationPath, $document_image);
                    $document = new Document();
                    $data = $request -> all(); 
                    $document -> document_name = $document_image;
                    $document -> student_id = $data['student_id'];
                    $document -> document_type =  $data['document_type']; 
                    $document -> save();
                    
               }

            }
            
            return redirect()->back()->with('success','عملیات موفقانه انجام شد.');

        }
        catch(Exception $e){
            return redirect()->back()->with('error','عملیات انجام نشد!');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{

            $this->validate($request,[
                'document_type' => 'required',       
                'document_name' => 'required',       
            ],
             [
                 'document_type.required'  => 'فیلد نوعیت مدرک الزامی میباشد.',
                 'document_name.required' => 'فیلد انتخاب عکس الزامی میباشد.'
             ]);

            $document =Document::find($id);
            $data = $request -> all();

            if ($files = $request->file('document_name')) {
               $destinationPath = 'uploads/documents/'; // upload path

               foreach($files as $file){

                    $document_image = date('YmdHis') . "." . $file->getClientOriginalExtension();
                    $file->move($destinationPath, $document_image);
                    $document -> document_name = $document_image;

                    $photo = Document::find($id)->document_name;
                    if(!is_null($photo) && file_exists(public_path('uploads/documents/'.$photo))){
                        unlink(public_path('uploads/documents/'.$photo));
                    }

               }

            }

            $document -> document_type =  $data['document_type'];
            $document -> user_id = auth()->user()->id ;            
            $document -> save();
            return redirect()->route('user_profile')->with('success','عملیات موفقانه انجام شد.');

        }
        catch(Exception $e){
            return redirect()->back()->with('error','عملیات انجام نشد!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
           $document = Document::find($id);
           $document -> delete();
           return redirect()->back()->with('success','عملیات موفقانه انجام شد.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error','عملیات انجام نشد!');
        }

    }
}
