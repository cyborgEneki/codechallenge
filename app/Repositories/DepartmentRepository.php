<?php

namespace App\Repositories;

use App\Models\Department;
use App\Contracts\DepartmentRepositoryInterface;
use App\Http\Requests\DepartmentRequest;
use App\Models\User;

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
        $users_in_the_department = User::where('department_id', $department->id)->get();

        if ($users_in_the_department == null) {
            return $department->delete($department);
        }
        return response()->json(['error' => 'Stop! Users are attached to this department'], 404);        
    }
}
