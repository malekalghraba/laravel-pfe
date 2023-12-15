<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class envoi_reponse_unite extends Model
{
    //
    public $table= "envoi_reponse_unites";
    public  $timestamps = false ;
    protected  $primaryKey = 'ID_envoi';
    //
    protected $fillable = ['ID_envoi','date_envoi_unite','date_reponse_unite','ID_unite_steg','ID_session'];
}
