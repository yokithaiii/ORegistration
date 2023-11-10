<?php

namespace App\Http\Resources\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EntryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $formattedTime = Carbon::parse($this->time)->format('H:i');
        return [
            'id' => $this->id,
            'customData' => [
                'name' => $this->name,
                'tel' => $this->tel,
                'service' => $this->service,
                'time' => $formattedTime,
                'class' => 'bg-blue-600 text-white p-1',
                'executor_id' => $this->executor_id
            ],
            'dates' => $this->date
        ];
    }
}
