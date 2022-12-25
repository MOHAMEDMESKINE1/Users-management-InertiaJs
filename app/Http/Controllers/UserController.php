<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
       
         $this->authorize('viewAny',User::class);

        // pass all data to the front end 
        //  $users = User::all();

        // through help us to specify data that we want to send 
       
       
        // $filters=Request::only(['search']);
        $filters=request()->only(['search']);

        $users = User::query()->when(request()->input('search'),function($query,$search){
            
            $query->where('name','like','%'.$search.'%');

        })->orderby('name','desc')->paginate(5)->through(fn($user)=>[
            "id"=>$user->id,
            "name"=>$user->name,
            "email"=>$user->email,
            "created_at"=>$user->created_at->format('d-m-Y'),
            // "created_at"=>$user->created_at->diffForHumans(),
        ]);

        return inertia('Users/Index',compact(['users','filters']));
    }

    public function edit($id){
        
        // $user = User::where('id',$id)->first();
        $user=User::find($id);

        return inertia('Users/Edit',compact('user'));

    }
   
    public function store(StoreUserRequest $request){
       
        $this->authorize('create',User::class);
    
         User::create($request->validated());

        return redirect()->route('users.index')->with('message','User created succefully ');
    }
    public function update(Request $request,$id){
        
        // $user->update($request->validated());
            //  $user = User::find($id);

            // $user->name     = $request->input('name');
            // $user->email    = $request->input('email');
            // // $user->password = $request->input('password');

            // $user->save();
           
            $request->validate([
                "name"=>"required",
                "email"=>"required"
            ]);

            $user = User::find($id);         
            $user->update([
                    "name"=>$request->name,
                    "email"=>$request->email
            ]);

        return redirect()->route('users.index')->with('message','User updated succefully');
    }
    public function destroy($id){

        $user= User::find($id);
        
        $user->delete();

        return redirect()->route('users.index')->with('message','User deleted succefully');
    }
  
}
