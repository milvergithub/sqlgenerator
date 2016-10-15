<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Table
 * @package App\Models
 * @version October 12, 2016, 4:19 am UTC
 */
class Table extends Model
{
    use SoftDeletes;

    public $table = 'tables';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'tablename',
        'level',
        'cantidad'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'tablename' => 'string',
        'level' => 'string',
        'cantidad' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'tablename' => 'required',
        'level' => 'required',
        'cantidad' => 'required number'
    ];

    
}
