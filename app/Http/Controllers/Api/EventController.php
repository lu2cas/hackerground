<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\Event;

class EventController extends Controller
{
    private $event;

    /**
     * Constructor
     *
     * @param Event $event
     * @return void
     */
    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $events = $this->event->with('address')->paginate(10);
        return response()->json($events, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EventRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(EventRequest $request)
    {
        $data = $request->all();
        $user_keys = [
            'created_by' => 1,
            'updated_by' => 1
        ];
        try {
            $event = $this->event->create(array_merge($data, $user_keys));
            if ($request->has('address')) {
                // @todo Validate $data['address']
                $event->address()->create(array_merge($data['address'], $user_keys), $user_keys);
            }
            return response()->json([
                'data' => [
                    'message' => 'Evento criado com sucesso.'
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
            $event = $this->event->with('address')->findOrFail($id);
            return response()->json([
                'data' => [$event]
            ], 200);
        } catch(\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EventRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(EventRequest $request, $id)
    {
        $data = $request->all();
        if ($request->has('hackerspace_id')) {
            unset($data['hackerspace_id']);
        }
        try {
            $event = $this->event->findOrFail($id);
            $event->update(array_merge($data, ['updated_by' => 1]));
            if ($request->has('address')) {
                // @todo Validate $data['address']
                $address = $event->address();
                if ($address->exists()) {
                    $address->first()->update(array_merge($data['address'], ['updated_by' => 1]));
                } else {
                    $user_keys = [
                        'created_by' => 1,
                        'updated_by' => 1
                    ];
                    $event->address()->create(array_merge($data['address'], $user_keys), $user_keys);
                }
            }
            return response()->json([
                'data' => [
                    'message' => 'Evento atualizado com sucesso.'
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
            $event = $this->event->findOrFail($id);
            if ($event->address()->exists()) {
                $address = $event->address()->first();
                $event->address()->detach();
                $address->delete();
            }
            $event->delete();
            return response()->json([
                'data' => [
                    'message' => 'Evento removido com sucesso.'
                ]
            ], 200);
        } catch(\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }
}
