<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Http\Requests\RoomRequest;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends BaseController
{
    public function index()
    {
        try {
            $rooms = Room::all();
            return $this->sendResponse($rooms, 'Room fetched successfully');
        } catch (\Exception $e) {
            return $this->sendError(['message' => $e->getMessage()], 400);
        }

    }

    public function show(Room $room)
    {
        try {
            return $this->sendResponse($room, 'Room fetched successfully');
        } catch (\Exception $e) {
            return $this->sendError(['message' => $e->getMessage()], 400);
        }

    }

    public function store(RoomRequest $request)
    {
        try {
            $result = Room::create($request->validated());
            return $this->sendResponse($result, 'Room added successfully');
        } catch (\Exception $e) {
            return $this->sendError(['message' => $e->getMessage()], 400);
        }
    }

    public function update(RoomRequest $request, Room $room)
    {
        try {
            $result = $room->update($request->validated());
            return $this->sendResponse($result, 'Room updated successfully');
        } catch (\Exception $e) {
            return $this->sendError(['message' => $e->getMessage()], 400);
        }

    }

    public function destroy(Room $room)
    {
        try {
            $result = $room->delete();
            return $this->sendResponse($result, 'Room deleted successfully');
        } catch (\Exception $e) {
            return $this->sendError(['message' => $e->getMessage()], 400);
        }

    }
}
