<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class TimeController extends Controller
{
    public function show(string $nome)
    {
        $response = Http::withoutVerifying()->get('https://www.thesportsdb.com/api/v1/json/3/searchteams.php', [
            't' => $nome,
        ]);

        if ($response->failed() || empty($response->json('teams'))) {
            return response()->json(['erro' => 'Time não encontrado'], 404, [], JSON_UNESCAPED_UNICODE);
        }

        $time = $response->json('teams')[0];

        $ligas = [
            'Brazilian Serie A' => 'Campeonato Brasileiro Série A',
            'Brazilian Serie B' => 'Campeonato Brasileiro Série B',
            'Brazilian Serie C' => 'Campeonato Brasileiro Série C',
            'Brazilian Serie D' => 'Campeonato Brasileiro Série D',
        ];

        $paises = [
            'Brazil' => 'Brasil',
        ];

        return response()->json([
            'nome'      => $time['strTeam'],
            'pais'      => $paises[$time['strCountry']] ?? $time['strCountry'],
            'liga'      => $ligas[$time['strLeague']] ?? $time['strLeague'],
            'estadio'   => $time['strStadium'],
            'fundacao'  => $time['intFormedYear'],
            'escudo'    => $time['strBadge'] ?? $time['strTeamBadge'] ?? null,
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }
}