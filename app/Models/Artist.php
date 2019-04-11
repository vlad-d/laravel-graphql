<?php


namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Artist
 * @package App\Models
 *
 * @property int id
 * @property string name
 * @property Carbon born_on
 * @property Song[] songs
 */
class Artist extends Model
{

    protected $fillable = ['name', 'born_on'];
    protected $dates = ['born_on'];

    public function songs()
    {
        return $this->belongsToMany(Song::class);
    }

}