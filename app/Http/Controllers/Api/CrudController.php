<?php

namespace App\Http\Controllers\Api;

use App\Domains\Common\Model;
use App\Domains\Common\RepositoryInterface;;
use App\Exceptions\ErrorResourceIsGone;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class CrudController
 * @package App\Http\Controllers\Api
 */
abstract class CrudController extends ApiController implements CrudControllerInterface
{
    /**
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * @var Request
     */
    protected $request;

    /**
     * CrudController constructor.
     * @param RepositoryInterface $repository
     * @param Request $request [null]
     */
    public function __construct(RepositoryInterface $repository, Request $request = null)
    {
        $this->repository = $repository;
        $this->request = $request;
    }

    /**
     * @return JsonResponse
     */
    public function search(): JsonResponse
    {
        $filters = [];
        $read = $this->repository->read($filters);
        return $this->answerSuccess([
            'rows' => $read
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $data = [];
        foreach ($this->repository->fillable() as $field) {
            $value = $request->input($field);
            if (is_null($value)) {
                continue;
            }
            $data[$field] = $value;
        }

        if (!$data) {
            return $this->answerFail(['payload' => 'empty']);
        }

        $created = $this->repository->create($data);

        return $this->answerSuccess($created);
    }

    /**
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     * @throws ErrorResourceIsGone
     */
    public function read(Request $request, string $id): JsonResponse
    {
        $filters = $this->filterById($id);

        $read = $this->repository->read($filters);

        $data = $read->first();
        if (is_null($data)) {
            throw new ErrorResourceIsGone(['id' => $id]);
        }
        return $this->answerSuccess($data);
    }

    /**
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     * @throws ErrorResourceIsGone
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $filters = $this->filterById($id);

        $read = $this->repository->read($filters);
        $instance = $read->first();
        if (is_null($instance)) {
            throw new ErrorResourceIsGone(['id' => $id]);
        }

        $data = [];
        foreach ($this->repository->fillable() as $field) {
            $value = $request->input($field);
            if (is_null($value)) {
                continue;
            }
            $data[$field] = $value;
        }

        if (!$data) {
            return $this->answerFail(['payload' => 'empty']);
        }

        /** @fix */
        if ($instance->fill($data)->save()) {
            return $this->answerSuccess($instance);
        }
        return $this->answerFail($instance);
    }

    /**
     * @param Request $request
     * @param string $id
     * @return JsonResponse
     * @throws ErrorResourceIsGone
     */
    public function delete(Request $request, string $id): JsonResponse
    {
        $filters = $this->filterById($id);

        $read = $this->repository->read($filters);
        $instance = $read->first();
        if (is_null($instance)) {
            throw new ErrorResourceIsGone(['id' => $id]);
        }

        /** @fix */
        if ($instance->destroy(Model::encodeUuid($id))) {
            return $this->answerSuccess($instance);
        }
        return $this->answerFail($instance);
    }

    /**
     * @param string $id
     * @return array
     */
    private function filterById(string $id)
    {
        $key = $this->repository->referenceKey();
        return [
            $key => Model::encodeUuid($id)
        ];
    }
}
