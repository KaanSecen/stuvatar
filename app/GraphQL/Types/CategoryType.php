<?php


namespace App\GraphQL\Types;

use App\GraphQL\Queries\Item\ItemsQuery;
use App\GraphQL\Queries\Student\StudentsQuery;
use App\Models\Category;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class CategoryType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Category',
        'description' => 'Collection of Categories',
        'model' => Category::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID of category'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Name of the category'
            ],
            'slug' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Slug of the category'
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'Description of the room'
            ],
            'categories' => [
                'type' => GraphQL::paginate('Category'),
                'description' => 'List of categories'
            ],
            'items' => [
                'type' => GraphQL::paginate('Item'),
                'description' => 'List of items in one category',
                'args' => (new ItemsQuery())->args(),
                'resolve' => function ($root, $args) {
                    $args['category_id'] = $root->id;
                    $ItemsQuery = new ItemsQuery();
                    return $ItemsQuery->resolve(null, $args);
                },
            ],
        ];
    }
}
