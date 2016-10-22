<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ColumnApiTest extends TestCase
{
    use MakeColumnTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateColumn()
    {
        $column = $this->fakeColumnData();
        $this->json('POST', '/api/v1/columns', $column);

        $this->assertApiResponse($column);
    }

    /**
     * @test
     */
    public function testReadColumn()
    {
        $column = $this->makeColumn();
        $this->json('GET', '/api/v1/columns/'.$column->id);

        $this->assertApiResponse($column->toArray());
    }

    /**
     * @test
     */
    public function testUpdateColumn()
    {
        $column = $this->makeColumn();
        $editedColumn = $this->fakeColumnData();

        $this->json('PUT', '/api/v1/columns/'.$column->id, $editedColumn);

        $this->assertApiResponse($editedColumn);
    }

    /**
     * @test
     */
    public function testDeleteColumn()
    {
        $column = $this->makeColumn();
        $this->json('DELETE', '/api/v1/columns/'.$column->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/columns/'.$column->id);

        $this->assertResponseStatus(404);
    }
}
