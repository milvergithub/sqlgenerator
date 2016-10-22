<?php

use Faker\Factory as Faker;
use App\Models\Column;
use App\Repositories\ColumnRepository;

trait MakeColumnTrait
{
    /**
     * Create fake instance of Column and save it in database
     *
     * @param array $columnFields
     * @return Column
     */
    public function makeColumn($columnFields = [])
    {
        /** @var ColumnRepository $columnRepo */
        $columnRepo = App::make(ColumnRepository::class);
        $theme = $this->fakeColumnData($columnFields);
        return $columnRepo->create($theme);
    }

    /**
     * Get fake instance of Column
     *
     * @param array $columnFields
     * @return Column
     */
    public function fakeColumn($columnFields = [])
    {
        return new Column($this->fakeColumnData($columnFields));
    }

    /**
     * Get fake data of Column
     *
     * @param array $postFields
     * @return array
     */
    public function fakeColumnData($columnFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'column_name' => $fake->word,
            'data_type' => $fake->word,
            'character_maximum_length' => $fake->word,
            'is_foreing' => $fake->word,
            'referencian' => $fake->word,
            'tabla' => $fake->word,
            'referenciados' => $fake->word,
            'numeric_precision' => $fake->word,
            'is_nullable' => $fake->word,
            'constraint_type' => $fake->word,
            'column_default' => $fake->word,
            'check_clause' => $fake->word,
            'filled' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $columnFields);
    }
}
