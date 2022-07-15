<?php

namespace Modules\Restaurant\Controllers;

use App\Controllers\AdminController;
use Modules\Restaurant\Models\Store;

class StoreController extends AdminController
{
    private $viewPath = 'Modules\Restaurant\Views\Stores';
    /*
     * Display Stores Details Action
     */
    public function index()
    {
        $store = new Store();

        $search = $this->request->getVar('search') ?? "";
        $sort = $this->request->getVar('sort');
        $field = $this->request->getVar('field');

        $store->orderBy($field ?? 'id', $sort ?? 'DESC');
        $store->groupStart();
        $store->orLike('store_name', $search);
        $store->groupEnd();
        $data['stores'] = $store->paginate();

        $data['pagination_link'] = $store->pager;
        $data['search'] = $search;
        $data['sort'] = $sort;
        $data['field'] = $field;

        return view($this->viewPath . '\index', $data);
    }

    /*
    * Create New  Stores Action
    */
    public function create()
    {

        $data = [
            'heading' => 'Create New Stores',
        ];
        helper(['form']);

        $data['validation'] = \Config\Services::validation();

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'store_name' => [
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
                $store = new Store();

                $store->save($input);

                $session = session();
                $session->setFlashdata('success', 'Successfully created new store');

                return redirect()->route('admin.stores');
            }
        }

        return view($this->viewPath . '\create', $data);
    }

    /*
    * Update  Store information Action
    */
    public function edit($id = null)
    {

        $data = [
            'heading' => 'Update Store',
        ];

        $data['validation'] = \Config\Services::validation();
        helper(['form']);
        $store = new Store();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'store_name' => [
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

                $store->save($input);
                $session = session();
                $session->setFlashdata('success', 'Successfully updated the store');

                return redirect()->route('admin.stores');
            }
        }

        $data['store'] = $store->where('id', $id)->first();
        if (!$data['store']) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('No record found');

        return view($this->viewPath . '\edit', $data);
    }

    /*
    * delete Store
    */
    public function delete()
    {
        $input = $this->request->getVar(null, FILTER_SANITIZE_STRING);

        $store = new Store();
        $store->whereIn('id', explode(",", $input['delete_id']));
        $store->delete();

        $session = session();
        $session->setFlashdata('success', 'Successfully deleted the store');

        return redirect()->route('admin.stores');
    }
}
