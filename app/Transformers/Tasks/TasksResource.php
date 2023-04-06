<?php

namespace App\Transformers\Tasks;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\ResponseService;

class TasksResource extends JsonResource
{
    private $config;

    public function __construct($resource, $config = array())
    {
        parent::__construct($resource);

        $this->config = $config;
    }

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'list_id' => $this->list_id,
            'title' => $this->title,
            'status' => $this->status === 1 ? 'Completo' : 'Pendente',
        ];
    }

    public function with($request)
    {
        return ResponseService::default($this->config, $this->id);
    }

    public function withResponse($request, $response)
    {
        $response->setStatusCode(200);
    }
}