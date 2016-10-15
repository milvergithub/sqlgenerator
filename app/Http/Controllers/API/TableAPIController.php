<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTableAPIRequest;
use App\Http\Requests\API\UpdateTableAPIRequest;
use App\Models\Table;
use App\Repositories\TableRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class TableController
 * @package App\Http\Controllers\API
 */

class TableAPIController extends AppBaseController
{
    /** @var  TableRepository */
    private $tableRepository;

    public function __construct(TableRepository $tableRepo)
    {
        $this->tableRepository = $tableRepo;
    }

    /**
     * Display a listing of the Table.
     * GET|HEAD /tables
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->tableRepository->pushCriteria(new RequestCriteria($request));
        $this->tableRepository->pushCriteria(new LimitOffsetCriteria($request));
        $tables = $this->tableRepository->all();

        return $this->sendResponse($tables->toArray(), 'Tables retrieved successfully');
    }

    /**
     * Store a newly created Table in storage.
     * POST /tables
     *
     * @param CreateTableAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTableAPIRequest $request)
    {
        $input = $request->all();

        $tables = $this->tableRepository->create($input);

        return $this->sendResponse($tables->toArray(), 'Table saved successfully');
    }

    /**
     * Display the specified Table.
     * GET|HEAD /tables/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Table $table */
        $table = $this->tableRepository->findWithoutFail($id);

        if (empty($table)) {
            return $this->sendError('Table not found');
        }

        return $this->sendResponse($table->toArray(), 'Table retrieved successfully');
    }

    /**
     * Update the specified Table in storage.
     * PUT/PATCH /tables/{id}
     *
     * @param  int $id
     * @param UpdateTableAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTableAPIRequest $request)
    {
        $input = $request->all();

        /** @var Table $table */
        $table = $this->tableRepository->findWithoutFail($id);

        if (empty($table)) {
            return $this->sendError('Table not found');
        }

        $table = $this->tableRepository->update($input, $id);

        return $this->sendResponse($table->toArray(), 'Table updated successfully');
    }

    /**
     * Remove the specified Table from storage.
     * DELETE /tables/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Table $table */
        $table = $this->tableRepository->findWithoutFail($id);

        if (empty($table)) {
            return $this->sendError('Table not found');
        }

        $table->delete();

        return $this->sendResponse($id, 'Table deleted successfully');
    }
}
