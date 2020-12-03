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
        $hackerspaces = $this->hackerspace->with('address')->paginate(10);
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
        $user_keys = [
            'created_by' => 1,
            'updated_by' => 1
        ];
        try {
            $hackerspace = $this->hackerspace->create(array_merge($data, $user_keys));
            if ($request->has('address')) {
                // @todo Validate $data['address']
                $hackerspace->address()->create(array_merge($data['address'], $user_keys), $user_keys);
            }
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
            $hackerspace = $this->hackerspace->with('address')->findOrFail($id);
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
            $hackerspace->update(array_merge($data, ['updated_by' => 1]));
            if ($request->has('address')) {
                // @todo Validate $data['address']
                $address = $hackerspace->address();
                if ($address->exists()) {
                    $address->first()->update(array_merge($data['address'], ['updated_by' => 1]));
                } else {
                    $user_keys = [
                        'created_by' => 1,
                        'updated_by' => 1
                    ];
                    $hackerspace->address()->create(array_merge($data['address'], $user_keys), $user_keys);
                }
            }
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
            if ($hackerspace->address()->exists()) {
                $address = $hackerspace->address()->first();
                $hackerspace->address()->detach();
                $address->delete();
            }
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
            return response()->json($events, 200);
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
    public function projects($id)
    {
        try {
            $hackerspace = $this->hackerspace->findOrFail($id);
            $projects = $hackerspace->project()->paginate(10);
            return response()->json($projects, 200);
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
    public function blogPosts($id)
    {
        try {
            $hackerspace = $this->hackerspace->findOrFail($id);
            $blogPosts = $hackerspace->blogPost()->paginate(10);
            return response()->json($blogPosts, 200);
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
    public function pressMentions($id)
    {
        try {
            $hackerspace = $this->hackerspace->findOrFail($id);
            $pressMentions = $hackerspace->pressMention()->paginate(10);
            return response()->json($pressMentions, 200);
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
    public function inventoryItems($id)
    {
        try {
            $hackerspace = $this->hackerspace->findOrFail($id);
            $inventoryItems = $hackerspace->inventoryItem()->paginate(10);
            return response()->json($inventoryItems, 200);
        } catch(\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }
}
