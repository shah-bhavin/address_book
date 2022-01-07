<?php

namespace App\Http\Controllers;

use App\Models\Disease;
use Illuminate\Http\Request;

class DiseaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //$diseases = Disease::latest()->paginate(5);
        $diseases = Disease::all();
    
        return view('diseases.index',compact('diseases'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('diseases.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $request->validate([
            'disease_name' => 'required',
        ]);
    
        Disease::create($request->all());
     
        return redirect()->route('diseases.index')
                        ->with('success','Disease created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function show(Disease $disease){
        return view('diseases.show',compact('disease'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function edit(Disease $disease){
        // echo '<pre>';print_r($disease);echo '</pre>';
        return view('diseases.create', compact('disease'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Disease $disease){
        $request->validate([
            'disease_name' => 'required',
        ]);
    
        $disease->update($request->all());
    
        return redirect()->route('diseases.index')
                        ->with('success','Disease updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Disease  $disease
     * @return \Illuminate\Http\Response
     */
    public function destroy(Disease $disease){
        $disease->delete();
    
        return redirect()->route('diseases.index')
                        ->with('success','Disease deleted successfully');
    }
}
