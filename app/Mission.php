<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
public  $timestamps = false ; 
protected  $primaryKey = 'ID_mission';
 protected $fillable = ['equipe-mission','chef-mission','intitulé_mission','unités_steg','nature','specialite' ,'date-envoi-DG','date-retour-DG','etat','anée','matricule'];    
 public function notes()
 {
     return $this->hasMany(notes_service::class,'ID_mission');
 }
 public function recommandations()
{
    return $this->hasMany(recommandation::class,'ID_note');
}
}

