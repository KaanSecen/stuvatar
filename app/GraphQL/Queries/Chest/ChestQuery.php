<?php

namespace App\GraphQL\Queries\Chest;

use App\Models\Chest;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class ChestQuery extends Query
{
    protected $attributes = [
        'name' => 'chest',
    ];

    public function type(): Type
    {
        return GraphQL::type('Chest');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
                'rules' => ['required']
            ]
        ];
    }

    public function resolve($root, $args)
    {
        return Chest::findOrFail($args['id']);
    }
}
