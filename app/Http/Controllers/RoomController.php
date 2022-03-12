<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
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
}