<?php

// app/graphql/types/CategoryType

namespace App\GraphQL\Types;

use App\Models\Student;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Storage;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class StudentType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Student',
        'description' => 'Collection of Students',
        'model' => Student::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID of student'
            ],
            'first_name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'First name of the student'
            ],
            'last_name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Last name of the student'
            ],
            'card' => [
                'type' => Type::string(),
                'description' => 'Description of the room'
            ],
            'grade_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Current Grade of Student'
            ],
            'points' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Current Points of Student'
            ],
            'students' => [
                'type' => GraphQL::paginate('Student'),
                'description' => 'List of Students'
            ]
        ];
    }
}
