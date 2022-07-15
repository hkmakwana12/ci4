<?php

namespace Modules\Medical\Controllers;

use App\Controllers\AdminController;
use Modules\Manage\Models\User;

class DoctorController extends AdminController
{
    private $viewPath = 'Modules\Medical\Views\Doctors';
    /*
     * Display Doctors Details Action
     */
    public function index()
    {
        $doctor = new User();

        $search = $this->request->getVar('search') ?? "";
        $sort = $this->request->getVar('sort');
        $field = $this->request->getVar('field');

        $doctor->orderBy($field ?? 'id', $sort ?? 'DESC');
        $doctor->groupStart();
        $doctor->orLike('user_firstname', $search);
        $doctor->orLike('user_lastname', $search);
        $doctor->orLike('user_email', $search);
        $doctor->orLike('user_phone', $search);
        $doctor->groupEnd();

        $doctor->join('roles_users', 'roles_users.user_id=users.id', 'left');
        $doctor->where('role_id', 6);

        $data['doctors'] = $doctor->paginate();

        $data['pagination_link'] = $doctor->pager;
        $data['search'] = $search;
        $data['sort'] = $sort;
        $data['field'] = $field;

        return view($this->viewPath . '\index', $data);
    }

    /*
    * Create New  Doctors Action
    */
    public function create()
    {

        $data = [
            'heading' => 'Create New Doctors',
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
                $doctor = new User();

                $doctor->save($input);
                $doctor->addRoles($doctor->getInsertID(), [6]);
                $doctor->saveMeta($input, $doctor->getInsertID());

                $session = session();
                $session->setFlashdata('success', 'Successfully created new doctor');

                return redirect()->route('admin.doctors');
            }
        }

        return view($this->viewPath . '\create', $data);
    }

    /*
    * Update  Doctor information Action
    */
    public function edit($id = null)
    {

        $data = [
            'heading' => 'Update Doctor',
        ];

        $data['validation'] = \Config\Services::validation();
        helper(['form']);
        $doctor = new User();
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

                $doctor->save($input);
                $doctor->saveMeta($input, $id);
                $session = session();
                $session->setFlashdata('success', 'Successfully updated the doctor');

                return redirect()->route('admin.doctors');
            }
        }

        $data['doctor'] = $doctor->where('id', $id)->first();
        if (!$data['doctor']) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('No record found');
        $doctors = $doctor->where('id', $id)->first();
        $userMeta = $doctor->getMeta($id);
        $doctors = (object) array_merge(
            (array) $doctors,
            (array) $userMeta
        );

        $data['doctor'] = $doctors;

        return view($this->viewPath . '\edit', $data);
    }

    /*
    * delete Doctor
    */
    public function delete()
    {
        $input = $this->request->getVar(null, FILTER_SANITIZE_STRING);

        $doctor = new User();
        $doctor->whereIn('id', explode(",", $input['delete_id']));
        $doctor->delete();

        $session = session();
        $session->setFlashdata('success', 'Successfully deleted the doctor');

        return redirect()->route('admin.doctors');
    }
}
