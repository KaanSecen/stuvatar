<?php

namespace App\GraphQL\Queries\Grade;

use App\Models\Grade;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class GradeQuery extends Query
{
    protected $attributes = [
        'name' => 'grade',
    ];

    public function type(): Type
    {
        return GraphQL::type('Grade');
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
        return Grade::findOrFail($args['id']);
    }
}
