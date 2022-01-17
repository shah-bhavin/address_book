<?php

namespace App\Http\Controllers;

use App\Models\Mapping;
use App\Models\Disease;
use App\Models\Diet;
use App\Models\Treatment;

use Illuminate\Http\Request;
use App\Exports\MapExport;
use App\Imports\MapImport;
use Maatwebsite\Excel\Facades\Excel;

class MappingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
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
        // $treatment_ref = implode(',', $request->input('treatment_ref'));
        // $diet_ref = implode(',', $request->input('diet_ref'));

        // $request['diet_ref'] = $diet_ref;
        // $request['treatment_ref'] = $treatment_ref;
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

    public function view(Request $request){
        $disease = Mapping::where('disease_ref', 'LIKE',"%{$request['term']}%")->limit(3)->get();
        $diet = Mapping::where('diet_ref', 'LIKE',"%{$request['term']}%")->limit(3)->get();
        $treatment = Mapping::where('treatment_ref', 'LIKE',"%{$request['term']}%")->limit(3)->get();
        $skillData = array(); 
        if(count($disease) > 0){ 
            foreach(@$disease as $row){ 
                $data['value'] = $row->disease_ref;
                $data['id'] = $row->disease_ref.'_dr';
                array_push($skillData, $data);
            } 
        }
        if(count($diet) > 0){ 
            foreach(@$diet as $row){ 
                $rows = explode(', ', $row->diet_ref);
                foreach(@$rows as $row){
                    $data['value'] = $row;
                    $data['id'] = $row.'_dt';
                    array_push($skillData, $data);
                }
            } 
        }
        if(count($treatment) > 0){ 
            foreach(@$treatment as $row){ 
                $rows = explode(', ', $row->treatment_ref);
                foreach(@$rows as $row){
                    $data['value'] = $row;
                    $data['id'] = $row.'_tr';
                    array_push($skillData, $data);
                }
            } 
        }

        return array_map("unserialize", array_unique(array_map("serialize", $skillData)));
    }

    public function showData(Request $request){
        $diseases = Mapping::where('disease_ref', 'LIKE',"%{$request['term']}%")->limit(10)->get();
        $diets = Mapping::where('diet_ref', 'LIKE',"%{$request['term']}%")->limit(5)->get();
        $treatments = Mapping::where('treatment_ref', 'LIKE',"%{$request['term']}%")->limit(5)->get();
        
        $data = '<div class="row">';
        foreach($diseases as $disease){
            $data .= '<div class="panel col-md-6">';
            $data .= '<div class="panel-heading">Rx</div>';
            $data .= '<div class="panel-body">';
            $data .= '<div><b>Disease : </b>'.$disease['disease_ref'].'</div>';
            $data .= '<div><b>Diet : </b>'.$disease['diet_ref'].'</div>';
            $data .= '<div><b>Treatment : </b>'.$disease['treatment_ref'].'</div>';
            $data .= '</div>';
            $data .= '</div>';
        }
        foreach($diets as $diet){
            $data .= '<div class="panel col-md-6">';
            $data .= '<div class="panel-heading">Rx</div>';
            $data .= '<div class="panel-body">';
            $data .= '<div><b>Disease : </b>'.$diet['disease_ref'].'</div>';
            $data .= '<div><b>Diet : </b>'.$diet['diet_ref'].'</div>';
            $data .= '<div><b>Treatment : </b>'.$diet['treatment_ref'].'</div>';
            $data .= '</div>';
            $data .= '</div>';
        }
        foreach($treatments as $treatment){
            $data .= '<div class="panel col-md-6">';
            $data .= '<div class="panel-heading">Rx</div>';
            $data .= '<div class="panel-body">';
            $data .= '<div><b>Disease : </b>'.$treatment['disease_ref'].'</div>';
            $data .= '<div><b>Diet : </b>'.$treatment['diet_ref'].'</div>';
            $data .= '<div><b>Treatment : </b>'.$treatment['treatment_ref'].'</div>';
            $data .= '</div>';
            $data .= '</div>';
        }
        $data .= '</div>';
        return $data;
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mapping  $mapping
     * @return \Illuminate\Http\Response
     */
    public function edit(Mapping $mapping){
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
            'disease_ref' => 'required',
            'diet_ref' => 'required',
            'treatment_ref' => 'required',
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

    public function importExportView()
    {
       return view('mappings/import');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        return Excel::download(new MapExport, 'users.xlsx');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import() 
    {
        Excel::import(new MapImport, request()->file('file'));

        return back()->with('message', 'File Uploaded Successfully');;
    }
}
