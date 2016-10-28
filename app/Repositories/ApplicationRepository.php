<?php

namespace App\Repositories;

use App\Models\Application;
use InfyOm\Generator\Common\BaseRepository;

class ApplicationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'driver',
        'schema',
        'database',
        'host',
        'port',
        'username',
        'password',
        'date_created',
        'user_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Application::class;
    }
}
