<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\notes_service ;
use App\Mission ;
use App\recommandation;
use Validator;


class RecController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { $notes_services = notes_service::all()->toArray();
        $recommandations = recommandation::all()->toArray();
        return view('recommandation.index', compact('$recommandations'));
        
        // $missions = mission::find($id);
        //return view('mission.edit', compact('missions', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // $missions = Mission::all()->toArray();
        
        return view('recommandation.rec',compact('recommandations'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
{ $i=$request->input('note');
  
  
        $date_prevue=request('dp');
        $txt_reco=request('rec');
        $txt_plan_action=request('pa');
        $txt_constatation=request('con');
        $niveau_criticité=request('cr');

               

            
            for($count = 0; $count < count($date_prevue); $count++){
            $rec=new recommandation();
            $rec->date_prevue=$date_prevue[$count];
            $rec->txt_reco=$txt_reco[$count];
            $rec->txt_plan_action=$txt_plan_action[$count];
            $rec->txt_constatation= $txt_constatation[$count];
            $rec->niveau_criticité=$niveau_criticité[$count];
            $rec->notes_service()->associate($i);
            $rec->save();
            }

            
            return redirect()->route('recommandation.index')->with('success', 'recommandation ajouté');
        

    }


    
  
    
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   $notes_services = notes_service::find($id);
       
        $recommandations = recommandation::find($id);
        return view('recommandation.edit', compact('recommandations', 'id'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $rec=recommandation::where('ID_reco', '=', $id)->firstOrFail(); 
 
        $i=$request->input('note');
        $rec->date_prevue=request('dp');
        $rec->txt_reco=request('rec');
        $rec->txt_plan_action=request('pa');
        $rec->txt_constatation=request('con');
        $rec->niveau_criticité=request('cr');
        $rec->notes_service()->associate($i);
            $rec->save();
    
        return redirect()->route('recommandation.index')->with('success', 'recommandation modifié');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
         $rec = recommandation::where('ID_reco', '=', $id)->firstOrFail();
      
        $rec->delete();
        
        return redirect()->route('recommandation.index')->with('success', 'recommandation supprimé');
        
    }
}
