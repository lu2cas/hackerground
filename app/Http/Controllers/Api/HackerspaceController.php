<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Models\Hackerspace;
use App\Http\Requests\HackerspaceRequest;

class HackerspaceController extends Controller
{
    private $hackerspace;

    /**
     * Constructor
     *
     * @param Hackerspace $hackerspace
     * @return void
     */
    public function __construct(Hackerspace $hackerspace)
    {
        $this->hackerspace = $hackerspace;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $hackerspaces = $this->hackerspace->paginate(10);
        return response()->json($hackerspaces, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param HackerspaceRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(HackerspaceRequest $request)
    {
        $data = $request->all();
        try {
            $hackerspace = $this->hackerspace->create($data);
            return response()->json([
                'data' => [
                    'message' => 'Hackerspace criado com sucesso.'
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
            $hackerspace = $this->hackerspace->findOrFail($id);
            return response()->json([
                'data' => [$hackerspace]
            ], 200);
        } catch(\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  HackerspaceRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(HackerspaceRequest $request, $id)
    {
        $data = $request->all();
        try {
            $hackerspace = $this->hackerspace->findOrFail($id);
            $hackerspace->update($data);
            return response()->json([
                'data' => [
                    'message' => 'Hackerspace atualizado com sucesso.'
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
            $hackerspace = $this->hackerspace->findOrFail($id);
            $hackerspace->delete();
            return response()->json([
                'data' => [
                    'message' => 'Hackerspace removido com sucesso.'
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
    public function events($id)
    {
        try {
            $hackerspace = $this->hackerspace->findOrFail($id);
            $events = $hackerspace->event()->paginate(10);
            return response()->json([
                'data' => [$events]
            ], 200);
        } catch(\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }
}
