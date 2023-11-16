<?php

namespace App\GraphQL\Mutations\Student;

use App\Models\Student;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class StudentRemovePoints extends Query
{
    protected $attributes = [
        'name' => 'removePoints',
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
                'description' => 'Points to remove to the student',
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $student = Student::findOrFail($args['student_id']);

        if ($student->points - $args['points'] < 0) {
            throw new \Exception('Cannot remove points. Insufficient balance.');
        }

        $student->points -= $args['points'];
        $student->save();

        return $student;
    }
}
