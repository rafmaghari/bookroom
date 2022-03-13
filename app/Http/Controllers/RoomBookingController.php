<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomBookingRequest;
use App\Http\Requests\UpdateRoomBookingRequest;
use App\Models\RoomBooking;

class RoomBookingController extends BaseController
{
    public function store(RoomBookingRequest $request)
    {
        try {
            $result = auth()->user()->roomBookings()->create($request->validated());
            return $this->sendResponse($result, 'Room booked successfully.');
        } catch (\Exception $e) {
            return $this->sendError(['message' => $e->getMessage()], 400);
        }
    }

    public function update(UpdateRoomBookingRequest $request, RoomBooking $roomBooking)
    {
        try {
            $result = $roomBooking->update($request->validated());
            return $this->sendResponse($result, 'Room updated successfully.');
        } catch (\Exception $e) {
            return $this->sendError(['message' => $e->getMessage()], 400);
        }

    }

    public function show($id)
    {
        try {
            $result = RoomBooking::where('id',$id)->with('user', 'room')->first();
            return $this->sendResponse($result, 'Room updated successfully.');
        } catch (\Exception $e) {
            return $this->sendError(['message' => $e->getMessage()], 400);
        }
    }

    public function myBookings()
    {
        try {
            $result = auth()->user()->roomBookings()->with('user', 'room')->get();
            return $this->sendResponse($result, 'Room updated successfully.');
        } catch (\Exception $e) {
            return $this->sendError(['message' => $e->getMessage()], 400);
        }
    }
}
