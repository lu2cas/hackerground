<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\BlogPostRequest;
use App\Models\BlogPost;

class BlogPostController extends Controller
{
    private $blogPost;

    /**
     * Constructor
     *
     * @param BlogPost $blogPost
     * @return void
     */
    public function __construct(BlogPost $blogPost)
    {
        $this->blogPost = $blogPost;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $blogPosts = $this->blogPost->paginate(10);
        return response()->json($blogPosts, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BlogPostRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(BlogPostRequest $request)
    {
        $data = $request->all();
        $user_keys = [
            'created_by' => 1,
            'updated_by' => 1
        ];
        try {
            $blogPost = $this->blogPost->create(array_merge($data, $user_keys));
            return response()->json([
                'data' => [
                    'message' => 'Postagem criada com sucesso.'
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
            $blogPost = $this->blogPost->findOrFail($id);
            return response()->json([
                'data' => [$blogPost]
            ], 200);
        } catch(\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BlogPostRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(BlogPostRequest $request, $id)
    {
        $data = $request->all();
        if ($request->has('hackerspace_id')) {
            unset($data['hackerspace_id']);
        }
        try {
            $blogPost = $this->blogPost->findOrFail($id);
            $blogPost->update(array_merge($data, ['updated_by' => 1]));
            return response()->json([
                'data' => [
                    'message' => 'Postagem atualizada com sucesso.'
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
            $blogPost = $this->blogPost->findOrFail($id);
            $blogPost->delete();
            return response()->json([
                'data' => [
                    'message' => 'Postagem removida com sucesso.'
                ]
            ], 200);
        } catch(\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }
}
