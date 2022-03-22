<?php

namespace Modules\Manage\Controllers;

use App\Controllers\AdminController;
use Modules\Manage\Models\CrudModel;
use Modules\Manage\Models\Permission;

class PermissionController extends AdminController
{
    private $viewPath = 'Modules\Manage\Views\Permissions';
    /*
     * Display Permissions Details Action
     */
    public function index()
    {
        $data = [
            'heading' => 'System Permissions',
        ];

        $crudModel = new CrudModel();

        $data['user_data'] = $crudModel->orderBy('id', 'DESC')->paginate(10);

        $data['pagination_link'] = $crudModel->pager;

        return view($this->viewPath . '\index', $data);
    }

    /*
    * Create New  Permissions Action
    */
    public function create()
    {

        $data = [
            'heading' => 'Create New Permissions',
        ];
        helper(['form']);

        $data['validation'] = \Config\Services::validation();

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'permission_name' => [
                    'rules' => 'required|regex_match[/^([a-z-])+$/i]|is_unique[permissions.permission_name]',
                    'errors' => [
                        'required' => 'Please Enter Valid Name',
                        'is_unique' => 'Name should be unique',
                        'regex_match' => 'Name should be Without Space',
                    ],
                ],
                'permission_display_name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Please Enter Valid Display Name',
                    ],
                ],
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $input = $this->request->getVar(null, FILTER_SANITIZE_STRING);
                $permission = new Permission();

                $permission->save($input);

                $session = session();
                $session->setFlashdata('success', 'Successfully created new permission');

                return redirect()->route('admin.permissions');
            }
        }

        return view($this->viewPath . '\create', $data);
    }

    /*
    * Update  Permission information Action
    */
    public function edit($id = null)
    {

        $data = [
            'heading' => 'Update Permission',
        ];

        $data['validation'] = \Config\Services::validation();
        helper(['form']);
        $permission = new Permission();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'permission_name' => [
                    'rules' => 'required|regex_match[/^([a-z-])+$/i]|is_unique[permissions.permission_name,id,' . $id . ']',
                    'errors' => [
                        'required' => 'Please Enter Valid Name',
                        'is_unique' => 'Name should be unique',
                        'regex_match' => 'Name should be Without Space',
                    ],
                ],
                'permission_display_name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Please Enter Valid Display Name',
                    ],
                ],
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $input = $this->request->getVar(null, FILTER_SANITIZE_STRING);
                $input['id'] = $id;

                $permission->save($input);
                $session = session();
                $session->setFlashdata('success', 'Successfully updated the permission');

                return redirect()->route('admin.permissions');
            }
        }

        $data['permission'] = $permission->where('id', $id)->first();
        return view($this->viewPath . '\edit', $data);
    }

    /*
    * delete Permission
    */
    public function delete($id = null)
    {
        $permission = new Permission();
        $permission->where('id', $id);
        $permission->delete();

        $session = session();
        $session->setFlashdata('success', 'Successfully deleted the permission');

        return redirect()->route('admin.permissions');
    }

    public function list()
    {
        $permission = new Permission();

        $this->data = $permission->paginate(10, 'id', 1, 0);

        echo json_encode($this->data);
    }
}
