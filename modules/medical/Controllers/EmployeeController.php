<?php

namespace Modules\Medical\Controllers;

use App\Controllers\AdminController;
use Modules\Medical\Models\Employee;

use Shuchkin\SimpleXLSX;

class EmployeeController extends AdminController
{
    private $viewPath = 'Modules\Medical\Views\Employees';
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
    * Import  Employees Action
    */
    public function import()
    {

        $data = [
            'heading' => 'Import Employees',
        ];
        helper(['form']);

        $data['validation'] = \Config\Services::validation();

        $employeeModel = new Employee();
        if ($this->request->getMethod() == 'post') {
            $input = $this->request->getVar(null, FILTER_SANITIZE_STRING);
            if (isset($input['action']) && $input['action'] == 'import_data') {
                if (!isset($input['employee_full_name'])) {
                    $session = session();
                    $session->setFlashdata('info', 'No data found');
                    return redirect()->route('admin.employees');
                }
                for ($i = 0; $i < count($input['employee_full_name']); $i++) {
                    $employee['employee_full_name'] = $input['employee_full_name'][$i];
                    $employee['employee_address'] = $input['employee_address'][$i];
                    $employee['employee_aadhar_number'] = $input['employee_aadhar_number'][$i];
                    $employee['employee_email'] = $input['employee_email'][$i];
                    $employee['employee_phone'] = $input['employee_phone'][$i];
                    $employee['employee_sex'] = $input['employee_sex'][$i];
                    $employee['employee_marital_status'] = $input['employee_marital_status'][$i];
                    $employee['employee_date_of_birth'] = $input['employee_date_of_birth'][$i];
                    $employee['employee_religion'] = $input['employee_religion'][$i];
                    $employee['employee_education'] = $input['employee_education'][$i];
                    $employee['employee_occupation'] = $input['employee_occupation'][$i];

                    $employee['created_by'] = session()->get('id');

                    $employeeModel->save($employee);
                }
                $session = session();
                $session->setFlashdata('success', 'Employee saved successfully');
                return redirect()->route('admin.employees');
            }
            if ($file = $this->request->getFile('file')) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move('../public/excel', $newName);
                    $fileName = "../public/excel/" . $newName;

                    if ($xlsx = SimpleXLSX::parse($fileName)) {
                        $employees = [];
                        foreach ($xlsx->rows() as $k => $r) {
                            if ($k === 0) {
                                continue;
                            }
                            $employees[] = $r;
                        }
                        $data['employees'] = $employees;
                    } else {
                        $session = session();
                        $session->setFlashdata('error', 'There is a problem with your Excel');
                        return redirect()->route('admin.employees');
                    }
                    unlink($fileName);
                }
            }
        }

        return view($this->viewPath . '\import', $data);
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
            // $rules = [];

            // if (!$this->validate($rules)) {
            //     $data['validation'] = $this->validator;
            // } else {
            $input = $this->request->getVar(null, FILTER_SANITIZE_STRING);
            $input['id'] = $id;

            $employee->save($input);
            $session = session();
            $session->setFlashdata('success', 'Successfully updated the employee');

            return redirect()->route('admin.employees');
            // }
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
