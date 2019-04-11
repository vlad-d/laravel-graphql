<?php


namespace App\GraphQL\Type;

use App\Models\Song;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQlType;

class SongType extends GraphQlType
{
    protected $attributes = [
        'name' => 'Song',
        'description' => 'A Song',
        'model' => Song::class
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of the Song'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The title of the Song'
            ],
            'length' => [
                'type' => Type::int(),
                'description' => 'The length of the song, in seconds'
            ]
        ];
    }

}