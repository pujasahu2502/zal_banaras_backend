<?php

namespace App\Http\Controllers\Backend;

use DB;
use Exception;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Dealer, DealerAddress};
use App\Http\Requests\{DealerStoreRequest, DealerUpdateRequest};

class DealerController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        try {
            $flag = '';
            $dealer = Dealer::with('address');
            if (isset($request->search) && (!empty($request->search))) {
                $flag = 1;
                $search = $request->search;
                $dealer = $dealer
                ->where('title', 'like', '%' . $search . '%');
            }
            /* === DEALER  STATUS === */
              if($request->ss != null){
                $flag = 1;
                if($request->ss == '1'){
                    $dealer = $dealer->where('status', $request->ss);
                }elseif($request->ss == '0'){
                    $dealer = $dealer->where('status', $request->ss);
                }else{

                }
            }
            $dealerData = $dealer->orderBy('id', 'DESC')->paginate(config('app.paginate'))->appends(request()->query());
            return view('backend.dealer.index', compact('dealerData','flag'));
        } catch (Exception $ex) {
            \Log::error($ex);
            return abort(500);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexOld(Request $request){
        try {
            $cities = DealerAddress::select('city')->distinct()->get();
            $states = DealerAddress::select('state')->distinct()->get();
            return view('backend.dealer.index',compact('cities','states'));
          } catch (Exception $ex) {
            \Log::error($ex);
            return abort(500);
          }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $output = view("backend.dealer.create")->render();
        return response()->json(['status' => 'success', 'output' => $output]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DealerStoreRequest $request){
        $dealerData = ['title' => $request->title, 'email' => $request->email, 'phone' => $request->phone, 'status' => $request->status, 'website_url' => $request->website_url ];
        // store dealer data
        $dealer = Dealer::create($dealerData);

        // store dealer image
        if ($request['fileCount']) {
            for ($i = 0; $i < $request['fileCount']; $i++) {
                $image = $i == 0 ? 'file' : 'file' . $i;
                if ($request->hasFile($image) && $request->file($image)->isValid()) {
                    $newFileName = 'dealer-' . Str::random(20) . '.' . $request->file($image)->extension();
                    $dealer->addMediaFromRequest($image)->usingFileName($newFileName)->toMediaCollection('dealer');                        
                }
            }
        }

        // store dealer address with dealer id
        $dealerAddress = ['address' => $request->address, 'city' => $request->city, 'state' => $request->state, 'country' => $request->country, 'zip' => $request->zipcode, 'latitude' => $request->latitude, 'longitude' => $request->longitude];

        $dealer->address()->create($dealerAddress);

        // getting all dealer data with address
        $dealerData = Dealer::with('address')->orderBy('id','desc')->paginate(10);
        $output = view("backend.dealer.index", compact('dealerData'))->render();

        $dealerTable = view('backend.dealer.include.dealer-table', compact('dealerData'))->render();
        return response()->json([ 'status' => 'success', 'message' => 'Dealer added successfully!', 'output' => $dealerTable ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        try {
            $dealer = Dealer::with('address')->find($id);
            $dealerModel = view('backend.dealer.include.edit-dealer', compact('dealer'))->render();
            return response()->json([ 'status' => 'success', 'output' => $dealerModel ]);
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
    public function update(DealerUpdateRequest $request, $id){
        $dealerData = ['title' => $request->title, 'email' => $request->email, 'phone' => $request->phone, 'status' => $request->status, 'website_url' => $request->website_url];

        // update dealer data
        $dealer = Dealer::find($id);

        if (!empty($dealer)) {
            $dealer->update($dealerData);
        }

        // update dealer image
        if ($request['fileCount']) {
            \DB::table('media')->where('model_id', $id)->delete();
            for ($i = 0; $i < $request['fileCount']; $i++) {
                $image = $i == 0 ? 'file' : 'file' . $i;
                if ($request->hasFile($image) && $request->file($image)->isValid()) {
                    $newFileName = 'dealer-' . Str::random(20) . '.' . $request->file($image)->extension();
                    $dealer->addMediaFromRequest($image)->usingFileName($newFileName)->toMediaCollection('dealer');
                }
            }
        }

        // update dealer address with dealer id
        $dealerAddress = ['address' => $request->address, 'city' => $request->city, 'state' => $request->state, 'country' => $request->country, 'zip' => $request->zipcode, 'latitude' => $request->latitude, 'longitude' => $request->longitude, 'dealer_id' => $dealer->id];

        $dealer->address->update($dealerAddress);

        $dealerData = Dealer::with('address')->orderBy('id','desc')->paginate(10);
        $dealerTable = view('backend.dealer.include.dealer-table', compact('dealerData'))->render();
        return response()->json([ 'status' => 'success', 'message' => 'Dealer updated successfully!', 'output' => $dealerTable ]);
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
            $dealer =  Dealer::find($id)->delete();
            DealerAddress::where('dealer_id', $id)->delete();
            $dealerData = Dealer::with('address')->orderBy('id','desc')->paginate(10);
            $dealerTable = view('backend.dealer.include.dealer-table', compact('dealerData','flag')
            )->render();
            return response()->json([ 'status' => 'success', 'message' => 'Dealer deleted successfully!', 'output' => $dealerTable ]);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }

    public function getDealers(Request $request){
        try {
            if($request->ajax()){
                $dealers=Dealer::join('dealer_address', 'dealer.id', '=', 'dealer_address.dealer_id');

                if($request->has('city') && !empty(($request->city))){
                    $dealers=$dealers->where('city',$request->city);
                }
                if($request->has('state') && !empty(($request->state))){
                    $dealers=$dealers->where('state',$request->state);
                }
                if($request->has('search') && !empty(($request->search))){
                    $dealers=$dealers->where('title','like','%'.$request->search.'%');
                }
                $dealers=$dealers->get();
                $locations = [];
                if(!$dealers->isEmpty()){
                    foreach($dealers as $key => $val){
                        $data = [
                            "name" => $val->title, 
                            "latitude" => $val->latitude, 
                            "longitude" => $val->longitude];
                        array_push($locations,$data);
                    }
                }
                return response()->json([
                    'status' => true,
                    'message' => 'Dealers fetched successfully.',
                    'data' => $locations
                ],200);
            }
            return abort(403);
          } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => false, 'message' => 'Something went wrong.' ],500);
        }
    }

    /**
     * delete dealer image from media
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
    * Update status of the  specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function dealerStatus($id){
        try {
            $status = Dealer::where('id', $id)->first()->status;
            $dealer['status'] = $status ? '0' : '1';
            $dealer['id'] = $id;
            Dealer::where('id', $id)->update([ 'status' => $dealer['status']]);
            $dealerStatus = view('backend.dealer.include.status', compact('dealer'))->render();
            return response()->json([ 'status' => 'success', 'message' => 'Status updated successfully!', 'output' => $dealerStatus ]);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }
}