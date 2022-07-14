<?php

namespace Modules\Manage\Controllers;

use App\Controllers\AdminController;
use Modules\Manage\Models\Permission;
use Modules\Manage\Models\Role;

class RoleController extends AdminController
{
    private $viewPath = 'Modules\Manage\Views\Roles';
    /*
     * Display Roles Details Action
     */
    public function index()
    {
        $role = new Role();

        $search = $this->request->getVar('search') ?? "";
        $sort = $this->request->getVar('sort');
        $field = $this->request->getVar('field');

        $role->orderBy($field ?? 'id', $sort ?? 'DESC');
        $role->groupStart();
        $role->orLike('role_name', $search);
        $role->orLike('role_display_name', $search);
        $role->groupEnd();
        $data['roles'] = $role->paginate();

        $data['pagination_link'] = $role->pager;
        $data['search'] = $search;
        $data['sort'] = $sort;
        $data['field'] = $field;

        return view($this->viewPath . '\index', $data);
    }

    /*
    * Create New  Roles Action
    */
    public function create()
    {

        $data = [
            'heading' => 'Create New Roles',
        ];
        helper(['form']);
        $data['permissions'] = (new  Permission())->findAll();
        $data['validation'] = \Config\Services::validation();

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'role_name' => [
                    'rules' => 'required|regex_match[/^([a-z-])+$/i]|is_unique[roles.role_name]',
                    'errors' => [
                        'required' => 'Please Enter Valid Name',
                        'is_unique' => 'Name should be unique',
                        'regex_match' => 'Name should be Without Space',
                    ],
                ],
                'role_display_name' => [
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
                $role = new Role();

                $role->save($input);
                if ($this->request->getVar('permissions'))
                    $role->addPermissions($role->getInsertID(), $this->request->getVar('permissions'));

                $session = session();
                $session->setFlashdata('success', 'Successfully created new role');

                return redirect()->route('admin.roles');
            }
        }

        return view($this->viewPath . '\create', $data);
    }

    /*
    * Update  Role information Action
    */
    public function edit($id = null)
    {

        $data = [
            'heading' => 'Update Role',
        ];

        $data['validation'] = \Config\Services::validation();
        $data['permissions'] = (new  Permission())->findAll();

        helper(['form']);
        $role = new Role();
        $data['role_permissions'] = $role->roleWisePermissions($id);

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'role_name' => [
                    'rules' => 'required|regex_match[/^([a-z-])+$/i]|is_unique[roles.role_name,id,' . $id . ']',
                    'errors' => [
                        'required' => 'Please Enter Valid Name',
                        'is_unique' => 'Name should be unique',
                        'regex_match' => 'Name should be Without Space',
                    ],
                ],
                'role_display_name' => [
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

                $role->save($input);
                if ($this->request->getVar('permissions'))
                    $role->editPermissions($id, $this->request->getVar('permissions'));

                $session = session();
                $session->setFlashdata('success', 'Successfully updated the role');

                return redirect()->route('admin.roles');
            }
        }

        $data['role'] = $role->where('id', $id)->first();
        return view($this->viewPath . '\edit', $data);
    }

    /*
    * delete Role
    */
    public function delete()
    {
        $input = $this->request->getVar(null, FILTER_SANITIZE_STRING);
        $idArray = explode(",", $input['delete_id']);

        $session = session();
        if ($input['delete_id'] == 1) {
            $session->setFlashdata('error', 'You can not delete this role');
            return redirect()->route('admin.roles');
        }
        if (in_array(1, $idArray)) {
            array_splice($idArray, array_search(1, $idArray), 1);
        }

        $role = new Role();
        $role->whereIn('id', $idArray);
        if ($role->delete()) {
            $session->setFlashdata('success', 'Successfully deleted the role');
            return redirect()->route('admin.roles');
        }
    }
}
