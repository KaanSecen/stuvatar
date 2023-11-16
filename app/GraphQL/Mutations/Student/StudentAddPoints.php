<?php

namespace App\GraphQL\Mutations\Student;

use App\Models\Student;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class StudentAddPoints extends Query
{
    protected $attributes = [
        'name' => 'addPoints',
    ];

    public function type(): Type
    {
        return GraphQL::type('Student');
    }

    public function args(): array
    {
        return [
            'student_id' => [
                'name' => 'student_id',
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID of the student',
            ],
            'points' => [
                'name' => 'points',
                'type' => Type::nonNull(Type::int()),
                'description' => 'Points to add to the student',
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $student = Student::findOrFail($args['student_id']);
        $student->points += $args['points'];
        $student->save();

        return $student;
    }
}
