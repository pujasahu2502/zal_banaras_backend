<?php

namespace App\Http\Controllers\Backend;

use DB;
use Log;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{Variation, Attribute};
use Illuminate\Support\Facades\Validator;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class VariationController extends Controller{
    /**
     *
     *initialized constructor for permission's.
     *
     */
    public function __construct(){
        $this->middleware('permission:list-variation', ['only' => ['index']]);
        $this->middleware('permission:create-variation', ['only' => ['create']]);
        $this->middleware('permission:store-variation', ['only' => ['store']]);
        $this->middleware('permission:edit-variation', ['only' => ['edit']]);
        $this->middleware('permission:update-variation', ['only' => ['update']]);
        $this->middleware('permission:status-variation', ['only' => ['variationStatus']]);
        $this->middleware('permission:delete-variation', ['only' => ['destroy']]);
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function show(Request $request, $id){
        try {
            if($id > 0){
                $variationData = Variation::where('attribute_id', $id);
                /* === SEARCH VARIANT NAME === */
                if($request->search && $request->search != null){
                    $variationData = $variationData
                        ->where('name', 'like', '%' . $request->search . '%');
                }
                /* === FILTER VARIANT STATUS === */
                if($request->ss != null){
                    if($request->ss == '1'){
                        $variationData = $variationData->where('status', $request->ss);
                    }elseif($request->ss == '0'){
                        $variationData = $variationData->where('status', $request->ss);
                    }else{

                    }
                }

                $variationData = $variationData->orderBy('id', 'DESC')->paginate(config('app.paginate'))->appends(request()->query());
                $attribute = Attribute::where('id', $id)->first();
                return view('backend.variation.index', compact('variationData', 'attribute'));
            }
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
    public function create(Request $request){
        try {
            $id = $request->id;
            $variationModel = view('backend.variation.include.add-variation', compact('id'))->render();
            return response()->json([ 'status' => 'success', 'output' => $variationModel ]);
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
                    'name' => [ 'required', 'unique:variations,name,', 'string', 'max:50' ],
                    'status' => ['required'],
                ],
                [
                    'name.required' => 'The variant name field is required.',
                    'name.unique' => 'The variant name already exist',
                ]
            );

            if ($validator->fails()) {
                return response()->json([ 'status' => 'error', 'error' => $validator->errors() ]);
            }

            $data = [
                'attribute_id' => $request->id,
                'name' => $request->name,
                'slug' => SlugService::createSlug(Variation::class, 'slug', $request->name),
                'status' => $request->status,
            ];

            $variationAdd = Variation::create($data);
            $variationAdd->refresh();
            $variationData = Variation::where('attribute_id', $request->id)->orderBy('id', 'DESC')->paginate(config('app.paginate'));
            $variationTable = view('backend.variation.include.variation-table', compact('variationData'))->render();
            return response()->json([ 'status' => 'success', 'message' => 'Variant added successfully!', 'output' => $variationTable ]);
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
            $variation = Variation::find($id);
            $variationModel = view('backend.variation.include.edit-variation', compact('variation'))->render();
            return response()->json([ 'status' => 'success', 'output' => $variationModel ]);
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
                    'name' => ['required','unique:variations,name,' . $id,'string','max:50',],
                    'status' => ['required'],
                ],
                [
                    'name.required' => 'The variant name field is required.',
                    'name.unique' => 'The variant name already exist',
                ]
            );
            if ($validator->fails()) {
                return response()->json([ 'status' => 'error', 'error' => $validator->errors() ]);
            }

            $data = [
                'name' => $request->name,
                'status' => $request->status,
            ];

            $variation = Variation::find($id);
            if ($variation) {
                $variation->update($data);
            }
            $variation->refresh();
            $variationData = Variation::where('attribute_id', $request->id)->orderBy('id', 'DESC')->paginate( config('app.paginate') );
            $variationTable = view('backend.variation.include.variation-table', compact('variationData'))->render();
            return response()->json([ 'status' => 'success', 'message' => 'Variant updated successfully!', 'output' => $variationTable ]);
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
            $variationData = Variation::find($id);
            $variationData->delete();
            $variationData->refresh();
            $variationData = Variation::where('attribute_id', $variationData->attribute_id)->orderBy('id', 'DESC')->paginate(config('app.paginate'));
            $variationTable = view('backend.variation.include.variation-table', compact('variationData')
            )->render();
            return response()->json([ 'status' => 'success', 'message' => 'Variant deleted successfully!', 'output' => $variationTable ]);
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
    public function variationStatus($id){
        try {
            $status = Variation::where('id', $id)->first()->status;
            $variation['status'] = $status ? '0' : '1';
            $variation['id'] = $id;
            Variation::where('id', $id)->update([ 'status' => $variation['status'] ]);
            $variationStatus = view('backend.variation.include.status', compact('variation'))->render();
            return response()->json([ 'status' => 'success', 'message' => 'Status updated successfully!', 'output' => $variationStatus ]);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }
}