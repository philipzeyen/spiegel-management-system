<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Config extends Model
{
    use Notifiable;

    protected $table = "config_db";
    protected $primaryKey = "config_id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "config_name",
        "config_json",
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'config_id',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'config_id';
    }

    public function stelen() {
        return $this->hasMany(Stele::class, "config_id", "config_id");
    }

    public function maskenRefs() {
        return $this->hasMany(MaskeConfigRef::class, "config_id", "config_id");
    }
}
