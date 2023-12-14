<?php

namespace App\GraphQL\Queries\ItemStudent;

use App\Models\ItemStudent;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class ItemStudentsQuery extends Query
{
    protected $attributes = [
        'name' => 'item_inventories',
    ];

    public function type(): Type
    {
        return GraphQL::paginate('ItemStudent');
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
            'student_id' => [
                'name' => 'student_id',
                'type' => Type::int(),
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $query = ItemStudent::query();

        if (isset($args['student_id'])) {
            $query->where('student_id', $args['student_id']);
        }

        return $query->paginate($args['per_page'], ['*'], 'page', $args['page']);
    }
}
