<?php

use App\Models\Column;
use App\Repositories\ColumnRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ColumnRepositoryTest extends TestCase
{
    use MakeColumnTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ColumnRepository
     */
    protected $columnRepo;

    public function setUp()
    {
        parent::setUp();
        $this->columnRepo = App::make(ColumnRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateColumn()
    {
        $column = $this->fakeColumnData();
        $createdColumn = $this->columnRepo->create($column);
        $createdColumn = $createdColumn->toArray();
        $this->assertArrayHasKey('id', $createdColumn);
        $this->assertNotNull($createdColumn['id'], 'Created Column must have id specified');
        $this->assertNotNull(Column::find($createdColumn['id']), 'Column with given id must be in DB');
        $this->assertModelData($column, $createdColumn);
    }

    /**
     * @test read
     */
    public function testReadColumn()
    {
        $column = $this->makeColumn();
        $dbColumn = $this->columnRepo->find($column->id);
        $dbColumn = $dbColumn->toArray();
        $this->assertModelData($column->toArray(), $dbColumn);
    }

    /**
     * @test update
     */
    public function testUpdateColumn()
    {
        $column = $this->makeColumn();
        $fakeColumn = $this->fakeColumnData();
        $updatedColumn = $this->columnRepo->update($fakeColumn, $column->id);
        $this->assertModelData($fakeColumn, $updatedColumn->toArray());
        $dbColumn = $this->columnRepo->find($column->id);
        $this->assertModelData($fakeColumn, $dbColumn->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteColumn()
    {
        $column = $this->makeColumn();
        $resp = $this->columnRepo->delete($column->id);
        $this->assertTrue($resp);
        $this->assertNull(Column::find($column->id), 'Column should not exist in DB');
    }
}
