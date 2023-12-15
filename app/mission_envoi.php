<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mission_envoi extends Model
{
    //
    public  $timestamps = false ;
    public $table= "mission_envois";
    protected  $primaryKey = ['ID_envoi', 'ID_mission'];
    public $incrementing = false;
    public function envoi() 
    {
        return $this->belongsTo(\App\envoi_reponse_unite::class,'ID_envoi');
    }
}