<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\notes_service ;
use App\Mission ;
use App\recommandation;
use Validator;
class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { $notes_services = notes_service::all()->toArray();
      $missions = Mission::all()->toArray();
        return view('note.index', compact('notes_services'));
        
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
      
        
        return view('note.notev2',compact('missions'));
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
    $i=$request->input('mis');
    //dd($i);
    $note=new notes_service([
    'ref' => request('ref'),
    'date_envoi_unite' => request('de'),
    'objet' => request('ob'),
    'ID_mission' => $i,
    'unite_steg' => request('uni')
    ]);
    $note->save();
   /* $date_prevue=request('dp');
    $txt_reco=request('rec');
    foreach($request->input('rec') as $key => $value) {
        $rules["rec.{$key}"] = 'required';
    }
    $validator = Validator::make($request->all(), $rules);
    if ($validator->passes()) {

           

        
        for($count = 0; $count < count($date_prevue); $count++){
        $rec=new recommandation();
        $rec->date_prevue=$date_prevue[$count];
        $rec->txt_reco=$txt_reco[$count];
        $rec->notes_service()->associate($note);
        $rec->save();
        }*/
    return redirect()->route('note.index')->with('success', 'Note modifié');

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
        $missions = mission::find($id);
        $recommandations = recommandation::find($id);
        return view('note.edit', compact('notes_services', 'id'),compact('missions', 'id'), compact('recommandations', 'id'));
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
        //
        $note=notes_service::where('ID_note', '=', $id)->firstOrFail(); 
        $note->ref = request('ref');
       $note->date_envoi_unite = request('de');
        $note->Objet = request('ob');
        $note->ID_mission = request('mis');
        $note->unite_steg = request('uni');

        $note->save();
        //$date_prevue=request('dp');
        //$txt_reco=request('rec');

               

            
            /*for($count = 0; $count < count($date_prevue); $count++){
            $rec=new recommandation();
            $rec->date_prevue=$date_prevue[$count];
            $rec->txt_reco=$txt_reco[$count];
            $rec->notes_service()->associate($note);
            $rec->save();
            }*/
        return redirect()->route('note.index')->with('success', 'Note modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
       /* $count = DB::table('recommandations')->where(['ID_note'=>$id])->get();
        
        
       // for($i = 0; $i < count($count); $i++){
        $rec = recommandation::where('ID_note', '=', $id)->firstOrFail();
        $rec->delete();*/
       // }
         $note = notes_service::where('ID_note', '=', $id)->firstOrFail();
       // $mission = Missions::where('ID_mission', '=', $note->ID_mission)->firstOrFail();
        // $mission->delete();
        $note->recommandations()->delete();
        $note->delete();
        return redirect()->route('note.index')->with('success', 'note supprimé');
        
    }
}
