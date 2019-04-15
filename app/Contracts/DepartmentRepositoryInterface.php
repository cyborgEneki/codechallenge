<?php

namespace App\Contracts;

use App\Models\Department;
use App\Http\Requests\DepartmentRequest;

interface DepartmentRepositoryInterface
{
    public function allDepartments();

    public function createDepartment(DepartmentRequest $request);

    public function showDepartment($id);

    public function updateDepartment(DepartmentRequest $request, Department $department);

    public function deleteDepartment(Department $department);
}