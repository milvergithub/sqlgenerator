<?php

use Faker\Factory as Faker;
use App\Models\Application;
use App\Repositories\ApplicationRepository;

trait MakeApplicationTrait
{
    /**
     * Create fake instance of Application and save it in database
     *
     * @param array $applicationFields
     * @return Application
     */
    public function makeApplication($applicationFields = [])
    {
        /** @var ApplicationRepository $applicationRepo */
        $applicationRepo = App::make(ApplicationRepository::class);
        $theme = $this->fakeApplicationData($applicationFields);
        return $applicationRepo->create($theme);
    }

    /**
     * Get fake instance of Application
     *
     * @param array $applicationFields
     * @return Application
     */
    public function fakeApplication($applicationFields = [])
    {
        return new Application($this->fakeApplicationData($applicationFields));
    }

    /**
     * Get fake data of Application
     *
     * @param array $postFields
     * @return array
     */
    public function fakeApplicationData($applicationFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'driver' => $fake->word,
            'schema' => $fake->word,
            'database' => $fake->word,
            'host' => $fake->word,
            'port' => $fake->randomDigitNotNull,
            'username' => $fake->word,
            'password' => $fake->word,
            'date_created' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $applicationFields);
    }
}
