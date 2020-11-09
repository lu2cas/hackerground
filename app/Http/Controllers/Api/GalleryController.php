<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryRequest;
use App\Models\Gallery;

class GalleryController extends Controller
{
    private $gallery;

    /**
     * Constructor
     *
     * @param Gallery $gallery;
     * @return void
     */
    public function __construct(Gallery $gallery)
    {
        $this->gallery = $gallery;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $galleries = $this->gallery->paginate(10);
        return response()->json($galleries, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  GalleryRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(GalleryRequest $request)
    {
        $data = $request->all();
        try {
            $gallery = $this->gallery->create($data);
            return response()->json([
                'data' => [
                    'message' => 'Galeria criada com sucesso.'
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
            $gallery = $this->gallery->findOrFail($id);
            return response()->json([
                'data' => [$gallery]
            ], 200);
        } catch(\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  GalleryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(GalleryRequest $request, $id)
    {
        $data = $request->all();
        try {
            $gallery = $this->gallery->findOrFail($id);
            $gallery->update($data);
            return response()->json([
                'data' => [
                    'message' => 'Galeria atualizada com sucesso.'
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
            $gallery = $this->gallery->findOrFail($id);
            $gallery->delete();
            return response()->json([
                'data' => [
                    'message' => 'Galeria removida com sucesso.'
                ]
            ], 200);
        } catch(\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }
}
