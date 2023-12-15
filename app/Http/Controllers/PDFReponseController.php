<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use App\mission_envoi;
use App\note_service;
use App\mission;
use App\recommandation;
use App\unites_steg;
use App\session_suivre;

class PDFReponseController extends Controller
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
        $id=request("uni");
        $id2=request("ses");
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($this->convert_customer_data_to_html($id,$id2));
     return $pdf->stream();
    }

    function convert_customer_data_to_html($id,$id2)
    {   $session_suivres = session_suivre::find($id2);
        $unites_stegs = unites_steg::find( $id); 
        $note_services = DB::select("select * from `missions`,`notes_services`,`recommandations` where `notes_services`.`ID_note`=`recommandations`.`ID_note` and `notes_services`.`ID_mission`=`missions`.`ID_mission` and `recommandations`.`etat` is NULL ");
        $missions = DB::select("SELECT DISTINCT  `missions`.`intitulé_mission`,unite_steg from `notes_services`,`missions` where `notes_services`.`ID_mission`=`missions`.`ID_mission`  ");
     
     $output = '
     <table  class="table"  border="3" >
            <tr>
            <td width="10%"><img src="photos/img2.png"  width="240" height="66"><br>
            </td>
                <th class="th" colspan="2" ><center>Tableau de suivi des recommandations</center></th>
                </tr>
                </table ><br><br>  
                 ';  
                 foreach($missions as $row2){
                 if($row2->unite_steg == $unites_stegs->designation){
                    $output .="  <h2 class='h2'><font color='midnightblue'>Intitulé de la mission: ".$row2->intitulé_mission."</font></h2>
                    <table class='table table-bordered table-striped' border='1'>
                    <tr>
                    <th rowspan='3'><br>Constatation et Recommandations</th>
                    <th colspan='4' ><center>Plan d'action de l'unité auditée</center></th>
                    <th rowspan='3'>Justification des <br> ecarts des délais</th>
                    </tr>
                    <tr>
                    <th rowspan='2'>Actions correctives <br> envisagées</th>
                    <th rowspan='2'>Point de situation <br>à fin de".$id2."</th>
                    <th colspan='2'>Date de mise en oeuvre</th>
                    </tr>
                    <tr>
                    <th>Prévue</th>
                    <th>Actualisée</th>
                    </tr>
                    ";
                    foreach($note_services as $row){
                    if($row->unite_steg == $unites_stegs->designation){    
                    if($row->intitulé_mission == $row2->intitulé_mission){

                        $output .='<tr><td> <b class="b">Constatation :</b><br>'.$row->txt_constatation.'<br>
                        <b class="b">Recommandation :</b><br>'.$row->txt_reco.'<br>';
                        if($row->niveau_criticité == 4){ $output .='(critique)'; }
                        if($row->niveau_criticité == 3){ $output .='(important)'; }
                        if($row->niveau_criticité == 2){ $output .='(moyen)'; }
                        if($row->niveau_criticité == 1){ $output .='(faible)'; }
                        
                        $output .='</td><td>'.$row->txt_plan_action.'</td>
                        <td></td>
                        <td>'.$row->date_prevue.'</td>
                        <td></td>
                        <td></td>
                        </tr>';

                    }
                }
            }
                   $output .= '</table>';
                
                
                
                }
                }
     
      
     
     return $output;
    }
}

