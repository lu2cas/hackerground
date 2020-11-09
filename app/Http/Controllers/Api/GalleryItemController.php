<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryItemRequest;
use App\Models\GalleryItem;

class GalleryItemController extends Controller
{
    private $galleryItem;

    /**
     * Constructor
     *
     * @param GalleryItem $galleryItem;
     * @return void
     */
    public function __construct(GalleryItem $galleryItem)
    {
        $this->galleryItem = $galleryItem;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $galleriesItems = $this->galleryItem->paginate(10);
        return response()->json($galleriesItems, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  GalleryItemRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(GalleryItemRequest $request)
    {
        $data = $request->all();
        try {
            $galleryItem = $this->galleryItem->create($data);
            return response()->json([
                'data' => [
                    'message' => 'Item de galeria criado com sucesso.'
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
            $galleryItem = $this->galleryItem->findOrFail($id);
            return response()->json([
                'data' => [$galleryItem]
            ], 200);
        } catch(\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  GalleryItemRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(GalleryItemRequest $request, $id)
    {
        $data = $request->all();
        try {
            $galleryItem = $this->galleryItem->findOrFail($id);
            $galleryItem->update($data);
            return response()->json([
                'data' => [
                    'message' => 'Item de galeria atualizado com sucesso.'
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
            $galleryItem = $this->galleryItem->findOrFail($id);
            $galleryItem->delete();
            return response()->json([
                'data' => [
                    'message' => 'Item de galeria removido com sucesso.'
                ]
            ], 200);
        } catch(\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }
}
