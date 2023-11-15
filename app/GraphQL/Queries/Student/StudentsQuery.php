<?php

namespace App\GraphQL\Queries\Student;

use App\Models\Student;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class StudentsQuery extends Query
{
    protected $attributes = [
        'name' => 'students',
    ];

    public function type(): Type
    {
        return GraphQL::paginate('Student');
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
            'grade_id' => [
                'name' => 'grade_id',
                'type' => Type::int(),
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $query = Student::query();

        if (isset($args['grade_id'])) {
            $query->where('grade_id', $args['grade_id']);
        }

        return $query->paginate($args['per_page'], ['*'], 'page', $args['page']);
    }
}
