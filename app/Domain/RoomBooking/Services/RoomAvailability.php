<?php


namespace App\Domain\RoomBooking\Services;


use App\Models\RoomBooking;

class RoomAvailability
{
    private $roomId;
    private $start;
    private $end;

    public function __construct($roomId, $start, $end)
    {
        $this->roomId = $roomId;
        $this->start = $start;
        $this->end = $end;
    }

    public function getData()
    {
        return RoomBooking::query()
            ->where('room_id', $this->roomId)
            ->where('start', '>=', $this->start)
            ->where('end', '<=', $this->end)
            ->first();
    }

    public function check()
    {
        if ($this->start > $this->end) {
            throw new \Exception('Start time should not be greater that end time.');
        }

        $booking = $this->getData();

        if (!empty($booking)) {
            throw new \Exception('This room is already booked');
        }
    }


}
