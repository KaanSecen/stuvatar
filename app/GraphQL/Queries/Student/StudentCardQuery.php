<?php

namespace App\GraphQL\Queries\Student;

use App\Models\Student;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class StudentCardQuery extends Query
{
    protected $attributes = [
        'name' => 'student_card',
    ];

    public function type(): Type
    {
        return GraphQL::type('Student');
    }

    public function args(): array
    {
        return [
            'card' => [
                'name' => 'card',
                'type' => Type::string(),
                'rules' => ['required']
            ]
        ];
    }

    public function resolve($root, $args)
    {
        return Student::where('card', $args['card'])->firstOrFail();
    }
}
