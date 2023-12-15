<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class session_suivre extends Model
{
    //
    
    //
    public $table = "session_suivres";
    public  $timestamps = false ; 
protected  $primaryKey = 'ID_session';
 protected $fillable = ['date_debut','date_fin','date_ cloture','spetialite']; 
}
