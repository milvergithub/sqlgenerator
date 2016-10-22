<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateColumnAPIRequest;
use App\Http\Requests\API\UpdateColumnAPIRequest;
use App\Models\Column;
use App\Repositories\ColumnRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ColumnController
 * @package App\Http\Controllers\API
 */

class ColumnAPIController extends AppBaseController
{
    /** @var  ColumnRepository */
    private $columnRepository;

    public function __construct(ColumnRepository $columnRepo)
    {
        $this->columnRepository = $columnRepo;
    }

    /**
     * Display a listing of the Column.
     * GET|HEAD /columns
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->columnRepository->pushCriteria(new RequestCriteria($request));
        $this->columnRepository->pushCriteria(new LimitOffsetCriteria($request));
        $columns = $this->columnRepository->all();

        return $this->sendResponse($columns->toArray(), 'Columns retrieved successfully');
    }

    /**
     * Store a newly created Column in storage.
     * POST /columns
     *
     * @param CreateColumnAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateColumnAPIRequest $request)
    {
        $input = $request->all();

        $columns = $this->columnRepository->create($input);

        return $this->sendResponse($columns->toArray(), 'Column saved successfully');
    }

    /**
     * Display the specified Column.
     * GET|HEAD /columns/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Column $column */
        $column = $this->columnRepository->findWithoutFail($id);

        if (empty($column)) {
            return $this->sendError('Column not found');
        }

        return $this->sendResponse($column->toArray(), 'Column retrieved successfully');
    }

    /**
     * Update the specified Column in storage.
     * PUT/PATCH /columns/{id}
     *
     * @param  int $id
     * @param UpdateColumnAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateColumnAPIRequest $request)
    {
        $input = $request->all();

        /** @var Column $column */
        $column = $this->columnRepository->findWithoutFail($id);

        if (empty($column)) {
            return $this->sendError('Column not found');
        }

        $column = $this->columnRepository->update($input, $id);

        return $this->sendResponse($column->toArray(), 'Column updated successfully');
    }

    /**
     * Remove the specified Column from storage.
     * DELETE /columns/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Column $column */
        $column = $this->columnRepository->findWithoutFail($id);

        if (empty($column)) {
            return $this->sendError('Column not found');
        }

        $column->delete();

        return $this->sendResponse($id, 'Column deleted successfully');
    }
}
