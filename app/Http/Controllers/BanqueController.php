<?php

namespace App\Http\Controllers;

use App\Models\Procedure;
use Illuminate\Http\Request;

class BanqueController extends Controller
{
    public function index(){
        $pageTitle = 'Banque';
        $clients = Procedure::where('solde',"0")->orderBy('created_at','desc')->get();
        return view("banque.index", [
            'pageTitle' => $pageTitle,
            'clients'=> $clients,
        ]);
    }
}
