<?php

namespace App\Repositories;

use App\Models\Accesslevel;
use App\Contracts\AccesslevelRepositoryInterface;
use App\Http\Requests\AccesslevelRequest;

class AccesslevelRepository implements AccesslevelRepositoryInterface
{
    public function allAccesslevels()
    {
        return Accesslevel::paginate(10);
    }

    public function createAccesslevel(AccesslevelRequest $request)
    {
        return Accesslevel::create($request->all());
    }

    public function showAccesslevel($id)
    {
        return Accesslevel::findOrFail($id);
    }

    public function updateAccesslevel(AccesslevelRequest $request, Accesslevel $accesslevel)
    {
        return $accesslevel->update($request->all());
    }

    public function deleteAccesslevel(Accesslevel $accesslevel)
    {
        return $accesslevel->delete($accesslevel);
    }
}
