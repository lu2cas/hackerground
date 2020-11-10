<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectUpdateRequest;
use App\Models\ProjectUpdate;

class ProjectUpdateController extends Controller
{
    private $projectUpdate;

    /**
     * Constructor
     *
     * @param ProjectUpdate $projectUpdate;
     * @return void
     */
    public function __construct(ProjectUpdate $projectUpdate)
    {
        $this->projectUpdate = $projectUpdate;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $projectUpdates = $this->projectUpdate->paginate(10);
        return response()->json($projectUpdates, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProjectUpdateRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProjectUpdateRequest $request)
    {
        $data = $request->all();
        try {
            $projectUpdate = $this->projectUpdate->create($data);
            return response()->json([
                'data' => [
                    'message' => 'Atualização de projeto criada com sucesso.'
                ]
            ], 200);
        } catch(\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $projectUpdate = $this->projectUpdate->findOrFail($id);
            return response()->json([
                'data' => [$projectUpdate]
            ], 200);
        } catch(\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProjectUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProjectUpdateRequest $request, $id)
    {
        $data = $request->all();
        try {
            $projectUpdate = $this->projectUpdate->findOrFail($id);
            $projectUpdate->update($data);
            return response()->json([
                'data' => [
                    'message' => 'Atualização de projeto atualizada com sucesso.'
                ]
            ], 200);
        } catch(\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $projectUpdate = $this->projectUpdate->findOrFail($id);
            $projectUpdate->delete();
            return response()->json([
                'data' => [
                    'message' => 'Atualização de projeto removida com sucesso.'
                ]
            ], 200);
        } catch(\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }
}
