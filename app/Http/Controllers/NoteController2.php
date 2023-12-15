<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\notes_service ;
use App\Mission ;
use App\recommandation;
use Validator;
class NoteController2 extends Controller
{
    //
    public function index()
    {
        return view('note.index2');
        
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
        
        return view('note.note2');
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
       
        return redirect()->route('note2.index')->with('success', 'Note modifié');
    
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
            return view('note.edit2', compact('notes_services', 'id'));
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
            return redirect()->route('note2.index')->with('success', 'Note modifié');
        }
    }
    

  

