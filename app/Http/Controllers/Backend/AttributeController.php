<?php

namespace App\Http\Controllers\Backend;

use DB;
use Log;
use Exception;
use Illuminate\Support\Str;
use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class AttributeController extends Controller{
    /**
     *
     *initialized constructor for permission's.
     *
     */
    public function __construct(){
        $this->middleware('permission:list-attribute', ['only' => ['index']]);
        $this->middleware('permission:create-attribute', ['only' => ['create']]);
        $this->middleware('permission:store-attribute', ['only' => ['store']]);
        $this->middleware('permission:edit-attribute', ['only' => ['edit']]);
        $this->middleware('permission:update-attribute', ['only' => ['update']]);
        $this->middleware('permission:status-attribute', ['only' => ['attributeStatus']]);
        $this->middleware('permission:delete-attribute', ['only' => ['destroy']]);
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request){
        try {
            $flag = '';
            $attributeData = Attribute::query();
            /* === SEARCH ATTRIBUTE NAME === */
            if($request->search && $request->search != null){
                $flag = 1 ;
                $attributeData = $attributeData
                    ->where('name', 'like', '%' . $request->search . '%');
            }
             /* === FILTER SHORT BY=== */
             if($request->sort_by != null){
                $flag = 1 ;
                $sortBy = $request->sort_by;
                if($sortBy == '1'){
                    $attributeData = $attributeData->oldest();
                }elseif($sortBy == '2'){
                    $attributeData = $attributeData->latest();
                }elseif($sortBy == '3'){
                    $attributeData = $attributeData->orderBy('name','ASC');
                }elseif($sortBy == '4'){
                    $attributeData = $attributeData->orderBy('name','DESC');
                }else{

                }
            }
            /* === FILTER ATTRIBUTE STATUS === */
            if($request->ss != null){
                $flag = 1 ;
                if($request->ss == '1'){
                    $attributeData = $attributeData->where('status', $request->ss);
                }elseif($request->ss == '0'){
                    $attributeData = $attributeData->where('status', $request->ss);
                }else{

                }
            }
            $attributeData = $attributeData->orderBy('id', 'DESC')->paginate(config('app.paginate'))->appends(request()->query());
            return view('backend.attribute.index', compact('attributeData','flag'));
        } catch (\Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create(){
        try {
            $attributeModel = view('backend.attribute.include.add-attribute')->render();
            return response()->json([ 'status' => 'success', 'output' => $attributeModel ]);
        } catch (\Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request){
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => [ 'required', 'unique:attributes,name,', 'string', 'max:50' ],
                    'status' => ['required'],
                ],
                [
                    'name.required' => 'The attribute name field is required.',
                    'name.unique' => 'The attribute name already exist',
                ]
            );

            if ($validator->fails()) {
                return response()->json([ 'status' => 'error', 'error' => $validator->errors() ]);
            }

            $data = [
                'name' => $request->name,
                'slug' => SlugService::createSlug(Attribute::class, 'slug', $request->name),
                'status' => $request->status,
            ];

            $attributeAdd = Attribute::create($data);
            $attributeAdd->refresh();
            $attributeData = Attribute::orderBy('id', 'DESC')->paginate(config('app.paginate'));
            $attributeTable = view('backend.attribute.include.attribute-table', compact('attributeData'))->render();
            return response()->json([ 'status' => 'success', 'message' => 'Attribute added successfully!', 'output' => $attributeTable ]);
        } catch (\Exception $ex) {
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
            $attribute = Attribute::find($id);
            $attributeModel = view('backend.attribute.include.edit-attribute', compact('attribute'))->render();
            return response()->json([ 'status' => 'success', 'output' => $attributeModel ]);
        } catch (\Exception $ex) {
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
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => ['required','unique:attributes,name,' . $id,'string','max:50',],
                    'status' => ['required'],
                ],
                [
                    'name.required' => 'The attribute name field is required.',
                    'name.unique' => 'The attribute name already exist',
                ]
            );
            if ($validator->fails()) {
                return response()->json([ 'status' => 'error', 'error' => $validator->errors() ]);
            }

            $data = [
                'name' => $request->name,
                'status' => $request->status,
            ];

            $attribute = Attribute::find($id);
            if ($attribute) {
                $attribute->update($data);
            }
            $attribute->refresh();
            $attributeData = Attribute::orderBy('id', 'DESC')->paginate( config('app.paginate') );
            $attributeTable = view('backend.attribute.include.attribute-table', compact('attributeData'))->render();
            return response()->json([ 'status' => 'success', 'message' => 'Attribute updated successfully!', 'output' => $attributeTable ]);
        } catch (\Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id){
        try {
            $flag = '';
            $attributeData = Attribute::find($id);
            $attributeData->delete();
            $attributeData->refresh();
            $attributeData = Attribute::orderBy('id', 'DESC')->paginate(config('app.paginate'));
            $attributeTable = view('backend.attribute.include.attribute-table', compact('attributeData','flag')
            )->render();
            return response()->json([ 'status' => 'success', 'message' => 'Attribute deleted successfully!', 'output' => $attributeTable ]);
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
    public function attributeStatus($id){
        try {
            $status = Attribute::where('id', $id)->first()->status;
            $attribute['status'] = $status ? '0' : '1';
            $attribute['id'] = $id;
            Attribute::where('id', $id)->update([ 'status' => $attribute['status'] ]);
            $attributeStatus = view('backend.attribute.include.status', compact('attribute'))->render();
            return response()->json([ 'status' => 'success', 'message' => 'Status updated successfully!', 'output' => $attributeStatus ]);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }
}