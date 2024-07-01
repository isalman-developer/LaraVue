<?php

namespace App\Http\Controllers\Admin;

use App\Models\Appointment;
use App\Enums\AppointmentStatus;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AppointmentController extends Controller
{

    /**
     * function to fetch latest appointments
     *
     * @return LengthAwarePaginator
     */
    public function index()
    {
        return Appointment::query()
            ->with('client')->latest()
            ->when(request('status'), fn ($query) => $query->where('status', request('status')))
            ->paginate()
            ->through(fn ($appointment) => [
                'id' => $appointment->id,
                'title' => $appointment->title,
                'description' => $appointment->description,
                'start_time' => $appointment->start_time->format("Y-m-d h:i A"),
                'end_time' => $appointment->end_time->format("Y-m-d h:i A"),
                'status' => [
                    'name' => $appointment->status->name,
                    'color' => $appointment->status->color()
                ],
                'client' => $appointment->client
            ]);
    }

    /**
     * function to return a collection of all available appointment status along with their count, color and vlue
     *
     * @return Collection
     */
    public function getStatusWithCount(): Collection
    {
        $statuses = AppointmentStatus::cases();
        return collect($statuses)->map(function ($status) {
            return [
                'name' => $status->name,
                'value' => $status->value,
                'color' => $status->color($status->value),
                'count' => Appointment::where('status', $status->value)->count()
            ];
        });
    }

    public function store()
    {
        $validated = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'client_id' => 'required'
        ], [
            'client_id.required' => 'Client name field is required'
        ]);

        Appointment::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'client_id' => $validated['client_id'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'status' => AppointmentStatus::SCHEDULED,
        ]);

        return response()->json(['message' => 'Appointment updated successfully']);
    }

    public function edit(Appointment $appointment)
    {
        return $appointment;
    }

    public function update(Appointment $appointment)
    {
        $validated = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'client_id' => 'required'
        ], [
            'client_id.required' => 'Client name field is required'
        ]);

        $appointment->update($validated);
        return response()->json(['message' => 'Appointment added successfully']);
    }
}
