<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Application extends Model{
    public $table = "applications";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
        "name",
        "driver",
        "schema",
        "database",
        "host",
        "port",
        "username",
        "password",
        "date_created"
    ];

    public static $rules = [
        "name" => "required",
        "driver" => "required",
        "schema" => "required",
        "database" => "required",
        "host" => "required",
        "port" => "required",
        "username" => "required",
        "password" => "required",
        "date_created" => "required|date"
    ];
}
