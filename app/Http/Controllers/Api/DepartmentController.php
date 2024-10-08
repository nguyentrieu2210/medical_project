<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    //
    public function index (Request $request) {
        $where = [];
        if($request->name) {
            $where[] = ['name', 'LIKE', '%'.$request->name.'%'];
        }
        if($request->description) {
            $where[] = ['description', 'LIKE', '%'.$request->description.'%'];
        }
        $departments = Department::orderBy('id', 'DESC');
        if(!empty($where)) {
            $departments = $departments->where($where);
        }
        $departments = $departments->get();
        if($departments->count()) {
            $status = 'success';
        }else{
            $status = 'no_data';
        }
        $response = [
            'status' => $status,
            'data' => $departments
        ];
        return $response;
    }

    public function detail (Department $department) {
        $response = [
            'status' => 'success',
            'data' => $department
        ];
        return $response;
    }

    public function create(Request $request) {
        $rules = [
            'name' => 'required'
        ];
        $messages = [
            'name.required' => 'Tên không được để trống!'
        ];
        $request->validate($rules, $messages);
        $department = new Department();
        $department = $department->create($request->all());
        if($department->id) {
            $response = [
                'status' => 'success',
                'data' => $department
            ];
        }else{
            $response = [
                'status' => 'error'
            ];
        }
        return $response;
    }

    public function update (Request $request, $id) {
        echo $request->method();
        return $request->all();
    }

    public function delete ($id) {
        return $id;
    }
}
