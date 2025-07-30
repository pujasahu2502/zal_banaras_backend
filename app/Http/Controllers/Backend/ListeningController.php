<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Listing;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ListeningController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $listingData = Listing::with('category')->orderBy('id', 'DESC')->paginate(config('app.paginate'));
        return view('backend.listing.index', compact('listingData'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        try {
            $categories = Category::where('status', '1')->get();
            $listningModel = view('backend.listing.include.add-listning', compact('categories'))->render();
            return response()->json(['status' => 'success', 'output' => $listningModel, ]);
        }
        catch(\Exception $ex) {
            \Log::error($ex);
            return response()->json(['status' => 'error', 'message' => $ex->getMessage(), ]);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // validated request
        $validator = Validator::make($request->all(), ['name' => ['required', 'string', 'max:255', 'unique:listings,name'], 'category_id' => 'required', 'url' => 'required', 'listening_status' => 'required', 'price' => 'required', 'status' => 'required', 'description' => 'required', 'file' => 'required', ]);
        // if any error return back request with input errors
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'error' => $validator->errors(), ]);
        }
        $listing = ['name' => $request['name'], 'url' => $request['url'],'slug' => Str::slug($request['name']), 'category_id' => $request['category_id'], 'listening_status' => $request['listening_status'], 'price' => $request['price'], 'status' => $request['status'], 'description' => $request['description'], ];
        $listing = Listing::create($listing);
        if ($request['fileCount']) {
            for ($i = 0;$i < $request['fileCount'];$i++) {
                $image = $i == 0 ? 'file' : 'file' . $i;
                if ($request->hasFile($image) && $request->file($image)->isValid()) {
                    $newFileName = 'land-' . todayDate() . '.' . $request->file($image)->extension();
                    $listing->addMediaFromRequest($image)->usingFileName($newFileName)->toMediaCollection('listening');
                }
            }
        }
        $listingData = Listing::with('category')->orderBy('id', 'DESC')->paginate(config('app.paginate'));
        $ListingTable = view('backend.listing.include.listing-table', compact('listingData'))->render();
        return response()->json(['status' => 'success', 'message' => 'Listing Added Successfully !', 'output' => $ListingTable, ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $listingData = Listing::find($id);
        $categories = Category::where('status', '1')->get();
        $listingModel = view('backend.listing.include.edit-listning', compact('listingData', 'categories'))->render();
        return response()->json(['status' => 'success', 'output' => $listingModel, ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        // validated request
        $validator = Validator::make($request->all(), ['name' => ['required', 'unique:listings,name,' . $id, 'string', 'max:255'], 'url' => 'required','category_id' => 'required', 'listening_status' => 'required', 'price' => 'required', 'status' => 'required', 'description' => 'required', ]);
        // if any error return back request with input errors
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'error' => $validator->errors(), ]);
        }
        $listingData = ['name' => $request['name'],'url' => $request['url'], 'slug' => Str::slug($request['name']), 'category_id' => $request['category_id'], 'listening_status' => $request['listening_status'], 'price' => $request['price'], 'status' => $request['status'], 'description' => $request['description'], ];
        $listing = Listing::find($id);
        $listing->update($listingData);
        if ($request['fileCount']) {
            for ($i = 0;$i < $request['fileCount'];$i++) {
                $image = $i == 0 ? 'file' : 'file' . $i;
                if ($request->hasFile($image) && $request->file($image)->isValid()) {
                    $newFileName = 'land-' . todayDate() . '.' . $request->file($image)->extension();
                    $listing->addMediaFromRequest($image)->usingFileName($newFileName)->toMediaCollection('listening');
                }
            }
        }
        $listingData = Listing::with('category')->orderBy('id', 'DESC')->paginate(config('app.paginate'));
        $ListingTable = view('backend.listing.include.listing-table', compact('listingData'))->render();
        return response()->json(['status' => 'success', 'message' => 'Listing Added Successfully !', 'output' => $ListingTable, ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            $listing = Listing::find($id);
            $listing->delete();
            $listingData = Listing::with('category')->orderBy('id', 'DESC')->paginate(config('app.paginate'));
            $ListingTable = view('backend.listing.include.listing-table', compact('listingData'))->render();
            return response()->json(['status' => 'success','message' => 'Listing deleted successfully !','output' => $ListingTable,]);
          } catch (Exception $ex) {
            \Log::error($ex); 
            return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
      
          }
        
    }

      /**
   * Status of the  specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function listingStatus($id)
  {
    try {
      $status = Listing::where('id', $id)->first()->status;
      $listing['status'] = $status ? '0' : '1';
      $listing['id'] = $id;
      Listing::where('id', $id)->update(['status' => $listing['status'],]);
      $listingStatus = view('backend.listing.include.status',compact('listing'))->render();
      return response()->json(['status' => 'success','message' => 'Status Updated successfully !','output' => $listingStatus,]);
    } catch (Exception $ex) {
      \Log::error($ex); 
      return response()->json(['status' => 'error','message' => $ex->getMessage(),]);
    }
  }
}
