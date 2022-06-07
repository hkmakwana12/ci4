<?php

namespace Modules\Manage\Controllers;

use App\Controllers\AdminController;
use Modules\Manage\Models\Role;
use Modules\Manage\Models\User;

class UserController extends AdminController
{
    private $viewPath = 'Modules\Manage\Views\Users';
    /*
     * Display Users Details Action
     */
    public function index()
    {
        $user = new User();

        $search = $this->request->getVar('search') ?? "";
        $sort = $this->request->getVar('sort');
        $field = $this->request->getVar('field');

        $user->orderBy($field ?? 'id', $sort ?? 'DESC');
        $user->groupStart();
        $user->orLike('user_firstname', $search);
        $user->orLike('user_lastname', $search);
        $user->orLike('user_email', $search);
        $user->orLike('user_phone', $search);
        $user->groupEnd();
        $data['users'] = $user->paginate();

        $data['pagination_link'] = $user->pager;
        $data['search'] = $search;
        $data['sort'] = $sort;
        $data['field'] = $field;

        return view($this->viewPath . '\index', $data);
    }

    /*
    * Create New  Users Action
    */
    public function create()
    {

        $data = [
            'heading' => 'Create New Users',
        ];
        helper(['form']);
        $data['roles'] = (new  Role())->findAll();
        $data['validation'] = \Config\Services::validation();

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'user_firstname' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Please Enter Valid Firstname',
                    ],
                ],
                'user_lastname' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Please Enter Valid Lastname',
                    ],
                ],
                'user_email' => [
                    'rules' => 'required|valid_email|is_unique[users.user_email]',
                    'errors' => [
                        'required' => 'Please Enter Valid Email Address',
                        'valid_email' => 'Please Enter Valid Email Address',
                        'is_unique' => 'Email Already Exists',
                    ],
                ],
                'user_phone' => [
                    'rules' => 'required|numeric|is_unique[users.user_phone]',
                    'errors' => [
                        'required' => 'Please Enter Valid Phone Number',
                        'numeric' => 'Please Enter Valid Phone Number',
                        'is_unique' => 'Phone Number Already Exists',
                    ],
                ],
                'password' => [
                    'rules' => 'required|matches[confirm_password]',
                    'errors' => [
                        'required' => 'Please Enter Valid Password',
                        'matches' => 'Password and Confirm Password should be same',
                    ],
                ],
                'roles' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Select atleast one role',
                    ],
                ],
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $input = $this->request->getVar(null, FILTER_SANITIZE_STRING);
                $user = new User();

                $user->save($input);
                if ($this->request->getVar('roles'))
                    $user->addRoles($user->getInsertID(), $this->request->getVar('roles'));

                $session = session();
                $session->setFlashdata('success', 'Successfully created new user');

                return redirect()->route('admin.users');
            }
        }

        return view($this->viewPath . '\create', $data);
    }

    /*
    * Update  User information Action
    */
    public function edit($id = null)
    {

        $data = [
            'heading' => 'Update User',
        ];

        $data['validation'] = \Config\Services::validation();
        $data['roles'] = (new  Role())->findAll();

        helper(['form']);
        $user = new User();
        $data['user_roles'] = $user->userWiseRoles($id);

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'user_firstname' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Please Enter Valid Firstname',
                    ],
                ],
                'user_lastname' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Please Enter Valid Lastname',
                    ],
                ],
                'user_email' => [
                    'rules' => 'required|valid_email|is_unique[users.user_email,id,' . $id . ']',
                    'errors' => [
                        'required' => 'Please Enter Valid Email Address',
                        'valid_email' => 'Please Enter Valid Email Address',
                        'is_unique' => 'Email Already Exists',
                    ],
                ],
                'user_phone' => [
                    'rules' => 'required|numeric|is_unique[users.user_phone,id,' . $id . ']',
                    'errors' => [
                        'required' => 'Please Enter Valid Phone Number',
                        'numeric' => 'Please Enter Valid Phone Number',
                        'is_unique' => 'Phone Number Already Exists',
                    ],
                ],
                'password' => [
                    'rules' => 'matches[confirm_password]',
                    'errors' => [
                        'matches' => 'Password and Confirm Password should be same',
                    ],
                ],
                'roles' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Select atleast one role',
                    ],
                ],
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $input = $this->request->getVar(null, FILTER_SANITIZE_STRING);
                $input['id'] = $id;

                $user->save($input);
                if ($this->request->getVar('roles'))
                    $user->editRoles($id, $this->request->getVar('roles'));

                $session = session();
                $session->setFlashdata('success', 'Successfully updated the user');

                return redirect()->route('admin.users');
            }
        }

        $data['user'] = $user->where('id', $id)->first();
        return view($this->viewPath . '\edit', $data);
    }

    /*
    * delete User
    */
    public function delete()
    {
        $input = $this->request->getVar(null, FILTER_SANITIZE_STRING);
        $idArray = explode(",", $input['delete_id']);

        $session = session();
        if ($input['delete_id'] == 1) {
            $session->setFlashdata('error', 'You can not delete this user');
            return redirect()->route('admin.users');
        }
        if (in_array(1, $idArray)) {
            array_splice($idArray, array_search(1, $idArray), 1);
        }

        $user = new User();
        $user->whereIn('id', $idArray);
        if ($user->delete()) {
            $session->setFlashdata('success', 'Successfully deleted the user');
            return redirect()->route('admin.users');
        }
    }
}
