<?php

namespace App\Http\Controllers;

use App\Adapters\PointRegisterInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class AdminController extends Controller
{

    public function __construct(
        private PointRegisterInterface $pointRegister
    ) {
    }

    public function index()
    {
        $users = User::where('id', '>', 1)->get();
        return view('admin', ['users' => $users]);
    }

    public function userDestroy(int $id)
    {
        try {
            User::findOrFail($id)->delete();
            return redirect()->route('admin')->with('success', 'Usuario deletado!');
        } catch (\Exception $e) {
            return redirect()->route('admin')->with('error', $e->getMessage());
        }
    }

    public function records()
    {
        $data = $this->pointRegister->all(); // coleta os dados

        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        $fileName = 'pontos_' . now()->format('Ymd_His') . '.json';

        return response()->streamDownload(function () use ($json) {
            echo $json;
        }, $fileName, [
            'Content-Type' => 'application/json',
            'Content-Disposition' => "attachment; filename={$fileName}",
        ]);
    }

    public function userCreate(Request $request)
    {
        // Validação dos dados do formulário
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'cpf' => 'required|cpf|unique:users,cpf', // CPF com 11 dígitos únicos na tabela users
            'password' => 'required|string|min:6', // se quiser confirmar senha, usar campo password_confirmation no form
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Criar o usuário
        try {
            User::create([
                'name' => $request->input('name') . ' ' . $request->input('surname'),
                'cpf' => preg_replace('/\D/', '', $request->input('cpf')),
                'password' => Hash::make($request->input('password')),
            ]);

            return redirect()->back()->with('success', 'Funcionário cadastrado com sucesso!');
        } catch (QueryException $e) {
            // Código do erro para unique violation varia conforme o banco, mas geralmente:
            // SQLite: 19 (constraint failed)
            // MySQL: 23000 (Integrity constraint violation)

            $errorCode = $e->errorInfo[1] ?? null;

            // Para SQLite, código 19 = constraint violation
            // Para MySQL, código 1062 = duplicate entry
            if ($errorCode == 19 || $errorCode == 1062) {
                return redirect()->back()->with('error', 'CPF já cadastrado!');
            }

            return redirect()->back()->with('error', 'Erro ao cadastrar funcionário: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro inesperado: ' . $e->getMessage());
        }
    }
}
