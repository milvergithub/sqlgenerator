<?php

namespace App\Repositories;

use App\Models\Column;
use InfyOm\Generator\Common\BaseRepository;

class ColumnRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
     * Configure the Model
     **/
    public function model()
    {
        return Column::class;
    }
}
