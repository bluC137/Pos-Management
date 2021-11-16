<?php

namespace App\Http\Controllers;

use App\rc;
use Illuminate\Http\Request;
use App\Product;
use App\User;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $user = Auth::user();
        $users =  User::paginate(5);
        $products = Product::all();
        if($user->is_admin==1){
        return view('users.index', ['users' => $users,'products' => $products]);
    }else{
        return redirect(route('cashier-content'));
    }
     
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->password = 
       $users = new User;
                $users->name = $request->name;
                $users->email = $request->email;
                $users->password = md5($request->password);
                $users->is_admin = $request->is_admin;
                $users->save();
       
       if ($users) {
          return redirect()->back()->with('User Created Successfully');
       }
          return redirect()->back()->with('Failed to Create User');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\rc  $rc
     * @return \Illuminate\Http\Response
     */
    public function show(rc $rc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\rc  $rc
     * @return \Illuminate\Http\Response
     */
    public function edit(rc $rc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\rc  $rc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $users = User::find($id);
        if (!$users) {
            return back()->with('Error', 'User not Found');
        }
        $users->update($request->all());
        return back()->with('Success', 'User Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\rc  $rc
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = User::find($id);
        if (!$users) {
            return back()->with('Error', 'User not Found');
        }
        $users->delete();
        return back()->with('Success', 'User Deleted Successfully!');
    }
}
