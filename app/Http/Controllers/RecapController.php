<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\mission_envoi;
use App\mission;
use App\recommandation;
use PhpOffice\PhpWord\PhpWord;

class RecapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('recap.recap');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        //
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
        //
        $missions = mission::find( $id); 
        return view('recap.recap2',compact('missions', 'id'));
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
        $missions = mission::find( $id); 
        $idr=request("idr");
        $etat=request("etat");
        $updateProducts = [];
       
 foreach((array) $request->idr as $id) {
    for($count = 0; $count < count($idr); $count++){
  $updateProducts[] = recommandation::where('ID_reco', $idr[$count])
                                      ->first()
                                      ->update(['etat' => $etat[$count]]);
 
    }
    }
    
   
    return view('recap.recap3',compact('missions', 'id'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}