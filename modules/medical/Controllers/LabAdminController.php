<?php

namespace Modules\Medical\Controllers;

use App\Controllers\AdminController;
use Modules\Manage\Models\User;

class LabAdminController extends AdminController
{
    private $viewPath = 'Modules\Medical\Views\LabAdmins';
    /*
     * Display LabAdmins Details Action
     */
    public function index()
    {
        $labadmin = new User();

        $search = $this->request->getVar('search') ?? "";
        $sort = $this->request->getVar('sort');
        $field = $this->request->getVar('field');

        $labadmin->orderBy($field ?? 'id', $sort ?? 'DESC');
        $labadmin->groupStart();
        $labadmin->orLike('user_firstname', $search);
        $labadmin->orLike('user_lastname', $search);
        $labadmin->orLike('user_email', $search);
        $labadmin->orLike('user_phone', $search);
        $labadmin->groupEnd();

        $labadmin->join('roles_users', 'roles_users.user_id=users.id', 'left');
        $labadmin->where('role_id', 7);

        $data['labadmins'] = $labadmin->paginate();

        $data['pagination_link'] = $labadmin->pager;
        $data['search'] = $search;
        $data['sort'] = $sort;
        $data['field'] = $field;

        return view($this->viewPath . '\index', $data);
    }

    /*
    * Create New  LabAdmins Action
    */
    public function create()
    {

        $data = [
            'heading' => 'Create New LabAdmins',
        ];
        helper(['form']);

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
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $input = $this->request->getVar(null, FILTER_SANITIZE_STRING);
                $labadmin = new User();

                $labadmin->save($input);
                $labadmin->addRoles($labadmin->getInsertID(), [7]);
                $labadmin->saveMeta($input, $labadmin->getInsertID());

                $session = session();
                $session->setFlashdata('success', 'Successfully created new labadmin');

                return redirect()->route('admin.labadmins');
            }
        }

        return view($this->viewPath . '\create', $data);
    }

    /*
    * Update  LabAdmin information Action
    */
    public function edit($id = null)
    {

        $data = [
            'heading' => 'Update LabAdmin',
        ];

        $data['validation'] = \Config\Services::validation();
        helper(['form']);
        $labadmin = new User();
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
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $input = $this->request->getVar(null, FILTER_SANITIZE_STRING);
                $input['id'] = $id;

                $labadmin->save($input);
                $labadmin->saveMeta($input, $id);
                $session = session();
                $session->setFlashdata('success', 'Successfully updated the labadmin');

                return redirect()->route('admin.labadmins');
            }
        }

        $data['labadmin'] = $labadmin->where('id', $id)->first();
        $labadmins = $labadmin->where('id', $id)->first();
        $userMeta = $labadmin->getMeta($id);
        $labadmins = (object) array_merge(
            (array) $labadmins,
            (array) $userMeta
        );

        $data['labadmin'] = $labadmins;

        return view($this->viewPath . '\edit', $data);
    }

    /*
    * delete LabAdmin
    */
    public function delete()
    {
        $input = $this->request->getVar(null, FILTER_SANITIZE_STRING);

        $labadmin = new User();
        $labadmin->whereIn('id', explode(",", $input['delete_id']));
        $labadmin->delete();

        $session = session();
        $session->setFlashdata('success', 'Successfully deleted the labadmin');

        return redirect()->route('admin.labadmins');
    }
}
