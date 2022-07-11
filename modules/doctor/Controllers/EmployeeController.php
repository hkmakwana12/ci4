<?php

namespace Modules\Doctor\Controllers;

use App\Controllers\AdminController;
use Modules\Doctor\Models\Employee;

class EmployeeController extends AdminController
{
    private $viewPath = 'Modules\Doctor\Views\Employees';
    /*
     * Display Employees Details Action
     */
    public function index()
    {
        $employee = new Employee();

        $search = $this->request->getVar('search') ?? "";
        $sort = $this->request->getVar('sort');
        $field = $this->request->getVar('field');

        $employee->orderBy($field ?? 'id', $sort ?? 'DESC');
        $employee->groupStart();
        $employee->orLike('employee_full_name', $search);
        $employee->orLike('employee_email', $search);
        $employee->orLike('employee_phone', $search);
        $employee->orLike('employee_aadhar_number', $search);
        $employee->groupEnd();

        $data['employees'] = $employee->paginate();

        $data['pagination_link'] = $employee->pager;
        $data['search'] = $search;
        $data['sort'] = $sort;
        $data['field'] = $field;

        return view($this->viewPath . '\index', $data);
    }

    /*
    * Create New  Employees Action
    */
    public function create()
    {

        $data = [
            'heading' => 'Create New Employees',
        ];
        helper(['form']);

        $data['validation'] = \Config\Services::validation();

        if ($this->request->getMethod() == 'post') {
            // $rules = [];

            // if (!$this->validate($rules)) {
            //     $data['validation'] = $this->validator;
            // } else {
            $input = $this->request->getVar(null, FILTER_SANITIZE_STRING);
            $input['created_by'] = session()->get('id');
            $employee = new Employee();

            $employee->save($input);

            $session = session();
            $session->setFlashdata('success', 'Successfully created new employee');

            return redirect()->route('admin.employees');
            // }
        }

        return view($this->viewPath . '\create', $data);
    }

    /*
    * Update  Employee information Action
    */
    public function edit($id = null)
    {

        $data = [
            'heading' => 'Update Employee',
        ];

        $data['validation'] = \Config\Services::validation();
        helper(['form']);
        $employee = new Employee();
        if ($this->request->getMethod() == 'post') {
            $rules = [];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $input = $this->request->getVar(null, FILTER_SANITIZE_STRING);
                $input['id'] = $id;

                $employee->save($input);
                $session = session();
                $session->setFlashdata('success', 'Successfully updated the employee');

                return redirect()->route('admin.employees');
            }
        }

        $data['employee'] = $employee->where('id', $id)->first();

        return view($this->viewPath . '\edit', $data);
    }

    /*
    * delete Employee
    */
    public function delete()
    {
        $input = $this->request->getVar(null, FILTER_SANITIZE_STRING);

        $employee = new Employee();
        $employee->whereIn('id', explode(",", $input['delete_id']));
        $employee->delete();

        $session = session();
        $session->setFlashdata('success', 'Successfully deleted the employee');

        return redirect()->route('admin.employees');
    }
}
