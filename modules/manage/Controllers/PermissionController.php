<?php

namespace Modules\Manage\Controllers;

use App\Controllers\AdminController;
use Modules\Manage\Models\Permission;

class PermissionController extends AdminController
{
    private $viewPath = 'Modules\Manage\Views\Permissions';
    /*
     * Display Permissions Details Action
     */
    public function index()
    {
        $permission = new Permission();

        $search = $this->request->getVar('search') ?? "";
        $sort = $this->request->getVar('sort');
        $field = $this->request->getVar('field');

        $permission->orderBy($field ?? 'id', $sort ?? 'DESC');
        $permission->groupStart();
        $permission->orLike('permission_name', $search);
        $permission->orLike('permission_display_name', $search);
        $permission->groupEnd();
        $data['permissions'] = $permission->paginate();

        $data['pagination_link'] = $permission->pager;
        $data['search'] = $search;
        $data['sort'] = $sort;
        $data['field'] = $field;

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
    public function delete()
    {
        $input = $this->request->getVar(null, FILTER_SANITIZE_STRING);

        $permission = new Permission();
        $permission->whereIn('id', explode(",", $input['delete_id']));
        $permission->delete();

        $session = session();
        $session->setFlashdata('success', 'Successfully deleted the permission');

        return redirect()->route('admin.permissions');
    }
}
