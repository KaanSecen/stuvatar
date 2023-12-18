<?php


namespace App\GraphQL\Types;

use App\Models\Chest;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Storage;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ChestType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Chest',
        'description' => 'Collection of Chests',
        'model' => Chest::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID of chest'
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Title of the chest'
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'Description of the chest'
            ],
            'is_available_for_sale' => [
                'type' => Type::nonNull(Type::boolean()),
                'description' => 'chest availability for sale'
            ],
            'price' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'price of the chest'
            ],
            'image_url' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'URL of the image',
                'resolve' => function ($root) {
                    return config('app.url') . Storage::url($root->path . $root->filename) . $root->image;
                },
            ],
            'chests' => [
                'type' => GraphQL::paginate('Chest'),
                'description' => 'List of chests'
            ],
        ];
    }
}
