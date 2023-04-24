<?php

namespace Bookkeeper\Interface\Contracts\Abstracts\Actions;

use Bookkeeper\Interface\Contracts\Abstracts\Model;
use Bookkeeper\Interface\Http\Request;
use Illuminate\Database\Eloquent\Collection;

abstract class IndexAction
{
    /** @return Model */
    abstract function model(): string;

    public function execute(Request $request): Collection|array
    {
        return $this->model()::with($request->input('with', []))->get();
    }
}
