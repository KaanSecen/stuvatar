<?php

namespace App\GraphQL\Queries\ItemStudent;

use App\Models\ItemStudent;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class ItemStudentQuery extends Query
{
    protected $attributes = [
        'name' => 'item_inventory',
    ];

    public function type(): Type
    {
        return GraphQL::type('ItemStudent');
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
        return ItemStudent::findOrFail($args['id']);
    }
}
