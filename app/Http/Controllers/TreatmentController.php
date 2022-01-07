<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $treatments = Treatment::all();
    
        return view('treatments.index',compact('treatments'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('treatments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $request->validate([
            'treatment_name' => 'required',
            'short_code' => 'required',
        ]);
        Treatment::create($request->all());
     
        return redirect()->route('treatments.index')
                        ->with('success','Treatment created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function show(Treatment $treatment){
        return view('treatments.show',compact('treatment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function edit(Treatment $treatment){
        // echo '<pre>';print_r($treatment);echo '</pre>';
        return view('treatments.create', compact('treatment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Treatment $treatment){
        $request->validate([
            'treatment_name' => 'required',
            'short_code' => 'required',
        ]);
    
        $treatment->update($request->all());
    
        return redirect()->route('treatments.index')
                        ->with('success','Treatment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Treatment $treatment){
        $treatment->delete();
    
        return redirect()->route('treatments.index')
                        ->with('success','Treatment deleted successfully');
    }
}
