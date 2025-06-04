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
        //     "cpf" => "01506890202",
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
        $cpf = '01506890202';
        $sleek->save($cpf);
    }

    public function test_find(): void
    {
        $sleek = new SleekDBAdapter();
        $result = $sleek->find('01506890202');
        dump($result);
    }
}
