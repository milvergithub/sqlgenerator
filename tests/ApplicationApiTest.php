<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ApplicationApiTest extends TestCase
{
    use MakeApplicationTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateApplication()
    {
        $application = $this->fakeApplicationData();
        $this->json('POST', '/api/v1/applications', $application);

        $this->assertApiResponse($application);
    }

    /**
     * @test
     */
    public function testReadApplication()
    {
        $application = $this->makeApplication();
        $this->json('GET', '/api/v1/applications/'.$application->id);

        $this->assertApiResponse($application->toArray());
    }

    /**
     * @test
     */
    public function testUpdateApplication()
    {
        $application = $this->makeApplication();
        $editedApplication = $this->fakeApplicationData();

        $this->json('PUT', '/api/v1/applications/'.$application->id, $editedApplication);

        $this->assertApiResponse($editedApplication);
    }

    /**
     * @test
     */
    public function testDeleteApplication()
    {
        $application = $this->makeApplication();
        $this->json('DELETE', '/api/v1/applications/'.$application->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/applications/'.$application->id);

        $this->assertResponseStatus(404);
    }
}
