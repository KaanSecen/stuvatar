<?php

namespace App\GraphQL\Queries\ChestStudent;

use App\Models\ChestStudent;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class ChestStudentQuery extends Query
{
    protected $attributes = [
        'name' => 'chest_inventory',
    ];

    public function type(): Type
    {
        return GraphQL::type('ChestStudent');
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
        return ChestStudent::findOrFail($args['id']);
    }
}
