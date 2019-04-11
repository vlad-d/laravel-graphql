<?php


namespace App\GraphQL\Query;

use App\Models\Song;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class SongsQuery extends Query
{
    protected $attributes = [
        'name' => 'Songs',
        'description' => 'A list of Songs'
    ];

    public function type()
    {
//        return Type::listOf(GraphQL::type('Song'));
        return GraphQL::paginate('Song');
    }

    public function args()
    {
        return [
            'name' => ['name' => 'name', 'type' => Type::string()],
            'take' => ['name' => 'take', 'type' => Type::int()],
            'page' => ['name' => 'page', Type::int()]
        ];
    }

    public function resolve($root, $args)
    {
        $take = $args['take'] ?? 5;
        $page = $args['page'] ?? 1;
        $query = Song::query();

        if (isset($args['name'])) {
            $query->where('name', 'like', "%{$args['id']}%");
        }

        return $query->paginate($take, ['*'], 'page', $page);
    }

}