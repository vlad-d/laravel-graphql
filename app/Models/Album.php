<?php


namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Album
 * @package App\Models
 *
 * @property int id
 * @property int main_artist_id
 * @property string name
 * @property string genre
 * @property Carbon release_date
 * @property Artist artist
 * @property Song[] songs
 */
class Album extends Model
{

    protected $fillable = ['main_artist_id', 'name', 'genre', 'release_date'];
    protected $dates = ['release_date'];

    public function artist()
    {
        return $this->belongsTo(Artist::class, 'main_artist_id');
    }

    public function songs()
    {
        return $this->hasMany(Song::class);
    }

    public static function getGenres() : array
    {
        return ['rock', 'pop', 'jazz', 'trance'];
    }
}