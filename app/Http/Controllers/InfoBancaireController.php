<?php

namespace App\Http\Controllers;
use App\Models\InfoBancaire;
use Illuminate\Http\Request;

class InfoBancaireController extends Controller
{
    public function index(){
         $infosBancaires = InfoBancaire::actif()->get();
         return response()->json($infosBancaires);
    }
}
