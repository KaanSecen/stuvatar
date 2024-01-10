<?php

namespace App\GraphQL\Mutations\Chest;

use App\Models\Chest;
use App\Models\ChestStudent;
use App\Models\Item;
use App\Models\ItemStudent;
use App\Models\Student;
use GraphQL\Type\Definition\Type;
use GraphQL\Error\UserError;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class ChestGive extends Query
{
    protected $attributes = [
        'name' => 'giveChest',
    ];

    public function type(): Type
    {
        return GraphQL::type('ChestStudent');
    }

    public function args(): array
    {
        return [
            'student_id' => [
                'name' => 'student_id',
                'type' => Type::int(),
                'rules' => ['required']
            ],
            'chest_id' => [
                'name' => 'chest_id',
                'type' => Type::int(),
                'rules' => ['required']
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $student = Student::findOrFail($args['student_id']);
        $chest = Chest::findOrFail($args['chest_id']);

        $chestStudent = new ChestStudent();
        $chestStudent->student_id = $student->id;
        $chestStudent->chest_id = $chest->id;
        $chestStudent->used = 0;
        $chestStudent->save();

        return $chestStudent;
    }
}
