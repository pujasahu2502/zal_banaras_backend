<?php

namespace App\Http\Controllers\Backend;

use DB;
use Log;
use Exception;
use Illuminate\Support\Str;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller{
    /**
     *
     *initialized constructor for permission's.
     *
     */
    public function __construct(){

    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request){
        try {
            $flag = '';
            $testimonialData = Testimonial::query();
            /* === SEARCH TESTIMONIAL NAME === */
            if($request->search && $request->search != null){
                $flag = 1 ;
                $testimonialData = $testimonialData
                    ->where('name', 'like', '%' . $request->search . '%');
            }

            /* === FILTER TESTIMONIAL STATUS === */
            if($request->ss != null){
                $flag = 1 ;
                if($request->ss == '1'){
                    $testimonialData = $testimonialData->where('status', $request->ss);
                }elseif($request->ss == '0'){
                    $testimonialData = $testimonialData->where('status', $request->ss);
                }else{

                }
            }
            $testimonialData = $testimonialData->orderBy('id', 'DESC')->paginate(config('app.paginate'))->appends(request()->query());
            return view('backend.testimonial.index', compact('testimonialData','flag'));
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
            $testimonialModel = view('backend.testimonial.include.add-testimonial')->render();
            return response()->json([ 'status' => 'success', 'output' => $testimonialModel ]);
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
                    'name' => [ 'required', 'unique:testimonials,name,', 'string', 'max:50' ],
                    'description' => ['required', 'max:500'],
                    'status' => ['required'],
                ],
                [
                    'name.required' => 'The author\'s name field is required.',
                    'name.unique' => 'The author\'s name already exist',
                    'description.required' => 'The testimonial field is required.',
                ]
            );

            if ($validator->fails()) {
                return response()->json([ 'status' => 'error', 'error' => $validator->errors() ]);
            }

            $data = [
                'name' => $request->name,
                'description' => $request->description,
                'status' => $request->status,
            ];

            $testimonialAdd = Testimonial::create($data);
            $testimonialAdd->refresh();
            $testimonialData = Testimonial::orderBy('id', 'DESC')->paginate(config('app.paginate'));
            $testimonialTable = view('backend.testimonial.include.testimonial-table', compact('testimonialData'))->render();
            return response()->json([ 'status' => 'success', 'message' => 'Testimonial added successfully!', 'output' => $testimonialTable ]);
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
            $testimonial = Testimonial::find($id);
            $testimonialModel = view('backend.testimonial.include.edit-testimonial', compact('testimonial'))->render();
            return response()->json([ 'status' => 'success', 'output' => $testimonialModel ]);
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
                    'name' => ['required','unique:testimonials,name,' . $id,'string','max:50',],
                    'description' => ['required', 'max:500'],
                    'status' => ['required'],
                ],
                [
                    'name.required' => 'The author\'s name field is required.',
                    'name.unique' => 'The author\'s name already exist',
                    'description.required' => 'The testimonial field is required.',
                ]
            );
            if ($validator->fails()) {
                return response()->json([ 'status' => 'error', 'error' => $validator->errors() ]);
            }

            $data = [
                'name' => $request->name,
                'description' => $request->description,
                'status' => $request->status,
            ];

            $testimonial = Testimonial::find($id);
            if ($testimonial) {
                $testimonial->update($data);
            }
            $testimonial->refresh();
            $testimonialData = Testimonial::orderBy('id', 'DESC')->paginate( config('app.paginate') );
            $testimonialTable = view('backend.testimonial.include.testimonial-table', compact('testimonialData'))->render();
            return response()->json([ 'status' => 'success', 'message' => 'Testimonial updated successfully!', 'output' => $testimonialTable ]);
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
            $testimonialData = Testimonial::find($id);
            $testimonialData->delete();
            $testimonialData->refresh();
            $testimonialData = Testimonial::orderBy('id', 'DESC')->paginate(config('app.paginate'));
            $testimonialTable = view('backend.testimonial.include.testimonial-table', compact('testimonialData','flag')
            )->render();
            return response()->json([ 'status' => 'success', 'message' => 'Testimonial deleted successfully!', 'output' => $testimonialTable ]);
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
    public function testimonialStatus($id){
        try {
            $status = Testimonial::where('id', $id)->first()->status;
            $testimonial['status'] = $status ? '0' : '1';
            $testimonial['id'] = $id;
            Testimonial::where('id', $id)->update([ 'status' => $testimonial['status'] ]);
            $testimonialStatus = view('backend.testimonial.include.status', compact('testimonial'))->render();
            return response()->json([ 'status' => 'success', 'message' => 'Status updated successfully!', 'output' => $testimonialStatus ]);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }
}