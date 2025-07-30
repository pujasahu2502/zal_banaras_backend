<?php

namespace App\Http\Controllers\Backend;

use Log;
use Exception;
use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller{
    /**
    *
    *initialized constructor for permission's.
    *
    */
    public function __construct(){
        $this->middleware('permission:list-faq', ['only' => ['index']]);
        $this->middleware('permission:create-faq', ['only' => ['create']]);
        $this->middleware('permission:store-faq', ['only' => ['store']]);
        $this->middleware('permission:edit-faq', ['only' => ['edit']]);
        $this->middleware('permission:update-faq', ['only' => ['update']]);
        $this->middleware('permission:destroy-faq', ['only' => ['destroy']]);
        $this->middleware('permission:status-faq', ['only' => ['faqStatus']]);
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request){
        try {
            $flag = '';
            $faqs = Faq::latest();
            /* === FILTER FAQ STATUS === */
            if($request->ss != null){
                $flag = 1;
                if($request->ss == '1'){
                    $faqs = $faqs->where('status', $request->ss);
                }elseif($request->ss == '0'){
                    $faqs = $faqs->where('status', $request->ss);
                }else{

                }
            }
            $faqs = $faqs->orderBy('id', 'DESC')->paginate(config('app.paginate'))->appends(request()->query());
            return view('backend.faq.index', compact('faqs','flag'));
        } catch (Exception $ex) {
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
            $faqModel = view('backend.faq.include.add-faq-model')->render();
            return response()->json([ 'status' => 'success', 'output' => $faqModel ]);
        } catch (Exception $ex) {
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
                    'question' => ['required', 'string', 'max:300'],
                    'answer' => ['required', 'string', 'max:3000'],
                    'url' => ['nullable', 'url', 'max:100'],
                    'status' => ['required'],
                    'faq_category' => ['required', 'string']
                ],
                [
                    'url.url' => 'The video url must be a valid URL.',
                ]
            );

            if ($validator->fails()) {
                return response()->json([ 'status' => 'error', 'error' => $validator->errors() ]);
            }

            $data = [
                'question' => $request->question,
                'answer' => $request->answer,
                'url' => $request->url,
                'status' => $request->status,
                'faq_category' => $request->faq_category
            ];

            $faqAdd = Faq::create($data);
            $faqAdd->refresh();

            $faqs = Faq::orderBy('id', 'DESC')->paginate(config('app.paginate'));
            $faqTable = view('backend.faq.include.faq-table', compact('faqs'))->render();
            return response()->json([ 'status' => 'success', 'message' => 'FAQ added successfully!', 'output' => $faqTable ]);
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
            $faq = Faq::find($id);
            $faqModel = view('backend.faq.include.edit-faq', compact('faq') )->render();
            return response()->json([ 'status' => 'success', 'output' => $faqModel ]);
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
            $validator = Validator::make($request->all(), [
                'question' => ['required', 'string', 'max:300'],
                'answer' => ['required', 'string', 'max:3000'],
                'url' => ['nullable', 'url', 'max:100'],
                'status' => ['required'],
                'faq_category' => ['required', 'string']
            ]);

            if ($validator->fails()) {
                return response()->json([ 'status'=>'error', 'error'=>$validator->errors() ]);
            }

            $data = [
                'question' => $request->question,
                'answer' => $request->answer,
                'url' => $request->url,
                'status' => $request->status,
                'faq_category' => $request->faq_category
            ];

            $faqEdit = Faq::find($id);
            if ($faqEdit) {
                $faqEdit->update($data);
                $faqEdit->refresh();
            }

            $faqs = Faq::orderBy('id', 'DESC')->paginate(config('app.paginate'));
            $faqTable = view('backend.faq.include.faq-table', compact('faqs'))->render();
            return response()->json([ 'status' => 'success', 'message' => 'FAQ updated successfully!', 'output' => $faqTable ]);
        } catch (Exception $ex) {
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
            $faqData = Faq::find($id);
            $faqData->delete();
            $faqs = Faq::orderBy('id', 'DESC')->paginate(config('app.paginate'));
            $faqTable = view('backend.faq.include.faq-table', compact('faqs','flag'))->render();
            return response()->json([ 'status' => 'success', 'message' => 'FAQ deleted successfully!', 'output' => $faqTable ]);
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
    public function faqStatus($id){
        try {
            $status = Faq::where('id', $id)->first()->status;
            $faq['status'] = $status ? '0' : '1';
            $faq['id'] = $id;
            Faq::where('id', $id)->update([ 'status' => $faq['status'] ]);
            $faqStatus = view('backend.faq.include.status', compact('faq'))->render();
            return response()->json([ 'status' => 'success', 'message' => 'Status updated successfully!', 'output' => $faqStatus ]);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }
}