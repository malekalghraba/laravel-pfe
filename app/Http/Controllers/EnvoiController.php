<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\unites_steg ;
use App\notes_service ;
use App\recommandation;
use App\Mission;

use App\session_suivre;
use App\envoi_reponse_unite;
use App\mission_envoi;
use App\DB;

class EnvoiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { return view('envoi.envoi');
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
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
        
          return view('envoi.envoi2',compact('unites-stegs', 'id'));
   

        
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
        $id2=request("id2") ;
       $idm=request("idm") ;

      $session_suivres=session_suivre::find($id2);
      $unites_stegs = unites_steg::find($id);
      $envoi_reponse_unites = new envoi_reponse_unite();
      $t=time();
      $tt=date("Y-m-d",$t);
      $envoi_reponse_unites->date_envoi_unite = $tt;
      $envoi_reponse_unites->ID_unite_steg = $id;
      $envoi_reponse_unites->ID_session = $id2;
      $envoi_reponse_unites->save();

      for($count = 0; $count < count($idm); $count++){     
        $mession_envois=new mission_envoi();
        $mession_envois->ID_mission=$idm[$count];
        $mession_envois->envoi()->associate($envoi_reponse_unites);
        $mession_envois->save();
      }
        
        return view('envoi.envoi_recom',compact('unites_stegs', 'id'),compact('session_suivres', 'id2'));
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