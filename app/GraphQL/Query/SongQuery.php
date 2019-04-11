<?php


namespace App\GraphQL\Query;

use App\Models\Song;
use GraphQL;
use Rebing\GraphQL\Support\Query;
use GraphQL\Type\Definition\Type;

class SongQuery extends Query
{
    protected $attributes = [
        'name' => 'Song'
    ];

    public function type()
    {
        return GraphQL::type('Song');
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()]
        ];
    }

    public function rules(array $args = [])
    {
        return [
            'id' => ['required', 'integer', 'min:1']
        ];
    }

    public function resolve($root, $args)
    {
        return Song::findOrFail($args['id']);
    }


}