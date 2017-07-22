<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class MaskeConfigRef extends Model
{
    use Notifiable;

    protected $table = "mask_config_ref";

    protected $fillable = [
        "config_id",
        "masken_id",
    ];

    public function getRouteKeyName()
    {
        return ['config_id', 'masken_id'];
    }

    public function config() {
        return $this->belongsTo(Config::class, "config_id", "config_id");
    }

    public function maske() {
        return $this->belongsTo(Maske::class ,"masken_id" ,"masken_id");
    }
}
