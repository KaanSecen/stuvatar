<?php

// app/graphql/types/CategoryType

namespace App\GraphQL\Types;

use App\GraphQL\Queries\ChestStudent\ChestStudentsQuery;
use App\Models\ChestStudent;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ChestStudentType extends GraphQLType
{
    protected $attributes = [
        'name' => 'ChestStudent',
        'description' => 'Collection Inventory Chests of Student',
        'model' => ChestStudent::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID of Inventory Item of Student'
            ],
            'student_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID of Student'
            ],
            'chest_id' => [
                'type' => Type::int(),
                'description' => 'ID of Chest'
            ],
            'used' => [
                'type' => Type::nonNull(Type::boolean()),
                'description' => 'status of Chest'
            ],
        ];
    }
}
