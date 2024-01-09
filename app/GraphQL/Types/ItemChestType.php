<?php

// app/graphql/types/CategoryType

namespace App\GraphQL\Types;

use App\Models\ItemChest;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ItemChestType extends GraphQLType
{
    protected $attributes = [
        'name' => 'ItemChest',
        'description' => 'Collection Items in Chest',
        'model' => ItemChest::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID of ItemChest'
            ],
            'chest_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID of Chest'
            ],
            'item_id' => [
                'type' => Type::int(),
                'description' => 'ID of Item'
            ],
            'rarity' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Rarity of Item'
            ],
        ];
    }
}
