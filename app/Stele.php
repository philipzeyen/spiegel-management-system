<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable; 

class Stele extends Model
{
    use Notifiable;
    
    protected $primaryKey = 'stelen_id';
    protected $table = "stele_db";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "name_stele",
        "standort",
        "status",
        "loesch_markiert",
        "letzteMeldung",
        "letzteDowntime",
        "createdAt",
        "updatedAt",
        "user_id",
        "config_id"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'stelen_id',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'stelen_id';
    }

    public function user() {
        return $this->belongsTo(User::class, "id", "user_id");
    }

    public function config() {
        return $this->belongsTo(Config::class,"config_id", "config_id");
    }
}
