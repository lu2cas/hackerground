<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $users = $this->user->paginate(10);
        return response()->json($users, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();
        if (!$request->has('password') || !$request->get('password')) {
            return response()->json('O campo senha é obrigatório.', 401);
        }
        try {
            $data['password'] = bcrypt($data['password']);
            $user = $this->user->create($data);
            return response()->json([
                'data' => [
                    'message' => 'Usuário criado com sucesso.'
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
            $user = $this->user->findOrFail($id);
            return response()->json([
                'data' => [$user]
            ], 200);
        } catch(\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserRequest $request, $id)
    {
        $data = $request->all();
        if ($request->has('password') && $request->get('password')) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        try {
            $user = $this->user->findOrFail($id);
            $user->update($data);
            return response()->json([
                'data' => [
                    'message' => 'Usuário atualizado com sucesso.'
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
            $user = $this->user->findOrFail($id);
            $user->delete();
            return response()->json([
                'data' => [
                    'message' => 'Usuário removido com sucesso.'
                ]
            ], 200);
        } catch(\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }
}
