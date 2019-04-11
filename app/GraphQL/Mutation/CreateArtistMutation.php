<?php


namespace App\GraphQL\Mutation;


use App\Models\Artist;
use GraphQL;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\Type;


class CreateArtistMutation extends Mutation
{
    protected $attributes = [
        'name' => 'CreateArtist'
    ];

    public function type()
    {
        return GraphQL::type('Artist');
    }

    public function args()
    {
        return [
            'name' => ['name' => 'name', 'type' => Type::string()],
            'born_on' => ['name' => 'bornOn', 'type' => Type::string(), 'description' => 'The year the artist was born']
        ];
    }

    public function rules(array $args = [])
    {
        return [
            'name' => ['required'],
            'bornOn' => ['required', 'date']
        ];
    }


    public function resolve($root, $args)
    {
        return Artist::create([
            'name' => $args['name'],
            'born_on' => $args['bornOn']
        ]);
    }

}