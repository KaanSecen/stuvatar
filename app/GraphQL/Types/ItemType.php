<?php


namespace App\GraphQL\Types;

use App\GraphQL\Queries\Student\StudentsQuery;
use App\Models\Item;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Storage;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ItemType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Item',
        'description' => 'Collection of Items',
        'model' => Item::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID of item'
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Title of the item'
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'Description of the item'
            ],
            'category_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Category ID of the item'
            ],
            'background_color' => [
                'type' => Type::string(),
                'description' => 'background color of the item'
            ],
            'is_available_for_sale' => [
                'type' => Type::nonNull(Type::boolean()),
                'description' => 'item availability for sale'
            ],
            'price' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'price of ite,'
            ],
            'image_url' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'URL of the item',
                'resolve' => function ($root) {
                    return config('app.url') . Storage::url($root->path . $root->filename) . $root->image;
                },
            ],
            'items' => [
                'type' => GraphQL::paginate('Item'),
                'description' => 'List of items'
            ],
        ];
    }
}
