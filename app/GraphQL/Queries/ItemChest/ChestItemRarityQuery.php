<?php

namespace App\GraphQL\Queries\ItemChest;

use App\Models\ItemChest;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class ChestItemRarityQuery extends Query
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
            'chest_id' => [
                'name' => 'chest_id',
                'type' => Type::int(),
                'rules' => ['required']
            ],
            'item_id' => [
                'name' => 'item_id',
                'type' => Type::int(),
                'rules' => ['required']
            ],
        ];
    }

    public function resolve($root, $args)
    {
        return ItemChest::where('chest_id', $args['chest_id'])->where('item_id', $args['item_id'])->first();
    }
}
