<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Contracts\AccesslevelRepositoryInterface;
use App\Models\Accesslevel;
use App\Http\Requests\AccesslevelRequest;

class AccesslevelController extends Controller
{
    protected $accesslevelRepo;
    
    public function __construct(AccesslevelRepositoryInterface $accesslevelRepo)
    {
        $this->accesslevelRepo = $accesslevelRepo;
    }

    public function index()
    {
        $accesslevels = $this->accesslevelRepo->allAccesslevels();
        return response()->json($accesslevels, 200);
    }

    public function store(AccesslevelRequest $request)
    {
        $accesslevel = $this->accesslevelRepo->createAccesslevel($request);
        return response()->json($accesslevel, 201);
    }

    public function show($id)
    {
        $accesslevel = $this->accesslevelRepo->showAccesslevel($id);
        return response()->json($accesslevel, 200);
    }

    public function update(AccesslevelRequest $request, Accesslevel $accesslevel)
    {
        $accesslevel = $this->accesslevelRepo->updateAccesslevel($request, $accesslevel);
        return response()->json($accesslevel, 200);
    }

    public function destroy(Accesslevel $accesslevel)
    {
        $accesslevel = $this->accesslevelRepo->deleteAccesslevel($accesslevel);
        return response()->json($accesslevel, 200);
    }
}
