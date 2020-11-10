<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\InventoryItemRequest;
use App\Models\InventoryItem;

class InventoryItemController extends Controller
{
    private $inventoryItem;

    /**
     * Constructor
     *
     * @param InventoryItem $InventoryItem;
     * @return void
     */
    public function __construct(InventoryItem $inventoryItem)
    {
        $this->inventoryItem = $inventoryItem;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $inventoryItems = $this->inventoryItem->paginate(10);
        return response()->json($inventoryItems, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  InventoryItemRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(InventoryItemRequest $request)
    {
        $data = $request->all();
        try {
            $inventoryItem = $this->inventoryItem->create($data);
            return response()->json([
                'data' => [
                    'message' => 'Item de inventário criado com sucesso.'
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
            $inventoryItem = $this->inventoryItem->findOrFail($id);
            return response()->json([
                'data' => [$inventoryItem]
            ], 200);
        } catch(\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  InventoryItemRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(InventoryItemRequest $request, $id)
    {
        $data = $request->all();
        try {
            $inventoryItem = $this->inventoryItem->findOrFail($id);
            $inventoryItem->update($data);
            return response()->json([
                'data' => [
                    'message' => 'Item de inventário atualizado com sucesso.'
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
            $inventoryItem = $this->inventoryItem->findOrFail($id);
            $inventoryItem->delete();
            return response()->json([
                'data' => [
                    'message' => 'Item de inventário removido com sucesso.'
                ]
            ], 200);
        } catch(\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }
}
