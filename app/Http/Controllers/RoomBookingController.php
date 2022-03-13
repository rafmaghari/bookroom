<?php

namespace App\Http\Controllers;

use App\Domain\RoomBooking\Services\RoomAvailability;
use App\Http\Requests\RoomBookingRequest;
use App\Http\Requests\UpdateRoomBookingRequest;
use App\Models\RoomBooking;
use Illuminate\Http\Request;

class RoomBookingController extends BaseController
{
    public function store(RoomBookingRequest $request)
    {
        try {
            $roomAvailability = new RoomAvailability($request->room_id, $request->start, $request->end);
            $roomAvailability->check();
            $result = auth()->user()->roomBookings()->create($request->validated());
            return $this->sendResponse($result, 'Room booked successfully.');
        } catch (\Exception $e) {
            return $this->sendError(['message' => $e->getMessage()], 400);
        }
    }

    public function update(
        UpdateRoomBookingRequest $request,
        RoomBooking $roomBooking
      )
    {
        try {
            $roomAvailability = new RoomAvailability($request->room_id, $request->start, $request->end);
            $roomAvailability->check();
            $result = $roomBooking->update($request->validated());
            return $this->sendResponse($result, 'Room updated successfully.');
        } catch (\Exception $e) {
            return $this->sendError(['message' => $e->getMessage()], 400);
        }

    }

    public function destroy(RoomBooking $roomBooking)
    {
        try {
            $result = $roomBooking->delete();
            return $this->sendResponse($result, 'Room deleted successfully.');
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

    public function allBookingByDate(Request $request)
    {
        try {
            $result = (new RoomAvailability($request->room_id, $request->start, $request->end))->getData();
            return $this->sendResponse($result, 'Room updated successfully.');
        } catch (\Exception $e) {
            return $this->sendError(['message' => $e->getMessage()], 400);
        }
    }
}
