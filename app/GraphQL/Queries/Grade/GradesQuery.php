<?php

namespace App\GraphQL\Queries\Grade;

use App\Models\Grade;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class GradesQuery extends Query
{
    protected $attributes = [
        'name' => 'grades',
    ];

    public function type(): Type
    {
        return GraphQL::paginate('Grade');
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
            'grade_number' => [
                'name' => 'grade_number',
                'type' => Type::int(),
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $query = Grade::query();

        if (isset($args['grade_number'])) {
            $query->where('grade_number', $args['grade_number']);
        }

        return $query->paginate($args['per_page'], ['*'], 'page', $args['page']);
    }
}
