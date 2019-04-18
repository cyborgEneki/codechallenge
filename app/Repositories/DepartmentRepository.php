<?php

namespace App\Repositories;

use App\Models\Department;
use App\Contracts\DepartmentRepositoryInterface;
use App\Http\Requests\DepartmentRequest;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    public function allDepartments()
    {
        return Department::paginate(10);
    }

    public function createDepartment(DepartmentRequest $request)
    {
        return Department::create($request->all());
    }

    public function showDepartment($id)
    {
        return Department::where('id', '=', $id)->first();        
    }

    public function updateDepartment(DepartmentRequest $request, Department $department)
    {
        return $department->update($request->all());
    }

    public function deleteDepartment(Department $department)
    {
        return $department->delete($department);
    }
}
