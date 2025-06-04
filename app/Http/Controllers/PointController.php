<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Adapters\PointRegisterInterface;

class PointController extends Controller
{
    public function __construct(
        private PointRegisterInterface $pointRegister
    ) {
    }

    public function register()
    {
        $cpf = auth()->user()->cpf;

        try {
            $this->pointRegister->save($cpf);
        } catch (\Exception $e) {
            return redirect()->route('home')->with("error", $e->getMessage());
        }

        return redirect()->route('home')->with("success", 'Ponto registrado com sucesso!');
    }
}
