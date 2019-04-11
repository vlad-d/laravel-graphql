<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Song
 * @package App\Models
 *
 * @property int id
 * @property int album_id
 * @property int length
 * @property string name
 * @property Artist[] artists
 * @property Album album
 */
class Song extends Model
{

    protected $fillable = ['album_id', 'length', 'name'];

    public function artists()
    {
        return $this->belongsToMany(Artist::class);
    }

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

}