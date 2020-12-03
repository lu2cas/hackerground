<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\PressMentionRequest;
use App\Models\PressMention;

class PressMentionController extends Controller
{
    private $pressMention;

    /**
     * Constructor
     *
     * @param PressMention $pressMention
     * @return void
     */
    public function __construct(PressMention $pressMention)
    {
        $this->pressMention = $pressMention;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $pressMentions = $this->pressMention->paginate(10);
        return response()->json($pressMentions, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PressMentionRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PressMentionRequest $request)
    {
        $data = $request->all();
        $user_keys = [
            'created_by' => 1,
            'updated_by' => 1
        ];
        try {
            $pressMention = $this->pressMention->create(array_merge($data, $user_keys));
            return response()->json([
                'data' => [
                    'message' => 'Menção na imprensa criada com sucesso.'
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
            $pressMention = $this->pressMention->findOrFail($id);
            return response()->json([
                'data' => [$pressMention]
            ], 200);
        } catch(\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PressMentionRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PressMentionRequest $request, $id)
    {
        $data = $request->all();
        if ($request->has('hackerspace_id')) {
            unset($data['hackerspace_id']);
        }
        try {
            $pressMention = $this->pressMention->findOrFail($id);
            $pressMention->update(array_merge($data, ['updated_by' => 1]));
            return response()->json([
                'data' => [
                    'message' => 'Menção na imprensa atualizada com sucesso.'
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
            $pressMention = $this->pressMention->findOrFail($id);
            $pressMention->delete();
            return response()->json([
                'data' => [
                    'message' => 'Menção na imprensa removida com sucesso.'
                ]
            ], 200);
        } catch(\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }
}
