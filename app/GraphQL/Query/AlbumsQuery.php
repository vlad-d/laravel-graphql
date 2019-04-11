<?php


namespace App\GraphQL\Query;


use App\Models\Album;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use GraphQL;
use Rebing\GraphQL\Support\SelectFields;
use GraphQL\Type\Definition\ResolveInfo;

class AlbumsQuery extends Query
{
    protected $attributes = [
        'name' => 'Artists'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Album'));
    }

    public function args()
    {
        return [
            'name' => ['name' => 'title', 'type' => Type::string()],
        ];
    }

    public function resolve($root, $args, SelectFields $selectFields, ResolveInfo $info)
    {
        $query = Album::query();

        if (isset($args['name'])) {
            $query->where('name', 'like', "%{$args['name']}%");
        }

        $relations = $selectFields->getRelations();


        return $query->with($relations)->get();
    }

}