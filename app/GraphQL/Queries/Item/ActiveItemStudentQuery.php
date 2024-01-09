<?php

namespace App\GraphQL\Queries\Item;

use App\Models\Item;
use App\Models\ItemStudent;
use GraphQL\Error\UserError;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class ActiveItemStudentQuery extends Query
{
    protected $attributes = [
        'name' => 'active_item_student',
    ];

    public function type(): Type
    {
        return GraphQL::type('Item');
    }

    public function args(): array
    {
        return [
            'student_id' => [
                'name' => 'student_id',
                'type' => Type::int(),
                'rules' => ['required']
            ]
        ];
    }

    public function resolve($root, $args)
    {
        //return only active student item and return that item model
        $itemStudent = ItemStudent::where('student_id', $args['student_id'])->where('is_active', true)->first();


        if(!$itemStudent) {
            throw new UserError('No active item found for this student.');
        }

        return Item::where('id', $itemStudent->item_id)->first();
    }
}
