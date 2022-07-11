<?php

namespace Modules\Doctor\Controllers;

use App\Controllers\AdminController;
use Modules\Doctor\Models\Screening;

class ScreeningController extends AdminController
{
    private $viewPath = 'Modules\Doctor\Views\Screenings';
    /*
     * Display Screenings Details Action
     */
    public function index()
    {
        $screening = new Screening();

        $search = $this->request->getVar('search') ?? "";
        $sort = $this->request->getVar('sort');
        $field = $this->request->getVar('field');

        $screening->orderBy($field ?? 'id', $sort ?? 'DESC');
        $screening->groupStart();
        $screening->orLike('screening_name', $search);
        $screening->groupEnd();
        $data['screenings'] = $screening->paginate();

        $data['pagination_link'] = $screening->pager;
        $data['search'] = $search;
        $data['sort'] = $sort;
        $data['field'] = $field;

        return view($this->viewPath . '\index', $data);
    }

    /*
    * Create New  Screenings Action
    */
    public function create()
    {

        $data = [
            'heading' => 'Create New Screenings',
        ];
        helper(['form']);

        $data['validation'] = \Config\Services::validation();

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'screening_name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Please Enter Valid Name',
                    ],
                ],
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $input = $this->request->getVar(null, FILTER_SANITIZE_STRING);
                $screening = new Screening();

                $screening->save($input);

                $session = session();
                $session->setFlashdata('success', 'Successfully created new screening');

                return redirect()->route('admin.screenings');
            }
        }

        return view($this->viewPath . '\create', $data);
    }

    /*
    * Update  Screening information Action
    */
    public function edit($id = null)
    {

        $data = [
            'heading' => 'Update Screening',
        ];

        $data['validation'] = \Config\Services::validation();
        helper(['form']);
        $screening = new Screening();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'screening_name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Please Enter Valid Name',
                    ],
                ],
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $input = $this->request->getVar(null, FILTER_SANITIZE_STRING);
                $input['id'] = $id;

                $screening->save($input);
                $session = session();
                $session->setFlashdata('success', 'Successfully updated the screening');

                return redirect()->route('admin.screenings');
            }
        }

        $data['screening'] = $screening->where('id', $id)->first();
        return view($this->viewPath . '\edit', $data);
    }

    /*
    * delete Screening
    */
    public function delete()
    {
        $input = $this->request->getVar(null, FILTER_SANITIZE_STRING);

        $screening = new Screening();
        $screening->whereIn('id', explode(",", $input['delete_id']));
        $screening->delete();

        $session = session();
        $session->setFlashdata('success', 'Successfully deleted the screening');

        return redirect()->route('admin.screenings');
    }
}
