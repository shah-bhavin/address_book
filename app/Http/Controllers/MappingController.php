<?php

namespace App\Http\Controllers;

use App\Models\Mapping;
use Illuminate\Http\Request;

class MappingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        // $mappings = Mapping::join('diseases', 'diseases.id', 'mappings.disease_ref')
        // ->join('diets', 'diets.id', 'mappings.diet_ref')
        // ->whereIn('diets.id', 'mappings.diet_ref')
        // ->get(['mappings.*', 'diseases.disease_name']);
        $mappings = Mapping::all();

         return view('mappings.index', compact('mappings'))
             ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('mappings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $treatment_ref = implode(',', $request->input('treatment_ref'));
        $diet_ref = implode(',', $request->input('diet_ref'));

        $request['diet_ref'] = $diet_ref;
        $request['treatment_ref'] = $treatment_ref;
        $request->validate([
            'disease_ref' => 'required',
            'diet_ref' => 'required',
            'treatment_ref' => 'required',
        ]);
        Mapping::create($request->all());
     
        return redirect()->route('mappings.index')
                        ->with('success','Mapping created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mapping  $mapping
     * @return \Illuminate\Http\Response
     */
    public function show(Mapping $mapping){
        return view('mappings.show',compact('mapping'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mapping  $mapping
     * @return \Illuminate\Http\Response
     */
    public function edit(Mapping $mapping){
        // echo '<pre>';print_r($mapping);echo '</pre>';
        return view('mappings.create', compact('mapping'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mapping  $mapping
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mapping $mapping){
        $request->validate([
            'mapping_name' => 'required',
            'short_code' => 'required',
        ]);
    
        $mapping->update($request->all());
    
        return redirect()->route('mappings.index')
                        ->with('success','Mapping updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mapping  $mapping
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mapping $mapping){
        $mapping->delete();
    
        return redirect()->route('mappings.index')
                        ->with('success','Mapping deleted successfully');
    }
}
