<?php

namespace App\Repositories;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Contracts\DepartmentRepositoryInterface;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    public function allDepartments()
    {
        return Department::all();
    }

    public function createDepartment(Request $request)
    {
        return Department::create($request->all());
    }

    public function showDepartment($id)
    {
        return Department::findOrFail($id);
    }

    public function updateDepartment(Request $request, Department $department)
    {
        return $department->update($request->all());
    }

    public function deleteDepartment(Department $department)
    {
        return $department->delete($department);
    }
}
