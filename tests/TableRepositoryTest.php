<?php

use App\Models\Table;
use App\Repositories\TableRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TableRepositoryTest extends TestCase
{
    use MakeTableTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var TableRepository
     */
    protected $tableRepo;

    public function setUp()
    {
        parent::setUp();
        $this->tableRepo = App::make(TableRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateTable()
    {
        $table = $this->fakeTableData();
        $createdTable = $this->tableRepo->create($table);
        $createdTable = $createdTable->toArray();
        $this->assertArrayHasKey('id', $createdTable);
        $this->assertNotNull($createdTable['id'], 'Created Table must have id specified');
        $this->assertNotNull(Table::find($createdTable['id']), 'Table with given id must be in DB');
        $this->assertModelData($table, $createdTable);
    }

    /**
     * @test read
     */
    public function testReadTable()
    {
        $table = $this->makeTable();
        $dbTable = $this->tableRepo->find($table->id);
        $dbTable = $dbTable->toArray();
        $this->assertModelData($table->toArray(), $dbTable);
    }

    /**
     * @test update
     */
    public function testUpdateTable()
    {
        $table = $this->makeTable();
        $fakeTable = $this->fakeTableData();
        $updatedTable = $this->tableRepo->update($fakeTable, $table->id);
        $this->assertModelData($fakeTable, $updatedTable->toArray());
        $dbTable = $this->tableRepo->find($table->id);
        $this->assertModelData($fakeTable, $dbTable->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteTable()
    {
        $table = $this->makeTable();
        $resp = $this->tableRepo->delete($table->id);
        $this->assertTrue($resp);
        $this->assertNull(Table::find($table->id), 'Table should not exist in DB');
    }
}
