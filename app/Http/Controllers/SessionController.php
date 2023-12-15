<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\session_suivre ;
use App\DB;
use App\Validator;


class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { $session_suivres = session_suivre::all()->toArray();
        return view('session_suivre.index', compact('$session_suivres'));
        
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        
        return view('session_suivre.suivre');
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
             
            $ses=new session_suivre();
            $ses->date_debut=$request->input('db');
            $ses->date_fin=$request->input('se');
            $ses->specialité=$request->input('sp');
            $ses->save();
            
            return redirect()->route('session.index')->with('success', 'Session de suivre ajouté');
        

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
    {   $session_suivres = session_suivre::findOrFail($id);
        return view('session_suivre.edit', compact('session_suivres','id'));
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
        
        $session_suivres = session_suivre::where('ID_session', '=', $id)->firstOrFail();
 
        $session_suivres->date_debut=$request->input('db');
        $session_suivres->date_fin=$request->input('se');
        $session_suivres->specialité=$request->input('sp');
        $session_suivres->save();
    
        return redirect()->route('session.index')->with('success', 'Session de suivre modifié');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
         $ses = session_suivre::where('ID_session', '=', $id)->firstOrFail();
      
        $ses->delete();
        
        return redirect()->route('session.index')->with('success', 'Session de suivre supprimé');
        
    }
}