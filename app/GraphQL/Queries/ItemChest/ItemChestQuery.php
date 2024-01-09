<?php

namespace App\GraphQL\Queries\ItemChest;

use App\Models\ItemChest;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class ItemChestQuery extends Query
{
    protected $attributes = [
        'name' => 'item_chest',
    ];

    public function type(): Type
    {
        return GraphQL::type('ItemChest');
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
        return ItemChest::findOrFail($args['id']);
    }
}
