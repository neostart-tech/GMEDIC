<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;



class SubCategorie extends Model
{
    use HasFactory,HasTranslations;

    protected $fillable=['sub_categorie_name',"categorie_id","slug"];

    public $translatable = ['sub_categorie_name']; 

    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }

}
