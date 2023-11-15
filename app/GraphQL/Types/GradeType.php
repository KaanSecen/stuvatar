<?php

// app/graphql/types/CategoryType

namespace App\GraphQL\Types;

use App\Models\Grade;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Storage;
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
            ]
        ];
    }
}
