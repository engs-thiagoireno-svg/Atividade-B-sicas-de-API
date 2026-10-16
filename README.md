# Atividade Básica de API

Três projetos nesta pasta:

- api-consumo: Laravel consumindo a API pública TheSportsDB
- api-jogadores: API REST de jogadores - Laravel
- cliente-jogadores: projeto em CodeIgniter que consome a API de jogadores

# Como fazer fumagar esse treco ai 

Em api-consumo e api-jogadores:

```bash
composer install
copy .env.example .env
php artisan key:generate
php artisan serve
```

Os dois usam a porta 8000, então é só vc rodar um de cada vez

Em `cliente-jogadores` precisa da `api-jogadores` rodando e da extensão `intl` ativada no `php.ini`:

```bash
composer install
php spark serve
```

## Rotas

- api-consumo: GET /time/{nome}
- api-jogadores: GET, POST /api/jogadores e GET, PUT, DELETE /api/jogadores/{id}
- cliente-jogadores: GET /jogadores (porta 8080)