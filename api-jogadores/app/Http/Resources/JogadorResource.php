<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JogadorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->resource['id'],
            'nome'          => $this->resource['nome'],
            'time'          => $this->resource['time'],
            'posicao'       => $this->resource['posicao'],
            'numero_camisa' => $this->resource['numero_camisa'],
        ];
    }
}