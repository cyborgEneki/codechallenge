<?php

namespace App\Contracts;

use App\Models\Accesslevel;
use App\Http\Requests\AccesslevelRequest;

interface AccesslevelRepositoryInterface
{
    public function allAccesslevels();

    public function createAccesslevel(AccesslevelRequest $request);

    public function showAccesslevel($id);

    public function updateAccesslevel(AccesslevelRequest $request, Accesslevel $accesslevel);

    public function deleteAccesslevel(Accesslevel $accesslevel);
}