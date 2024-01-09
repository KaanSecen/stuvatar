<?php

namespace App\GraphQL\Queries\ItemChest;

use App\Models\ItemChest;
use App\Models\ItemStudent;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class ItemChestsQuery extends Query
{
    protected $attributes = [
        'name' => 'item_chests',
    ];

    public function type(): Type
    {
        return GraphQL::paginate('ItemChest');
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
            'chest_id' => [
                'name' => 'chest_id',
                'type' => Type::int(),
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $query = ItemChest::query();

        if (isset($args['chest_id'])) {
            $query->where('chest_id', $args['chest_id']);
        }
        $query->orderByRaw('FIELD(rarity, "common", "uncommon", "rare", "legendary")');

        return $query->paginate($args['per_page'], ['*'], 'page', $args['page']);
    }
}
