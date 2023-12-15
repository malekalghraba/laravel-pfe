<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use App\mission_envoi;
use App\note_service;
use App\mission;
use App\recommandation;
use App\repoonse_recommandation;
use App\session_suivre;

class PDFRecapController extends Controller
{
    function index()
    {
     $customer_data = $this->get_customer_data();
     return view('dynamic_pdf')->with('customer_data', $customer_data);
    }

    function get_missions()
    {
     $missions = DB::table('missions')
         ->get();
     return $missions;
    }

    function pdf(Request $request)
    {
        $id=request("mis");
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($this->convert_customer_data_to_html($id));
     return $pdf->stream();
    }

    function convert_customer_data_to_html($id)
    {
        $missions = mission::find( $id); 
        $note_services = DB::select("select * from `notes_services` ");
        $reco = DB::select("select * from `recommandations` ");
        $reponse_reco = DB::select("SELECT * FROM `reponse_recommandations`");
        $ses = DB::select("SELECT * FROM `session_suivres`  ORDER by `date_fin` desc   ");
     
     $output = '
     <table  class="table"  border="3" >
            <tr>
            <td width="10%"><img src="photos/img2.png"  width="240" height="66"><br>
            </td>
                <th class="th" colspan="2" ><center>Compte rendu du suivi des recommandations</center></th>
                
               
            </tr>
        </table ><br><br>
     <h3 align="center"><u>Intitulé de la mission</u> : <b class="b">'.$missions->intitulé_mission.'</b></h3>
     <table class="class="table table-bordered"" width="100%" border="1" >
     <tr>
    
     <th>Recommandations</th>
     <th><center>Mise en<br> oeuvre</center></th>
     <th><center>Entamée/<br>Finalisation<br>prévue</center></th>
     <th><center>A suivre/<br>Réalisation<br>prévue</center></th> 
     </tr>
      ';  

      foreach($note_services as $note){
      if($note->ID_mission == $missions->ID_mission){
      foreach($reco as $rec){
      if($rec->ID_note == $note->ID_note){
      $output .= '<tr><td>'.$rec->txt_reco.'</td><td>';
      if($rec->etat == 'Mise en oeuvre')  {
        $output .= '<center>X</center><br>';}
        $output .= '</td><td>';
      if($rec->etat == 'Entamnée') {
      foreach($reponse_reco as $reponse){
      if($reponse->ID_reco == $rec->ID_reco){
        $output .= '<center>X<br>'.$reponse->date_actualise.'</center>';}}}
        $output .= '</td><td>';
       

        if($rec->etat == 'A suivre'){ 
        foreach($reponse_reco as $reponse){
        if($reponse->ID_reco == $rec->ID_reco){
            $output .= '<center>X<br>'.$reponse->date_actualise.'</center>';
        }}}
         
        $output .= '</td></tr>';


        
      }
      }
      }
      }
     
      
     $output .= '</table>';
     return $output;
    }
}

