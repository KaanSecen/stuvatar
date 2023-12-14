<?php

// app/graphql/types/CategoryType

namespace App\GraphQL\Types;

use App\GraphQL\Queries\ItemStudent\ItemStudentsQuery;
use App\Models\ItemStudent;
use App\Models\Student;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ItemStudentType extends GraphQLType
{
    protected $attributes = [
        'name' => 'ItemStudent',
        'description' => 'Collection Inventory Items of Student',
        'model' => ItemStudent::class
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
            'item_id' => [
                'type' => Type::int(),
                'description' => 'ID of Item'
            ],
            'is_active' => [
                'type' => Type::nonNull(Type::boolean()),
                'description' => 'status of item'
            ],
        ];
    }
}
