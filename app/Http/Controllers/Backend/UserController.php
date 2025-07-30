<?php

namespace App\Http\Controllers\Backend;

use Log;
use Auth;
use Hash;
use Exception;
use Illuminate\Http\Request;
use App\Models\{User, Address};
use App\Jobs\{AdminCustomerRegJob};
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller{
    /**
     * 
     *initialized constructor for permission's.
     * 
     */
    public function __construct(){
        $this->middleware('permission:list-user', ['only' => ['index']]);
        $this->middleware('permission:show-user', ['only' => ['show']]);
        $this->middleware('permission:create-user', ['only' => ['create']]);
        $this->middleware('permission:store-user', ['only' => ['store']]);
        $this->middleware('permission:edit-user', ['only' => ['edit']]);
        $this->middleware('permission:update-user', ['only' => ['update']]);
        $this->middleware('permission:status-user', ['only' => ['userStatus']]);
        $this->middleware('permission:delete-user', ['only' => ['destroy']]);
        $this->middleware('permission:user-proxy',  ['only'=>['proxyLogin']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function index(Request $request){
        try{
           $flag = '';
           $users = User::with('address')->role('user');
            
            /* === FILTER CUSTOMER STATUS === */
            if($request->cs != null){
                $flag = 1;
                if($request->cs == '1'){
                    $users = $users->where('status', $request->cs);
                }elseif($request->cs == '0'){
                    $users = $users->where('status', $request->cs);
                }
            }
            
            /* === FILTER SHORT BY=== */
            if($request->sort != null){
                $flag = 1 ;
                $sortBy = $request->sort; 
                if($sortBy == '1'){
                    $users = $users->oldest();
                }elseif($sortBy == '2'){
                    $users = $users->latest();
                }elseif($sortBy == '3'){
                    $users = $users->orderBy('display_name','ASC');
                }elseif($sortBy == '4'){
                    $users = $users->orderBy('display_name','DESC');
                }
            }
            /* === SEARCH CUSTOMER NAME, USERNAME, EMAIL === */
            if($request->search && $request->search != null){
                $flag = 1;
                if(strpos($request->search,'@') > 0) {
                    $users = $users->where('email', 'like', '%' . $request->search . '%');
                }elseif(is_numeric($request->search)) {
                    $users = $users->where('mobile', 'like', '%' . $request->search . '%');
                }elseif(strpos($request->search,'@') == 0) {
                    $users = $users->where('username', 'like', '%' . $request->search . '%');
                }
            }
            $userData = $users->orderBy('id', 'DESC')->paginate(config('app.paginate'))->appends(request()->query());
            return view('backend.user.index',compact('userData','flag'));
        }catch(\Exception $ex){
            \Log::error($ex);
            return response()->json([ 'status' => 'error','message' => $ex->getMessage(),]);
        }
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create(){
        try {
            $userModel = view('backend.user.include.add-user')->render();
            return response()->json([ 'status' => 'success', 'output' => $userModel ]);
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
                    'first_name' => [ 'required', 'string', 'alpha', 'max:40' ],
                    'last_name' => [ 'required', 'string', 'alpha', 'max:40' ],
                    'username' => [ 'nullable', 'string', 'alpha', 'max:100' ],
                    'email' => [ 'required', 'string', 'email:rfc,dns', 'max:40', 'unique:users' ],
                    'mobile' => [ 'required', 'numeric' ],
                    'status' => ['required'],
                ],
                [
                    'mobile.required' => 'The mobile number field is required.',
                ]
            );

            if ($validator->fails()) {
                return response()->json([ 'status'=>'error', 'error'=>$validator->errors() ]);
            }

            $data = [
                'first_name' => trim($request->first_name),
                'last_name' => trim($request->last_name),
                'display_name' => $request->username ? trim($request->username) : trim($request->first_name).''.trim($request->last_name),
                'email' => $request->email,
                'password' => Hash::make('=h+hX%U7+8EJR+xB') ?? null,
                'mobile' => $request->mobile,
                'status' => $request->status,
                'type' => "customer",
            ];

            $userAdd = User::create($data);
            $userAdd->assignRole('user');
            $userAdd->refresh();
            /* === Send Mail to Reg === */
            $data['real_password'] = '=h+hX%U7+8EJR+xB';
            AdminCustomerRegJob::dispatch($data);

            $userData = User::orderBy('id', 'DESC')->paginate( config('app.paginate') );
            $userTable = view('backend.user.include.user-table', compact('userData'))->render();
            return response()->json([ 'status' => 'success', 'message' => 'Customer added successfully!', 'output' => $userTable, 'userId' => $userAdd->id ]);
        } catch (\Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        try{
            $userData = User::with('address')->find($id);   
            $profileModal = view('backend.user.include.view-profile-modal',compact('userData'))->render();
            return response()->json([ 'status' => 'success', 'output' => $profileModal ]);
        }catch(\Exception $ex){
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
            $user = User::find($id);
            $states = getUsState(); // From Helper
            $userModel = view('backend.user.include.edit-user', compact('user', 'states'))->render();
            return response()->json([ 'status' => 'success', 'output' => $userModel ]);
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
                    'first_name' => [ 'required', 'string', 'alpha', 'max:40' ],
                    'last_name' => [ 'required', 'string', 'alpha', 'max:40' ],
                    'username' => [ 'nullable', 'string', 'alpha', 'max:100' ],
                    'email' => [ 'required', 'string', 'email:rfc,dns', 'max:40', 'unique:users,email,'.$id ],
                    'mobile' => [ 'required', 'numeric' ],
                    'status' => ['required'],
                ],
                [
                    'mobile.required' => 'The mobile number field is required.',
                ]
            );

            if ($validator->fails()) {
                return response()->json([ 'status' => 'error', 'error' => $validator->errors() ]);
            }

            $data = [
                'first_name' => trim($request->first_name),
                'last_name' => trim($request->last_name),
                'display_name' => $request->username ? trim($request->username) : trim($request->first_name).''.trim($request->last_name),
                'email' => $request->email,
                'mobile' => $request->mobile,
                'status' => $request->status,
            ];

            $user = User::find($id);
            if ($user) {
                $user->update($data);
            }

            $userData = User::orderBy('id', 'DESC')->paginate( config('app.paginate') );
            $userTable = view('backend.user.include.user-table', compact('userData'))->render();
            return response()->json([ 'status' => 'success', 'message' => 'Customer updated successfully!', 'output' => $userTable ]);
        } catch (\Exception $ex) {
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
    public function userStatus($id){
        try {
            $status = User::where('id', $id)->first()->status;
            $user['status'] = $status ? '0' : '1';
            $user['id'] = $id;
            User::where('id', $id)->update([ 'status' => $user['status'] ]);

            $userStatus = view('backend.user.include.status', compact('user'))->render();
            return response()->json([ 'status' => 'success', 'message' => 'Status updated successfully!', 'output' => $userStatus ]);
        } catch (Exception $ex) {
            \Log::error($ex);
            return response()->json([ 'status' => 'error', 'message' => $ex->getMessage() ]);
        }
    }

    /* ===== Proxy Login ===== */
    public function proxyLogin($id){
        if(Auth::guard('web')->check()){
            Auth::guard('web')->logout();
        }
        Auth::guard('web')->loginUsingId($id);
        return redirect()->route('orders.index');
    }
}