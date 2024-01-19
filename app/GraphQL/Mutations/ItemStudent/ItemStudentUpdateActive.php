<?php

namespace App\GraphQL\Mutations\ItemStudent;

use App\Models\Item;
use App\Models\ItemStudent;
use App\Models\Student;
use GraphQL\Error\UserError;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class ItemStudentUpdateActive extends Query
{
    protected $attributes = [
        'name' => 'updateItemStudent',
    ];

    public function type(): Type
    {
        return GraphQL::type('ItemStudent');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
                'rules' => ['required']
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $itemStudent = ItemStudent::findOrFail($args['id']);

        if ($itemStudent->is_active == 1) {
            throw new UserError('This item is already active for this student.');
        }

        // Deactivate all other items for the student
        ItemStudent::where('student_id', $itemStudent->student_id)
            ->update(['is_active' => 0]);

        // Activate the selected item
        $itemStudent->is_active = 1;
        $itemStudent->save();

        return $itemStudent;
    }
}
