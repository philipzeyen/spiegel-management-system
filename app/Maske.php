<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Maske extends Model
{
    use Notifiable;

    protected $table = "masken_db";
    protected $primaryKey = "masken_id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "name_maske",
        "punkte",
        "bilddatei"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'masken_id',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'masken_id';
    }

    public function configRefs() {
        return $this->hasMany(MaskeConfigRef::class, "masken_id", "masken_id");
    }
}
