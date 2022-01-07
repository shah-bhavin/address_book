<?php

namespace App\Http\Controllers;

use App\Models\Diet;
use Illuminate\Http\Request;

class DietController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $diets = Diet::all();
    
        return view('diets.index',compact('diets'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('diets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $request->validate([
            'diet_name' => 'required',
            'short_code' => 'required',
        ]);
        Diet::create($request->all());
     
        return redirect()->route('diets.index')
                        ->with('success','Diet created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Diet  $diet
     * @return \Illuminate\Http\Response
     */
    public function show(Diet $diet){
        return view('diets.show',compact('diet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Diet  $diet
     * @return \Illuminate\Http\Response
     */
    public function edit(Diet $diet){
        // echo '<pre>';print_r($diet);echo '</pre>';
        return view('diets.create', compact('diet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Diet  $diet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diet $diet){
        $request->validate([
            'diet_name' => 'required',
            'short_code' => 'required',
        ]);
    
        $diet->update($request->all());
    
        return redirect()->route('diets.index')
                        ->with('success','Diet updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Diet  $diet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diet $diet){
        $diet->delete();
    
        return redirect()->route('diets.index')
                        ->with('success','Diet deleted successfully');
    }
}
