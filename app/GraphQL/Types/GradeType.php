<?php

// app/graphql/types/CategoryType

namespace App\GraphQL\Types;

use App\GraphQL\Queries\Student\StudentsQuery;
use App\Models\Grade;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class GradeType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Grade',
        'description' => 'Collection of Grades',
        'model' => Grade::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID of grade'
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Title of the grade'
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'Description of the room'
            ],
            'color' => [
                'type' => Type::string(),
                'description' => 'Description of the room'
            ],
            'grade_number' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Grade number of grade'
            ],
            'grades' => [
                'type' => GraphQL::paginate('Grade'),
                'description' => 'List of grades'
            ],
            'students' => [
                'type' => GraphQL::paginate('Student'),
                'description' => 'List of students in this grade',
                'args' => (new StudentsQuery())->args(),
                'resolve' => function ($root, $args) {
                    $args['grade_id'] = $root->id;
                    $studentsQuery = new StudentsQuery();
                    return $studentsQuery->resolve(null, $args);
                },
            ],
        ];
    }
}
