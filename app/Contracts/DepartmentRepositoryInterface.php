<?php

namespace App\Contracts;

use App\Models\Department;
use Illuminate\Http\Request;

interface DepartmentRepositoryInterface
{
    public function allDepartments();

    public function createDepartment(Request $request);

    public function showDepartment(Department $department);

    public function updateDepartment(Request $request, Department $department);

    public function deleteDepartment(Department $department);
}