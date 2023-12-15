<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class recommandation extends Model
{
    //
    public  $timestamps = false ;
    public $table= "recommandations";
    protected  $primaryKey = 'ID_reco';
    protected $fillable = [ 'txt-reco',	'etat',	'date_prevue','date-realisation','txt_plan_action','txt_constatation','niveau_criticité','ID_note'];
    public function notes_service() 
    {
        return $this->belongsTo(\App\notes_service::class,'ID_note');
    }
}
