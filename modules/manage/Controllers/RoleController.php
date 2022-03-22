<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\Make_bread;
use App\Libraries\SSP;
use App\Models\Permission;
use App\Models\Role;

class RoleController extends BaseController
{
  /*
     * Display Roles Details Action
     */
  public function index()
  {
    if (!session()->get('isLoggedIn')) {
      return  redirect()->route('admin.auth');
    }
    $data = [
      'heading' => 'System Roles',
    ];
    // first load the library breadcrumb
    $make_bread = new Make_bread();
    // add the first crumb, the segment being added to the previous crumb's URL
    $make_bread->add('System Roles', 'roles', true);
    // now, let's store the output of the breadcrumb in a variable and show it  inside a view
    $breadcrumb = $make_bread->output();
    $data['breadcrumb'] = $breadcrumb;
    $role = new  Role();

    return view('admin/roles/index', $data);
  }

  /*
    * Create New  Roles Action
    */
  public function create()
  {
    if (!session()->get('isLoggedIn')) {
      return  redirect()->route('admin.auth');
    }

    // first load the library breadcrumb
    $make_bread = new Make_bread();
    // add the first crumb, the segment being added to the previous crumb's URL
    $make_bread->add('System Roles', 'roles', true);
    $make_bread->add('Create Roles', 'create', true);
    // now, let's store the output of the breadcrumb in a variable and show it  inside a view
    $breadcrumb = $make_bread->output();
    $data = [
      'heading' => 'Create New Roles',
    ];
    $data['breadcrumb'] = $breadcrumb;
    $data['permissions'] = (new  Permission())->findAll();
    helper(['form']);

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

    return view('admin/roles/create', $data);
  }

  /*
    * Update  Role information Action
    */
  public function edit($id = null)
  {
    if (!session()->get('isLoggedIn')) {
      return  redirect()->route('admin.auth');
    }
    // first load the library breadcrumb
    $make_bread = new Make_bread();
    // add the first crumb, the segment being added to the previous crumb's URL
    $make_bread->add('System Roles', 'roles', true);
    $make_bread->add('Update Roles', 'update', true);
    // now, let's store the output of the breadcrumb in a variable and show it  inside a view
    $breadcrumb = $make_bread->output();
    $data = [
      'heading' => 'Update Role',
    ];
    $data['breadcrumb'] = $breadcrumb;
    $data['validation'] = \Config\Services::validation();
    $data['permissions'] = (new  Permission())->findAll();

    $role = new Role();
    $data['role_permissions'] = $role->roleWisePermissions($id);

    helper(['form']);
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

    return view('admin/roles/edit', $data);
  }

  /*
    * delete Role
    */
  public function delete($id = null)
  {
    if (!session()->get('isLoggedIn')) {
      return  redirect()->route('admin.auth');
    }
    $role = new Role();
    $role->where('id', $id);
    $role->delete();

    $session = session();
    if ($id == 1) {
      $session->setFlashdata('error', 'You can not delete this role');

      return redirect()->route('admin.roles');
    }

    $session->setFlashdata('success', 'Successfully deleted the role');

    return redirect()->route('admin.roles');
  }

  public function list()
  {
    $this->db = db_connect();
    // this is database details
    $sql_details = [
      'host' => $this->db->hostname,
      'port' => $this->db->port,
      'user' => $this->db->username,
      'pass' => $this->db->password,
      'db' => $this->db->database,
    ];

    $table = 'roles';

    //primary key
    $primaryKey = 'id';

    $columns = [
      [
        'db' => 'role_name',
        'dt' => 0,
      ],
      [
        'db' => 'role_display_name',
        'dt' => 1,
      ],
      [
        'db' => 'id',
        'dt' => 2, 'field' => 'id',
        'formatter' => function ($d, $row) {
          $actionBtn = '';
          $actionBtn .= '<a href="' . route_to('admin.roles.edit', $d) . '" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-xs btn-primary">Edit</a>';

          if (!in_array($d, [1, 2, 3])) :
            $actionBtn .= '&nbsp;<a href="#" data-toggle="modal" data-target="#myModal" data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-xs btn-danger deleteRole" data-id="' . $d . '">Delete</a>';
          endif;

          return $actionBtn;
        },
      ],
    ];
    $joinQuery = '';
    $extraWhere = 'deleted_at is null';
    $groupBy = '';
    $having = '';

    echo json_encode(
      SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having)
    );
  }
}
