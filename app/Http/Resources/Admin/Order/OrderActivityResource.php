<?php

namespace App\Http\Resources\Admin\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Spatie\Activitylog\Models\Activity;

class OrderActivityResource extends JsonResource
{
    protected $event, $properties, $subject, $causer;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $this->event = $this->resource->event;
        $this->subject = $this->resource->subject;
        $this->causer = $this->resource->causer;

        return [
            'id'       => $this->resource->id,
            'activity' => $this->getTemplate($this->event),
            'date'     => $this->resource->created_at->format('M j, Y h:i A'),
        ];
    }

    protected function getTemplate(string $event): string
    {
        return match ($event) {
            'created' => $this->getCreatedTemplate(),
            'updated' => $this->getUpdatedTemplate(),
        };
    }

    protected function getCreatedTemplate(): string
    {
        return 'Order number ' . $this->subject->id
            . ' has been ' . $this->event
            . ' by ' . $this->causer->name;
    }

    protected function getUpdatedTemplate(): string
    {
        return 'Order number ' . $this->subject->id
            . ' has been ' . $this->event
            . ' to ' . $this->subject->status->value
            . ' by ' . $this->causer->name;
    }
}
