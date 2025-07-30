<?php

namespace App\Http\Controllers\Backend;

use DB;
use Log;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\{Blog, SeoAnalysis};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        try {
            $flag = '';
            $blogData = Blog::latest();
            /* === SEARCH BLOG TITLE === */
            if($request->search && $request->search != null){
                $flag = 1;
                $blogData = $blogData
                    ->where('title', 'like', '%' . $request->search . '%');
            }
            /* === FILTER BLOG STATUS === */
            if($request->ss != null){
                $flag = 1;
                if($request->ss == '1'){
                    $blogData = $blogData->where('status', $request->ss);
                }elseif($request->ss == '0'){
                    $blogData = $blogData->where('status', $request->ss);
                }else{

                }
            }
            $blogData = $blogData->orderBy('id', 'DESC')->paginate(config('app.paginate'))->appends(request()->query());
            return view('backend.blog.index', compact('blogData','flag'));
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
            $blogModal = view('backend.blog.include.add-blog')->render();
            return response()->json([ 'status' => 'success', 'output' => $blogModal ]);
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
        $validator = Validator::make(
            $request->all(),
            [
                'title' => ['required', 'string', 'max:255'],
                'description' => ['nullable', 'max:20000'],
                'status' => 'required',
                'seo_title' => ['nullable', 'max:100'],
                'meta_description' => ['nullable', 'max:255'],
                'meta_keywords' => ['nullable', 'max:100'],
            ],
            [
                'title.required' => 'The blog title field is required.',
                'seo_title.max' => 'The SEO title must not be greater than 100 characters.',
                'meta_description.max' => 'The meta description must not be greater than 255 characters.',
                'meta_keywords.max' => 'The meta keywords must not be greater than 100 characters.',
            ]
        );

        if ($validator->fails()) {
            return response()->json([ 'status' => 'error', 'error' => $validator->errors() ]);
        }

        $blog = [
            'title' => $request['title'],
            'slug' => Blog::generateSlug($request['title']),
            'status' => $request['status'],
            'description' => $request['description'],
        ];

        $blog = Blog::create($blog);
        if ($request['fileCount']) {
            for ($i = 0; $i < $request['fileCount']; $i++) {
                $image = $i == 0 ? 'file' : 'file' . $i;
                if ($request->hasFile($image) && $request->file($image)->isValid()) {
                    $newFileName = 'blog-' . Str::random(20) . '.' . $request->file($image)->extension();
                    $blog->addMediaFromRequest($image)->toMediaCollection('blog');
                }
            }
        }

        /* ===== SEO ===== */
        $seoData = [
            'from' => 'Blog',
            'from_id' => $blog->id,
            'title' => $request['seo_title'],
            'description' => $request['meta_description'],
            'meta_keywords' => $request->meta_keywords,
        ];
        $seoAnalysisData = SeoAnalysis::create($seoData);

        $blogData = Blog::orderBy('id', 'DESC')->paginate(config('app.paginate'));
        $BlogTable = view('backend.blog.include.blog-table', compact('blogData'))->render();
        return response()->json([ 'status' => 'success', 'message' => 'Blog added successfully!', 'output' => $BlogTable ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $blogData = Blog::with('seoAnalysis')->find($id);
        $BlogModel = view('backend.blog.include.edit-blog', compact('blogData'))->render();
        return response()->json([ 'status' => 'success', 'output' => $BlogModel ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $validator = Validator::make(
            $request->all(),
            [
                'title' => ['required', 'string', 'max:255'],
                'description' => ['nullable', 'max:20000'],
                'status' => 'required',
                'seo_title' => ['nullable', 'max:100'],
                'meta_description' => ['nullable', 'max:255'],
                'meta_keywords' => ['nullable', 'max:100'],
            ],
            [
                'title.required' => 'The blog title field is required.',
                'seo_title.max' => 'The SEO title must not be greater than 100 characters.',
                'meta_description.max' => 'The meta description must not be greater than 255 characters.',
                'meta_keywords.max' => 'The meta keywords must not be greater than 100 characters.',
            ]
        );

        if ($validator->fails()) {
            return response()->json([ 'status' => 'error', 'error' => $validator->errors() ]);
        }

        $blogData = [
            'title' => $request['title'],
            'slug' => Blog::generateSlug($request['title']),
            'status' => $request['status'],
            'description' => $request['description'],
        ];

        $blog = Blog::find($id);
        if ($blog) {
            $blog->update($blogData);

            /* ===== SEO ===== */
            $seoData = [
                'from' => 'Blog',
                'from_id' => $id,
                'title' => $request['seo_title'],
                'description' => $request['meta_description'],
                'meta_keywords' => $request->meta_keywords,
            ];
            $seoAnalysisData = SeoAnalysis::where('from', 'Blog')->where('from_id', $id)->update($seoData);
        }
        if ($request['fileCount']) {
            \DB::table('media')->where('model_id', $id)->delete();
            for ($i = 0; $i < $request['fileCount']; $i++) {
                $image = $i == 0 ? 'file' : 'file' . $i;
                if ($request->hasFile($image) && $request->file($image)->isValid()) {
                    $newFileName = 'blog-' . Str::random(20) . '.' . $request->file($image)->extension();
                    $blog->addMediaFromRequest($image)->toMediaCollection('blog');
                }
            }
        }

        $blogData = Blog::orderBy('id', 'DESC')->paginate(config('app.paginate'));
        $BlogTable = view('backend.blog.include.blog-table', compact('blogData'))->render();
        return response()->json([ 'status' => 'success', 'message' => 'Blog updated successfully!', 'output' => $BlogTable ]);
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
            $blog = Blog::find($id);
            $blog->delete();
            $blogData = Blog::orderBy('id', 'DESC')->paginate(config('app.paginate'));
            $blogTable = view('backend.blog.include.blog-table', compact('blogData', 'flag'))->render();
            return response()->json(['status' => 'success','message' => 'Blog deleted successfully!', 'output' => $blogTable ]);
        } catch (Exception $ex) {
            \Log::error($ex); 
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }

    /* ===== REMOVE INAGE ===== */
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

    /**
    * Status of the  specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function blogStatus($id){
        try {
            $status = Blog::where('id', $id)->first()->status;
            $blog['status'] = $status ? '0' : '1';
            $blog['id'] = $id;
            Blog::where('id', $id)->update([ 'status' => $blog['status'] ]);
            $blogStatus = view('backend.blog.include.status', compact('blog'))->render();
            return response()->json([ 'status' => 'success', 'message' => 'Status updated successfully', 'output' => $blogStatus ]);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }
}