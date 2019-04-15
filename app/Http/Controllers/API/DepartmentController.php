<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\DepartmentRepositoryInterface;
use App\Models\Department;

class DepartmentController extends Controller
{
    protected $departmentRepo;
    
    public function __construct(DepartmentRepositoryInterface $departmentRepo)
    {
        $this->departmentRepo = $departmentRepo;
    }

    public function index()
    {
        $department = $this->departmentRepo->allDepartments();
        return response()->json($department, 200);
    }

    public function store(Request $request)
    {
        $department = $this->departmentRepo->createDepartment($request);
        return response()->json($department, 201);
    }

    public function show($id)
    {
        $department = $this->departmentRepo->showDepartment($id);
        return response()->json($department, 200);
    }

    public function update(Request $request, Department $department)
    {
        $department = $this->departmentRepo->updateDepartment($request, $department);
        return response()->json($department, 200);
    }

    public function destroy(Department $department)
    {
        $department = $this->departmentRepo->deleteDepartment($department);
        return response()->json($department, 200);
    }
}
