<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class notes_service extends Model

{
    public  $timestamps = false ;
    protected  $primaryKey = 'ID_note';
    //
    protected $fillable = ['objet', 'date_envoi_unite','unite_steg','ref','ID_mission'];
    public function recommandations()
{
    return $this->hasMany(recommandation::class,'ID_note');
}
public function mis() 
    {
        return $this->belongsTo(Mission::class,'ID_mission');
    }
}
