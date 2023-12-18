<?php

namespace App\GraphQL\Queries\Chest;

use App\Models\Chest;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class ChestsQuery extends Query
{
    protected $attributes = [
        'name' => 'chests',
    ];

    public function type(): Type
    {
        return GraphQL::paginate('Chest');
    }

    public function args(): array
    {
        return [
            'page' => [
                'name' => 'page',
                'type' => Type::int(),
                'defaultValue' => 1,
            ],
            'per_page' => [
                'name' => 'per_page',
                'type' => Type::int(),
                'defaultValue' => 10,
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $query = Chest::query();

        return $query->paginate($args['per_page'], ['*'], 'page', $args['page']);
    }
}
