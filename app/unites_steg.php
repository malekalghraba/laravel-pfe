<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class unites_steg extends Model
{
    //

    public $table = "unites-stegs";
    public  $timestamps = false ;
    protected  $primaryKey = 'ID_unite_steg';
    //
    protected $fillable = ['designation',	'codeUR'	,'codeUF'];
}