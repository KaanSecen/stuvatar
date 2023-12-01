<?php

namespace App\GraphQL\Queries\Item;

use App\Models\Item;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class ItemsQuery extends Query
{
    protected $attributes = [
        'name' => 'items',
    ];

    public function type(): Type
    {
        return GraphQL::paginate('Item');
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
            'category_id' => [
                'name' => 'category_id',
                'type' => Type::int(),
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $query = Item::query();

        if (isset($args['category_id'])) {
            $query->where('category_id', $args['category_id']);
        }

        return $query->paginate($args['per_page'], ['*'], 'page', $args['page']);
    }
}
