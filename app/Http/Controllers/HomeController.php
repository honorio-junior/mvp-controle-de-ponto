<?php

namespace App\Http\Controllers;

use App\Adapters\PointRegisterInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function __construct(
        private PointRegisterInterface $pointRegister
    ){
    }
    public function index()
    {
        $records = $this->pointRegister->find(Auth::user()->cpf);

        return view("home", [
            'name' => Auth::user()->name,
            'currentTime' => date('d/m/Y H:i:s'),
            'records' => $records,
        ]);
    }
}
