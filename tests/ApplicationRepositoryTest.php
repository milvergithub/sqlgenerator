<?php

use App\Models\Application;
use App\Repositories\ApplicationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApplicationRepositoryTest extends TestCase
{
    use MakeApplicationTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ApplicationRepository
     */
    protected $applicationRepo;

    public function setUp()
    {
        parent::setUp();
        $this->applicationRepo = App::make(ApplicationRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateApplication()
    {
        $application = $this->fakeApplicationData();
        $createdApplication = $this->applicationRepo->create($application);
        $createdApplication = $createdApplication->toArray();
        $this->assertArrayHasKey('id', $createdApplication);
        $this->assertNotNull($createdApplication['id'], 'Created Application must have id specified');
        $this->assertNotNull(Application::find($createdApplication['id']), 'Application with given id must be in DB');
        $this->assertModelData($application, $createdApplication);
    }

    /**
     * @test read
     */
    public function testReadApplication()
    {
        $application = $this->makeApplication();
        $dbApplication = $this->applicationRepo->find($application->id);
        $dbApplication = $dbApplication->toArray();
        $this->assertModelData($application->toArray(), $dbApplication);
    }

    /**
     * @test update
     */
    public function testUpdateApplication()
    {
        $application = $this->makeApplication();
        $fakeApplication = $this->fakeApplicationData();
        $updatedApplication = $this->applicationRepo->update($fakeApplication, $application->id);
        $this->assertModelData($fakeApplication, $updatedApplication->toArray());
        $dbApplication = $this->applicationRepo->find($application->id);
        $this->assertModelData($fakeApplication, $dbApplication->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteApplication()
    {
        $application = $this->makeApplication();
        $resp = $this->applicationRepo->delete($application->id);
        $this->assertTrue($resp);
        $this->assertNull(Application::find($application->id), 'Application should not exist in DB');
    }
}
