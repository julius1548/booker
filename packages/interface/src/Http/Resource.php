<?php
namespace Bookkeeper\Interface\Http;
use Illuminate\Http\Resources\Json\JsonResource;

class Resource extends JsonResource
{
    public static $wrap = null;
}
