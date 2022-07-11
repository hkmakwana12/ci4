<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use Modules\Manage\Models\User;

class LoginController extends BaseController
{
    protected function init()
    {
        $this->_created = date('Y-m-d H:i:s');
        $this->_modified = date('Y-m-d H:i:s');
    }

    /*
     * login Action
     */
    public function index()
    {
        $this->init();
        if (session()->get('isLoggedIn')) {
            return  redirect()->route('admin.dash');
        }

        $data = [];
        helper(['form']);
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required',
            ];
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $email = $this->request->getVar('email');
                $password = $this->request->getVar('password');

                $model = new User();
                $userDetails = $model->where('user_email', $email)->join('roles_users', 'roles_users.user_id = users.id')->first();
                $session = session();
                if ($userDetails) {
                    $pass = $userDetails->password;
                    $verify_pass = password_verify($password, $pass);
                    if ($verify_pass) {
                        $ses_data = [
                            'id' => $userDetails->id,
                            'user_firstname' => $userDetails->user_firstname,
                            'user_lastname' => $userDetails->user_lastname,
                            'user_email' => $userDetails->user_email,
                            'role_id' => $userDetails->role_id ?? 0,
                            'isLoggedIn' => true,
                        ];
                        $session->set($ses_data);
                        return redirect()->route('admin.dash');
                    } else {
                        $session->setFlashdata('msg', 'Invalid Credentials');
                        return redirect()->route('login');
                    }
                } else {
                    $session->setFlashdata('msg', 'Invalid Credentials');
                    return redirect()->route('login');
                }
            }
        }

        return view('auth/login', $data);
    }

    /*
     * login Action
     */
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->route('admin.login');
    }
}
