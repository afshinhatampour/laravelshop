<?php

namespace App\Http\Resources\Shop;

use App\Traits\ApiResponderTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomePageProductFeedResource extends JsonResource
{
    use ApiResponderTrait;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function toArray(Request $request): JsonResponse
    {
        return $this->success('',
            [
                'id'         => $this->resource->id,
                'title'      => substr($this->resource->title, 0, 20),
                'content'    => substr($this->resource->content, 0, 50),
                'color_code' => str_replace('#', '', $this->resource->color_code),
                'view_count' => $this->resource->view_count
            ]
        );
    }
}
