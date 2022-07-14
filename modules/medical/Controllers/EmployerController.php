<?php

namespace Modules\Medical\Controllers;

use App\Controllers\AdminController;
use Modules\Manage\Models\User;

class EmployerController extends AdminController
{
    private $viewPath = 'Modules\Medical\Views\Employers';
    /*
     * Display Employers Details Action
     */
    public function index()
    {
        $employer = new User();

        $search = $this->request->getVar('search') ?? "";
        $sort = $this->request->getVar('sort');
        $field = $this->request->getVar('field');

        $employer->orderBy($field ?? 'id', $sort ?? 'DESC');
        $employer->groupStart();
        $employer->orLike('user_firstname', $search);
        $employer->orLike('user_lastname', $search);
        $employer->orLike('user_email', $search);
        $employer->orLike('user_phone', $search);
        $employer->groupEnd();

        $employer->join('roles_users', 'roles_users.user_id=users.id', 'left');
        $employer->where('role_id', 5);

        $data['employers'] = $employer->paginate();

        $data['pagination_link'] = $employer->pager;
        $data['search'] = $search;
        $data['sort'] = $sort;
        $data['field'] = $field;

        return view($this->viewPath . '\index', $data);
    }

    /*
    * Create New  Employers Action
    */
    public function create()
    {

        $data = [
            'heading' => 'Create New Employers',
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
                $employer = new User();

                $employer->save($input);
                $employer->addRoles($employer->getInsertID(), [5]);
                $employer->saveMeta($input, $employer->getInsertID());

                $session = session();
                $session->setFlashdata('success', 'Successfully created new employer');

                return redirect()->route('admin.employers');
            }
        }

        return view($this->viewPath . '\create', $data);
    }

    /*
    * Update  Employer information Action
    */
    public function edit($id = null)
    {

        $data = [
            'heading' => 'Update Employer',
        ];

        $data['validation'] = \Config\Services::validation();
        helper(['form']);
        $employer = new User();
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

                $employer->save($input);
                $employer->saveMeta($input, $id);
                $session = session();
                $session->setFlashdata('success', 'Successfully updated the employer');

                return redirect()->route('admin.employers');
            }
        }

        $data['employer'] = $employer->where('id', $id)->first();
        $employers = $employer->where('id', $id)->first();
        $userMeta = $employer->getMeta($id);
        $employers = (object) array_merge(
            (array) $employers,
            (array) $userMeta
        );

        $data['employer'] = $employers;

        return view($this->viewPath . '\edit', $data);
    }

    /*
    * delete Employer
    */
    public function delete()
    {
        $input = $this->request->getVar(null, FILTER_SANITIZE_STRING);

        $employer = new User();
        $employer->whereIn('id', explode(",", $input['delete_id']));
        $employer->delete();

        $session = session();
        $session->setFlashdata('success', 'Successfully deleted the employer');

        return redirect()->route('admin.employers');
    }
}
