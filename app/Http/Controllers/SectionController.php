<?php

namespace App\Http\Controllers;

use App\Section;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class SectionController extends Controller
{
   
    public function index()
    {
        $user = Auth::user();
        $products = Product::all();
        if($user->is_admin==1){
            return view('sections.index',['products' => $products]);
        }else{
            return redirect(route('cashier-content'));
        }
    }

  
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }


    public function show(Section $section)
    {
        //
    }

 
    public function edit(Section $section)
    {
        //
    }

 
    public function update(Request $request, Section $section)
    {
        //
    }

  
    public function destroy(Section $section)
    {
        //
    }
}
