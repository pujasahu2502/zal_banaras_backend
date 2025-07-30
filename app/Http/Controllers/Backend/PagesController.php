<?php

namespace App\Http\Controllers\Backend;

use Log; 
use Exception;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PagesController extends Controller{
    /**
    *
    *initialized constructor for permission's.
    *
    */
    public function __construct(){
        $this->middleware('permission:list-page', ['only' => ['index']]);
        $this->middleware('permission:create-page', ['only' => ['create']]);
        $this->middleware('permission:store-page', ['only' => ['store']]);
        $this->middleware('permission:edit-page', ['only' => ['edit']]);
        $this->middleware('permission:update-page', ['only' => ['update']]);
        $this->middleware('permission:status-page', ['only' => ['pageStatus']]);
        $this->middleware('permission:delete-page', ['only' => ['destroy']]);
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request){
        try {
            $flag = '';
            $pages = Page::latest();
            /* === FILTER PAGE STATUS === */
            if($request->ss != null){
                $flag = 1;
                if($request->ss == '1'){
                    $pages = $pages->where('status', $request->ss);
                }elseif($request->ss == '0'){
                    $pages = $pages->where('status', $request->ss);
                }else{

                }
            }
            $pages = $pages->orderBy('id', 'DESC')->paginate(config('app.paginate'))->appends(request()->query());
            return view('backend.pages.index', compact('pages', 'flag'));
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id){
        try {
            $page = Page::find($id);
            $pageModel = view('backend.pages.include.edit-page', compact('page') )->render();
            return response()->json([ 'status' => 'success', 'output' => $pageModel ]);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id){
        try {
            $validator = Validator::make($request->all(),
                [
                'title' => ['required', 'string', 'max:30'],
                'description' => ['required', 'string', 'max:50000'],
                'url' => ['nullable', 'url', 'max:100'],
                'status' => ['required'],
                ],
                [
                    'title.required' => 'The page title field is required.',
                ]
            );

            if ($validator->fails()) {
                return response()->json([ 'status'=>'error', 'error'=>$validator->errors() ]);
            }

            $data = [
                'title' => $request['title'],
                'status' => $request['status'],
                'description' => $request['description'],
                'url' => $request['url']
            ];

            $pageEdit = Page::find($id);
            if ($pageEdit) {
                $pageEdit->update($data);
                $pageEdit->refresh();
            }

            $pages = Page::orderBy('id', 'DESC')->paginate(config('app.paginate'));
            $pageTable = view('backend.pages.include.page-table', compact('pages'))->render();
            return response()->json([ 'status' => 'success', 'message' => 'Page updated successfully!', 'output' => $pageTable ]);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }

    /**
    * Status of the  specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function pageStatus($id){
        try {
            $status = Page::where('id', $id)->first()->status;
            $page['status'] = $status ? '0' : '1';
            $page['id'] = $id;
            Page::where('id', $id)->update([ 'status' => $page['status'] ]);
            $pageStatus = view('backend.pages.include.status', compact('page'))->render();
            return response()->json([ 'status' => 'success', 'message' => 'Status updated successfully!', 'output' => $pageStatus ]);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }
}