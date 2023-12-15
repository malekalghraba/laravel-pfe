<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mission ;
use App\notes_service;
use DB;
class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  public function index()
    {
        $missions = mission::all()->toArray();
        return view('mission.index', compact('missions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mission.missv2');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //$this->validate($request,['equipe-mission'=>'required','chef-mission'=>'required','intitulé-mission'=>'required',
     // 'nature'=>'required','spetialite'=>'required','anee'=>'required']);
      //'date-envoi-DG'=>'required', 'date-retour-DG'=>'required',
      //'etat'=>'required','anee'=>'required']);
      // $this->Validate($request->all());
       $mission=new mission();
     
        $mission->equipe_mission = request('equipe');
            
        $mission->chef_mission= request('chef');
        $mission->unités_steg= request('unt');
               
        $mission->intitulé_mission= request('int');
             
        $mission->nature =request('nature');
        $mission->specialite= request('speciale');
        $mission->date_envoi_DG= request('de');
        $mission->date_retour_DG= request('dr');
        $mission->etat= 'en cours';
        $mission->anée= request('anee');
        $mission->matricule= request('mat');
         
           
           
         $mission->save();
        return redirect()->route('mission.index')->with('success', 'mission Ajouté');
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
    {
        $missions = mission::find($id);
        return view('mission.edit', compact('missions', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { //$this->Validate($request->all());

        $mission=mission::where('ID_mission', '=', $id)->firstOrFail(); 
       
        $mission->equipe_mission = request('equipe');
            
        $mission->chef_mission= request('chef');
        $mission->unités_steg= request('unt');
               
        $mission->intitulé_mission= request('int');
             
        $mission->nature =request('nature');
        $mission->specialite= request('speciale');
        $mission->date_envoi_DG= request('de');
        $mission->date_retour_DG= request('dr');
        $mission->etat= 'en cours';
        $mission->anée= request('anee');
             
                $mission->save();
            return redirect()->route('mission.index')->with('success', 'mission modifié');
    }

    /**0
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $count = DB::table('notes_services')->where(['ID_mission'=>$id])->get();
        
        
        for($i = 0; $i < count($count); $i++){
        $note = notes_service::where('ID_mission', '=', $id)->firstOrFail();
        $note->recommandations()->delete();
        $note->delete();
        }
        $mission = mission::where('ID_mission', '=', $id)->firstOrFail();
        /*$mission->notes()->delete();
        $mission->recommandations()->delete();*/
        $mission->delete();
        
        return redirect()->route('mission.index')->with('success', 'mission supprimé');
    }
}
