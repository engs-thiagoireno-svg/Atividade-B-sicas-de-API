<?php

namespace App\Controllers;

class Jogadores extends BaseController
{
    public function index()
    {
        $client = \Config\Services::curlrequest();

        $resposta = $client->get('http://127.0.0.1:8000/api/jogadores', [
            'headers' => ['Accept' => 'application/json'],
        ]);

        $dados = json_decode($resposta->getBody(), true);

        return view('jogadores', ['jogadores' => $dados['data']]);
    }
}