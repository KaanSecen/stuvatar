<?php

namespace App\GraphQL\Mutations\ItemStudent;

use App\Models\Item;
use App\Models\ItemStudent;
use App\Models\Student;
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
            $itemStudent->is_active = 0;
        }
        else {
            $itemStudent->is_active = 1;

            $student = Student::findOrFail($itemStudent->student_id);

            $category_id = Item::where('id', $itemStudent->item_id)->value('category_id');

            ItemStudent::where('student_id', $student->id)
                ->whereIn('item_id', Item::where('category_id', $category_id)->pluck('id'))
                ->update(['is_active' => 0]);

        }
        $itemStudent->save();

        return $itemStudent;
    }
}
