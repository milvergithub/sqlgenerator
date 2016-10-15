<?php

namespace App\Repositories;

use App\Models\Table;
use InfyOm\Generator\Common\BaseRepository;

class TableRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'tablename',
        'level',
        'cantidad'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Table::class;
    }
}
