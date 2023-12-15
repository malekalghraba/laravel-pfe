<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\unites_steg ;
class UnitestegController extends Controller
{
    //
    public function index()
    {
        $unites_stegs = unites_steg::all()->toArray();
        return view('index_unite', compact('unites_stegs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('unite');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
       $unites_steg=new unites_steg();
     
       $unites_steg->designation = request('des');
            
       $unites_steg->codeUR= request('cr');
       $unites_steg->codeUF= request('cf');
               
       
         
           
           
         $unites_steg->save();
        return redirect()->route('unite.index')->with('success', 'unité steg Ajouté');
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
        $unites_stegs = unites_steg::find($id);
        return view('mod_unite', compact('unites_stegs', 'id'));
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

        $unites_steg=unites_steg::where('ID_unite_steg', '=', $id)->firstOrFail(); 
       
        
     
        $unites_steg->designation = request('des');
            
        $unites_steg->codeUR= request('cr');
        $unites_steg->codeUF= request('cf');
                
             
                $unites_steg->save();
            return redirect()->route('unite.index')->with('success', 'Unité steg modifié');
    }

    /**0
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unites_steg = unites_steg::where('ID_unite_steg', '=', $id)->firstOrFail();
        $unites_steg->delete();
        return redirect()->route('unite.index')->with('success', 'unité steg supprimé');
    }
}

