<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateApplicationAPIRequest;
use App\Http\Requests\API\UpdateApplicationAPIRequest;
use App\Models\Application;
use App\Repositories\ApplicationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ApplicationController
 * @package App\Http\Controllers\API
 */

class ApplicationAPIController extends AppBaseController
{
    /** @var  ApplicationRepository */
    private $applicationRepository;

    public function __construct(ApplicationRepository $applicationRepo)
    {
        $this->applicationRepository = $applicationRepo;
    }

    /**
     * Display a listing of the Application.
     * GET|HEAD /applications
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->applicationRepository->pushCriteria(new RequestCriteria($request));
        $this->applicationRepository->pushCriteria(new LimitOffsetCriteria($request));
        $applications = $this->applicationRepository->paginate(10);
        return $this->sendResponse($applications->toArray(), trans('messages.application.list'),true);
    }

    /**
     * Store a newly created Application in storage.
     * POST /applications
     *
     * @param CreateApplicationAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateApplicationAPIRequest $request)
    {
        $input = $request->all();

        $applications = $this->applicationRepository->create($input);

        return $this->sendResponse($applications->toArray(), trans('messages.application.saved'));
    }

    /**
     * Display the specified Application.
     * GET|HEAD /applications/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Application $application */
        $application = $this->applicationRepository->findWithoutFail($id);

        if (empty($application)) {
            return $this->sendError('Application not found');
        }

        return $this->sendResponse($application->toArray(), 'Application retrieved successfully');
    }

    /**
     * Update the specified Application in storage.
     * PUT/PATCH /applications/{id}
     *
     * @param  int $id
     * @param UpdateApplicationAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateApplicationAPIRequest $request)
    {
        $input = $request->all();

        /** @var Application $application */
        $application = $this->applicationRepository->findWithoutFail($id);

        if (empty($application)) {
            return $this->sendError('Application not found');
        }

        $application = $this->applicationRepository->update($input, $id);

        return $this->sendResponse($application->toArray(), 'Application updated successfully');
    }

    /**
     * Remove the specified Application from storage.
     * DELETE /applications/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Application $application */
        $application = $this->applicationRepository->findWithoutFail($id);

        if (empty($application)) {
            return $this->sendError('Application not found');
        }

        $application->delete();

        return $this->sendResponse($id, 'Application deleted successfully');
    }
}
