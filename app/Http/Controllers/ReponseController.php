<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\envoi_reponse_unite;
use App\reponse_recommandation;
class ReponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('reponse.reponse');
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
        $envoi_reponse_unites = envoi_reponse_unite::find( $id); 
        return view('reponse.reponse_recom',compact('envoi_reponse_unites', 'id'));
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
        $envoi_reponse_unites = envoi_reponse_unite::where('ID_envoi', '=', $id)->firstOrFail(); 
        $t=time();
        $tt=date("Y-m-d",$t);
        $envoi_reponse_unites->date_reponse_unite=$tt;
        $envoi_reponse_unites->save();

        $idr=request("idr");
        $ide=request("ide");
        $idm=request("idm");
        $tpa=request("tpa");
        $sit=request("sit");
        $dp=request("dp");
        $da=request("da");
        $jus=request("jus");
        $t=time();
        $tt=date("Y-m-d",$t);


         for($count = 0; $count < count($idr); $count++){      
        $reponse_recommandations = new reponse_recommandation();
        $reponse_recommandations->date_saisie_plan = $tt;
        $reponse_recommandations->ID_reco = $idr[$count];
        $reponse_recommandations->date_prevue =  $dp[$count];
        $reponse_recommandations->date_actualise = $da[$count];
        $reponse_recommandations->txt_plan_action = $tpa[$count];
        $reponse_recommandations->txt_justification = $jus[$count];
        $reponse_recommandations->ID_envoi = $ide;
        $reponse_recommandations->ID_mission =  $idm[$count];

        $reponse_recommandations->save();
        
         }

         return view('reponse.reponse')->with('success', 'recommandation supprimé');



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