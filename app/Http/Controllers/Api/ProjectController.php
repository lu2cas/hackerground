<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;

class ProjectController extends Controller
{
    private $project;

    /**
     * Constructor
     *
     * @param Project $project
     * @return void
     */
    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $projects = $this->project->paginate(10);
        return response()->json($projects, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProjectRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProjectRequest $request)
    {
        $data = $request->all();
        $user_keys = [
            'created_by' => 1,
            'updated_by' => 1
        ];
        try {
            $project = $this->project->create(array_merge($data, $user_keys));
            return response()->json([
                'data' => [
                    'message' => 'Projeto criado com sucesso.'
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
            $project = $this->project->with('projectUpdate')->findOrFail($id);
            return response()->json([
                'data' => [$project]
            ], 200);
        } catch(\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProjectRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProjectRequest $request, $id)
    {
        $data = $request->all();
        if ($request->has('hackerspace_id')) {
            unset($data['hackerspace_id']);
        }
        try {
            $project = $this->project->findOrFail($id);
            $project->update(array_merge($data, ['updated_by' => 1]));
            return response()->json([
                'data' => [
                    'message' => 'Projeto atualizado com sucesso.'
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
            $project = $this->project->findOrFail($id);
            $project->delete();
            return response()->json([
                'data' => [
                    'message' => 'Projeto removido com sucesso.'
                ]
            ], 200);
        } catch(\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }
}
