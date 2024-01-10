<?php

namespace App\GraphQL\Mutations\Item;

use App\Models\ChestStudent;
use App\Models\Item;
use App\Models\ItemChest;
use App\Models\ItemStudent;
use App\Models\Student;
use GraphQL\Error\UserError;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class ChestOpen extends Query
{
    protected $attributes = [
        'name' => 'OpenChest',
    ];

    public function type(): Type
    {
        return GraphQL::type('Item');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
                'rules' => ['required']
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $studentChest = ChestStudent::findOrFail($args['id']);

        if($studentChest->used == 1) {
            throw new UserError('Cannot open Chest. Chest already opened.');
        }

        $roll = number_format(mt_rand(0, 10000) / 100, 2);



        if ($roll <= 2.50 || $roll >= 97.50) {
            $rarity = 'legendary';
        } elseif ($roll <= 7.50 || $roll >= 92.50) {
            $rarity = 'rare';
        } elseif ($roll <= 15.00 || $roll >= 85.00) {
            $rarity = 'uncommon';
        } else {
            $rarity = 'common';
        }

        $itemsChest = ItemChest::where('chest_id', $studentChest->chest_id)->where('rarity', $rarity)->get();


        if (!$itemsChest->isEmpty()) {
            foreach ($itemsChest as $itemChest) {
                $itemStudent = ItemStudent::where('student_id', $studentChest->student_id)->where('item_id', $itemChest->item_id)->exists();

                if (!$itemStudent) {
                    $itemStudent = new ItemStudent();
                    $itemStudent->student_id = $studentChest->student_id;
                    $itemStudent->item_id = $itemChest->item_id;
                    $itemStudent->is_active = 0;
                    $itemStudent->save();

                    $studentChest->used = 1;
                    $studentChest->save();

                    return Item::findOrFail($itemChest->item_id);
                }
            }
        }

        $studentChest->used = 1;
        $studentChest->save();

        $student = Student::findOrFail($studentChest->student_id);
        $student->points += 100;
        $student->save();

        throw new UserError("You Already have all $rarity items. You have been awarded 100 points instead.");
    }
}
