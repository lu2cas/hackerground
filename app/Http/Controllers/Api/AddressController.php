<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Models\Address;

class AddressController extends Controller
{
    private $address;

    /**
     * Constructor
     *
     * @param Address $address;
     * @return void
     */
    public function __construct(Address $address)
    {
        $this->address = $address;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $addresses = $this->address->paginate(10);
        return response()->json($addresses, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AddressRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AddressRequest $request)
    {
        $data = $request->all();
        try {
            $address = $this->address->create($data);
            return response()->json([
                'data' => [
                    'message' => 'Endereço criado com sucesso.'
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
            $address = $this->address->findOrFail($id);
            return response()->json([
                'data' => [$address]
            ], 200);
        } catch(\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AddressRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(AddressRequest $request, $id)
    {
        $data = $request->all();
        try {
            $address = $this->address->findOrFail($id);
            $address->update($data);
            return response()->json([
                'data' => [
                    'message' => 'Endereço atualizado com sucesso.'
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
            $address = $this->address->findOrFail($id);
            $address->delete();
            return response()->json([
                'data' => [
                    'message' => 'Endereço removido com sucesso.'
                ]
            ], 200);
        } catch(\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }
}
