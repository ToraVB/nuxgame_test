<?php

namespace App\Http\Resources;

use App\Models\ImfeelingluckyHistory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin ImfeelingluckyHistory
 */
class ImfeelingluckyHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'result' => $this->result,
        ];
    }
}
