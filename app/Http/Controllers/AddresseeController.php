<?php

namespace App\Http\Controllers;

use App\Models\Addressee;
use Illuminate\Http\Request;

class AddresseeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $addressees = Addressee::latest()->paginate(5);
    
         return view('addressees.index',compact('addressees'))
             ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('addressees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'birth_date' => 'required',
            'phone1' => 'required',
            'whatsapp_no' => 'required',
            'email' => 'required',
            'b_no' => 'required',
            'street' => 'required',
            'state' => 'required',
            'country' => 'required',       
        ]);
    
        Addressee::create($request->all());
     
        return redirect()->route('addressees.index')
                        ->with('success','addressee created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Addressee  $addressee
     * @return \Illuminate\Http\Response
     */
    public function show(Addressee $addressee){
        return view('addressees.show',compact('addressee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Addressee  $addressee
     * @return \Illuminate\Http\Response
     */
    public function edit(Addressee $addressee){
        return view('addressees.edit',compact('addressee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Addressee  $addressee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Addressee $addressee){
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
    
        $addressee->update($request->all());
    
        return redirect()->route('addressees.index')
                        ->with('success','Addressee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Addressee  $addressee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Addressee $addressee){
        $addressee->delete();
    
        return redirect()->route('addressees.index')
                        ->with('success','Addressee deleted successfully');
    }
}
