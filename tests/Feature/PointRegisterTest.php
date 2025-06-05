<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Adapters\SleekDBAdapter;

class PointRegisterTest extends TestCase
{

    public function test_save(): void
    {
        // $data = [
        //     "cpf" => "00000000000",
        //     "points" => [
        //         [
        //             "date("Y-m-d")" => [
        //                 date("H:i:s"),
        //                 date("H:i:s"),
        //                 date("H:i:s"),
        //                 date("H:i:s"),
        //             ],
        //         ]
        //     ]
        // ];
        $sleek = new SleekDBAdapter();
        $cpf = '00000000000';
        $sleek->save($cpf);
    }

    public function test_find(): void
    {
        $sleek = new SleekDBAdapter();
        $result = $sleek->find('00000000000');
        dump($result);
    }

    public function test_all(): void
    {
        $sleek = new SleekDBAdapter();
        $result = $sleek->all();
        dump($result);
    }
}
