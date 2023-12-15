<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reponse_recommandation extends Model
{
    //
    public  $timestamps = false ;
    public $table= "reponse_recommandations";
    protected  $primaryKey = 'ID_reco_rep';
    protected $fillable = [ 'ID_reco','date_saisie_plan','date_prevue','date_actualise','txt_plan_action','txt_justification','ID_envoi','ID_mission'];
}