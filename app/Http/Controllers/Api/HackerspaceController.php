<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\HackerspaceRequest;
use App\Models\Hackerspace;

class HackerspaceController extends Controller
{
    private $hackerspace;

    public function __construct(Hackerspace $hackerspace) {
        $this->hackerspace = $hackerspace;
    }

    public function index() {
        $hackerspaces = $this->hackerspace->paginate(10);
        return response()->json($hackerspaces, 200);
    }

    public function show($id) {
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

    public function store(HackerspaceRequest $request) {
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

    public function update(HackerspaceRequest $request, $id) {
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

    public function destroy($id) {
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
}
