<?php

namespace App\Http\Controllers\Backend;

use DB;
use Log;
use Exception;
use Illuminate\Support\Str;
use App\Models\{Category, SeoAnalysis};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class CategoryController extends Controller{
    /**
     *
     *initialized constructor for permission's.
     *
     */
    public function __construct(){
        $this->middleware('permission:list-category', ['only' => ['index']]);
        $this->middleware('permission:create-category', ['only' => ['create']]);
        $this->middleware('permission:store-category', ['only' => ['store']]);
        $this->middleware('permission:edit-category', ['only' => ['edit']]);
        $this->middleware('permission:update-category', ['only' => ['update']]);
        $this->middleware('permission:status-category', ['only' => ['categoryStatus']]);
        $this->middleware('permission:delete-category', ['only' => ['destroy']]);
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request){
        try {
            $categoryData = Category::query();
            $flag ='';
            /* === SEARCH CATEGORY NAME === */
            if($request->search && $request->search != null){
                $flag = 1;
                $categoryData = $categoryData
                    ->where('name', 'like', '%' . $request->search . '%');
            }
            /* === FILTER SHORT BY === */
            if($request->sort_by != null){
                $flag = 1;
                $sortBy = $request->sort_by;
                if($sortBy == '1'){
                    $categoryData = $categoryData->oldest();
                }elseif($sortBy == '2'){
                    $categoryData = $categoryData->latest();
                }elseif($sortBy == '3'){
                    $categoryData = $categoryData->orderBy('name','ASC');
                }elseif($sortBy == '4'){
                    $categoryData = $categoryData->orderBy('name','DESC');
                }else{

                }
            }
            /* === FILTER CATEGORY STATUS === */
            if($request->ss != null){
                $flag = 1;
                if($request->ss == '1'){
                    $categoryData = $categoryData->where('status', $request->ss);
                }elseif($request->ss == '0'){
                    $categoryData = $categoryData->where('status', $request->ss);
                }else{

                }
            }
            $categoryData = $categoryData->orderBy('id', 'DESC')->paginate(config('app.paginate'))->appends(request()->query());
            return view('backend.category.index', compact('categoryData','flag'));
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
            $categoryModel = view('backend.category.include.add-category')->render();
            return response()->json([ 'status' => 'success', 'output' => $categoryModel ]);
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
                    'type' => ['required'],
                    'name' => [ 'required', 'unique:categories,name,', 'string', 'max:50' ],
                    'status' => ['required'],
                    'video_url' => ['nullable', 'url', 'max:100'],
                    'description' => ['required'],
                    'seo_title' => 'nullable|max:100',
                    'meta_description' => 'nullable|max:255',
                    'meta_keywords' => 'nullable|max:100',
                ],
                [
                    'type.required' => 'The category type field is required.',
                    'name.required' => 'The category name field is required.',
                    'name.unique' => 'The category name already exist',
                    'seo_title.max' => 'The SEO title must not be greater than 100 characters.',
                    'meta_description.max' => 'The meta description must not be greater than 255 characters.',
                    'meta_keywords.max' => 'The meta keywords must not be greater than 100 characters.',
                ]
            );

            if ($validator->fails()) {
                return response()->json([ 'status' => 'error', 'error' => $validator->errors() ]);
            }

            $data = [
                'type' => $request->type,
                'name' => $request->name,
                'slug' => SlugService::createSlug(Category::class, 'slug', $request->name),
                'status' => $request->status,
                'video_url' => $request->video_url ?? null,
                'description' => $request->description,
            ];

            $categoryAdd = Category::create($data);
            if ($request['fileCount']) {
                for ($i = 0; $i < $request['fileCount']; $i++) {
                    $image = $i == 0 ? 'file' : 'file' . $i;
                    if ($request->hasFile($image) && $request->file($image)->isValid()) {
                        $newFileName = 'category-' . Str::random(20) . '.' . $request->file($image)->extension();
                        $categoryAdd->addMediaFromRequest($image)->usingFileName($newFileName)->toMediaCollection('category');                        
                    }
                }
            }

            /* ===== SEO ===== */
            $seoData = [
                'from' => 'Category',
                'from_id' => $categoryAdd->id,
                'title' => $request->seo_title ?? null,
                'description' => $request->meta_description ?? null,
                'meta_keywords' => $request->meta_keywords ?? null,
            ];
            $seoAnalysisData = SeoAnalysis::create($seoData);

            $categoryData = Category::orderBy('id', 'DESC')->paginate(config('app.paginate'));

            $categoryTable = view('backend.category.include.category-table', compact('categoryData'))->render();
            return response()->json([ 'status' => 'success', 'message' => 'Category added successfully!', 'output' => $categoryTable ]);
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
            $category = Category::with('seoAnalysis')->find($id);
            $categoryModel = view('backend.category.include.edit-category', compact('category'))->render();
            return response()->json([ 'status' => 'success', 'output' => $categoryModel ]);
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
                    'type' => ['required'],
                    'name' => ['required','unique:categories,name,' . $id,'string','max:50',],
                    'status' => ['required'],
                    'video_url' => ['nullable', 'url', 'max:100'],
                    'description' => ['required', 'max:500'],
                    'seo_title' => 'nullable|max:100',
                    'meta_description' => 'nullable|max:255',
                    'meta_keywords' => 'nullable|max:100',
                ],
                [
                    'type.required' => 'The category type field is required.',
                    'name.required' => 'The category name field is required.',
                    'name.unique' => 'The category name already exist',
                    'seo_title.max' => 'The SEO title must not be greater than 100 characters.',
                    'meta_description.max' => 'The meta description must not be greater than 255 characters.',
                    'meta_keywords.max' => 'The meta keywords must not be greater than 100 characters.',
                ]
            );
            if ($validator->fails()) {
                return response()->json([ 'status' => 'error', 'error' => $validator->errors() ]);
            }

            $data = [
                'type' => $request->type,
                'name' => $request->name,
                'status' => $request->status,
                'video_url' => $request->video_url ?? null,
                'description' => $request->description,
            ];

            $category = Category::find($id);
            if ($category) {
                $category->update($data);
                /* ===== SEO ===== */
                $seoData = [
                    'from' => 'Category',
                    'from_id' => $id,
                    'title' => $request->seo_title ?? null,
                    'description' => $request->meta_description ?? null,
                    'meta_keywords' => $request->meta_keywords ?? null,
                ];
                $SeoAnalysis = SeoAnalysis::where('from', 'Category')->where('from_id', $id)->first();
                if ($SeoAnalysis) {
                    $SeoAnalysis->update($seoData);
                }else{
                    SeoAnalysis::create($seoData);
                }
            }
            if ($request['fileCount']) {
                \DB::table('media')->where('model_id', $id)->delete();
                for ($i = 0; $i < $request['fileCount']; $i++) {
                    $image = $i == 0 ? 'file' : 'file' . $i;
                    if ($request->hasFile($image) && $request->file($image)->isValid()) {
                        $newFileName = 'category-' . Str::random(20) . '.' . $request->file($image)->extension();
                        $category->addMediaFromRequest($image)->usingFileName($newFileName)->toMediaCollection('category');
                    }
                }
            }

            $categoryData = Category::orderBy('id', 'DESC')->paginate( config('app.paginate') );
            $categoryTable = view('backend.category.include.category-table', compact('categoryData'))->render();
            return response()->json([ 'status' => 'success', 'message' => 'Category updated successfully!', 'output' => $categoryTable ]);
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
            $flag ='';
            $categoryData = Category::find($id);
            $categoryData->delete();
            $categoryData = Category::orderBy('id', 'DESC')->paginate(config('app.paginate'));
            $categoryTable = view('backend.category.include.category-table', compact('categoryData','flag')
            )->render();
            return response()->json([ 'status' => 'success', 'message' => 'Category deleted successfully!', 'output' => $categoryTable ]);
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
    public function categoryStatus($id){
        try {
            $status = Category::where('id', $id)->first()->status;
            $category['status'] = $status ? '0' : '1';
            $category['id'] = $id;
            Category::where('id', $id)->update([ 'status' => $category['status'] ]);
            $categoryStatus = view('backend.category.include.status', compact('category'))->render();
            return response()->json([ 'status' => 'success', 'message' => 'Status updated successfully!', 'output' => $categoryStatus ]);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }

    /* ===== REMOVE IMAGE ===== */
    public function destroyMedia($id){
        try {
            $media = \Spatie\MediaLibrary\MediaCollections\Models\Media::find($id);
            $media->delete();
            return response()->json([ 'status' => 'success', 'message' => 'Image removed successfully!' ]);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }
}