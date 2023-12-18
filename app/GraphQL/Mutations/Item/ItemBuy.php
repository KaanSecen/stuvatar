<?php

namespace App\GraphQL\Mutations\Item;

use App\Models\Item;
use App\Models\ItemStudent;
use App\Models\Student;
use GraphQL\Type\Definition\Type;
use GraphQL\Error\UserError;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class ItemBuy extends Query
{
    protected $attributes = [
        'name' => 'buyItem',
    ];

    public function type(): Type
    {
        return GraphQL::type('ItemStudent');
    }

    public function args(): array
    {
        return [
            'student_id' => [
                'name' => 'student_id',
                'type' => Type::int(),
                'rules' => ['required']
            ],
            'item_id' => [
                'name' => 'item_id',
                'type' => Type::int(),
                'rules' => ['required']
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $student = Student::findOrFail($args['student_id']);
        $item = Item::findOrFail($args['item_id']);

        $studentItem = ItemStudent::where('student_id', $student->id)->where('item_id', $item->id)->exists();

        if($studentItem) {
            throw new UserError('Cannot buy item. Item already owned.');
        }

        if(!$item->is_available_for_sale) {
            throw new UserError('Cannot buy item. Item not available for sale.');
        }

        if ($student->points >= $item->price) {
            $student->points -= $item->price;
            $student->save();

            $itemStudent = new ItemStudent();
            $itemStudent->student_id = $student->id;
            $itemStudent->item_id = $item->id;
            $itemStudent->is_active = 0;
            $itemStudent->save();
        } else {
            throw new UserError('Cannot buy item. Insufficient balance.');
        }

        return $itemStudent;
    }
}
