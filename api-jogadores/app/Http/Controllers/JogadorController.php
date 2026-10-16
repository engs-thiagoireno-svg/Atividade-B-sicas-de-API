<?php

namespace App\Http\Controllers;

use App\Http\Resources\JogadorResource;
use Illuminate\Http\Request;

class JogadorController extends Controller
{
    private function arquivo(): string
    {
        return storage_path('app/jogadores.json');
    }

    private function carregar(): array
    {
        if (!file_exists($this->arquivo())) {
            $this->salvar([
                ['id' => 1, 'nome' => 'Gabigol', 'time' => 'Flamengo', 'posicao' => 'Atacante', 'numero_camisa' => 9],
                ['id' => 2, 'nome' => 'Rony', 'time' => 'Palmeiras', 'posicao' => 'Atacante', 'numero_camisa' => 10],
                ['id' => 3, 'nome' => 'Memphis', 'time' => 'Corinthians', 'posicao' => 'Atacante', 'numero_camisa' => 10],
            ]);
        }

        return json_decode(file_get_contents($this->arquivo()), true);
    }

    private function salvar(array $jogadores): void
    {
        file_put_contents(
            $this->arquivo(),
            json_encode(array_values($jogadores), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        );
    }

    private function naoEncontrado()
    {
        return response()->json(['erro' => 'Jogador não encontrado'], 404);
    }

    public function index()
    {
        return JogadorResource::collection(collect($this->carregar()));
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:100',
            'time' => 'required|string|max:100',
            'posicao' => 'required|string|max:50',
            'numero_camisa' => 'required|integer|min:1|max:99',
        ]);

        $jogadores = $this->carregar();
        $dados['id'] = empty($jogadores) ? 1 : max(array_column($jogadores, 'id')) + 1;

        $jogadores[] = $dados;
        $this->salvar($jogadores);

        return (new JogadorResource($dados))->response()->setStatusCode(201);
    }

    public function show(string $id)
    {
        foreach ($this->carregar() as $jogador) {
            if ($jogador['id'] == $id) {
                return new JogadorResource($jogador);
            }
        }

        return $this->naoEncontrado();
    }

    public function update(Request $request, string $id)
    {
        $dados = $request->validate([
            'nome' => 'sometimes|required|string|max:100',
            'time' => 'sometimes|required|string|max:100',
            'posicao' => 'sometimes|required|string|max:50',
            'numero_camisa' => 'sometimes|required|integer|min:1|max:99',
        ]);

        $jogadores = $this->carregar();

        foreach ($jogadores as $i => $jogador) {
            if ($jogador['id'] == $id) {
                $jogadores[$i] = array_merge($jogador, $dados);
                $this->salvar($jogadores);

                return new JogadorResource($jogadores[$i]);
            }
        }

        return $this->naoEncontrado();
    }

    public function destroy(string $id)
    {
        $jogadores = $this->carregar();

        foreach ($jogadores as $i => $jogador) {
            if ($jogador['id'] == $id) {
                unset($jogadores[$i]);
                $this->salvar($jogadores);

                return response()->noContent();
            }
        }

        return $this->naoEncontrado();
    }
}