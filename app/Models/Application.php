<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Application
 * @package App\Models
 * @version October 5, 2016, 4:18 am UTC
 */
class Application extends Model
{
    use SoftDeletes;

    public $table = 'applications';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'driver',
        'schema',
        'database',
        'host',
        'port',
        'username',
        'password',
        'date_created'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'driver' => 'string',
        'schema' => 'string',
        'database' => 'string',
        'host' => 'string',
        'port' => 'integer',
        'username' => 'string',
        'password' => 'string',
        'date_created' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'driver' => 'required',
        'schema' => 'required',
        'database' => 'required',
        'host' => 'required',
        'port' => 'required',
        'username' => 'required',
        'password' => 'required',
    ];

    
}
