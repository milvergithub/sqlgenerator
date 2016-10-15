<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TableApiTest extends TestCase
{
    use MakeTableTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateTable()
    {
        $table = $this->fakeTableData();
        $this->json('POST', '/api/v1/tables', $table);

        $this->assertApiResponse($table);
    }

    /**
     * @test
     */
    public function testReadTable()
    {
        $table = $this->makeTable();
        $this->json('GET', '/api/v1/tables/'.$table->id);

        $this->assertApiResponse($table->toArray());
    }

    /**
     * @test
     */
    public function testUpdateTable()
    {
        $table = $this->makeTable();
        $editedTable = $this->fakeTableData();

        $this->json('PUT', '/api/v1/tables/'.$table->id, $editedTable);

        $this->assertApiResponse($editedTable);
    }

    /**
     * @test
     */
    public function testDeleteTable()
    {
        $table = $this->makeTable();
        $this->json('DELETE', '/api/v1/tables/'.$table->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/tables/'.$table->id);

        $this->assertResponseStatus(404);
    }
}
