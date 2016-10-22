<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Column
 * @package App\Models
 * @version October 16, 2016, 12:38 am UTC
 */
class Column extends Model
{
    use SoftDeletes;

    public $table = 'columns';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'column_name',
        'data_type',
        'character_maximum_length',
        'is_foreing',
        'referencian',
        'tabla',
        'referenciados',
        'numeric_precision',
        'is_nullable',
        'constraint_type',
        'column_default',
        'check_clause',
        'filled'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'column_name' => 'string',
        'data_type' => 'string',
        'character_maximum_length' => 'string',
        'is_foreing' => 'string',
        'referencian' => 'string',
        'tabla' => 'string',
        'referenciados' => 'string',
        'numeric_precision' => 'string',
        'is_nullable' => 'string',
        'constraint_type' => 'string',
        'column_default' => 'string',
        'check_clause' => 'string',
        'filled' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'column_name' => 'required',
        'data_type' => 'required'
    ];

    
}
