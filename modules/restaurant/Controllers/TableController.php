<?php

namespace Modules\Restaurant\Controllers;

use App\Controllers\AdminController;
use Modules\Restaurant\Models\Store;
use Modules\Restaurant\Models\Table;

class TableController extends AdminController
{
    private $viewPath = 'Modules\Restaurant\Views\Tables';
    /*
     * Display Tables Details Action
     */
    public function index()
    {
        $table = new Table();

        $search = $this->request->getVar('search') ?? "";
        $sort = $this->request->getVar('sort');
        $field = $this->request->getVar('field');

        $table->select('tables.*, stores.store_name');
        $table->join('stores', 'stores.id = tables.store_id');
        $table->orderBy($field ?? 'id', $sort ?? 'DESC');
        $table->groupStart();
        $table->orLike('store_name', $search);
        $table->orLike('table_name', $search);
        $table->orLike('table_number', $search);
        $table->groupEnd();
        $data['tables'] = $table->paginate();

        $data['pagination_link'] = $table->pager;
        $data['search'] = $search;
        $data['sort'] = $sort;
        $data['field'] = $field;

        return view($this->viewPath . '\index', $data);
    }

    /*
    * Create New  Tables Action
    */
    public function create()
    {

        $data = [
            'heading' => 'Create New Tables',
            'stores' => (new Store())->findAll(),
        ];
        helper(['form']);

        $data['validation'] = \Config\Services::validation();

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'store_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Please Select Store',
                    ],
                ],
                'table_number' => [
                    'rules' => 'required|is_unique[tables.table_number]',
                    'errors' => [
                        'required' => 'Please Enter Valid Table Number',
                        'is_unique' => 'Table Number should be unique',
                    ],
                ],
                'table_capacity' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Please Enter Table Capacity',
                    ],
                ],
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $input = $this->request->getVar(null, FILTER_SANITIZE_STRING);
                $table = new Table();

                $table->save($input);

                $session = session();
                $session->setFlashdata('success', 'Successfully created new table');

                return redirect()->route('admin.tables');
            }
        }

        return view($this->viewPath . '\create', $data);
    }

    /*
    * Update  Table information Action
    */
    public function edit($id = null)
    {

        $data = [
            'heading' => 'Update Table',
            'stores' => (new Store())->findAll(),
        ];

        $data['validation'] = \Config\Services::validation();
        helper(['form']);
        $table = new Table();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'store_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Please Select Store',
                    ],
                ],
                'table_number' => [
                    'rules' => 'required|is_unique[tables.table_number,id,' . $id . ']',
                    'errors' => [
                        'required' => 'Please Enter Valid Table Number',
                        'is_unique' => 'Table Number should be unique',
                    ],
                ],
                'table_capacity' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Please Enter Table Capacity',
                    ],
                ],
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $input = $this->request->getVar(null, FILTER_SANITIZE_STRING);
                $input['id'] = $id;

                $table->save($input);
                $session = session();
                $session->setFlashdata('success', 'Successfully updated the table');

                return redirect()->route('admin.tables');
            }
        }

        $data['table'] = $table->where('id', $id)->first();
        if (!$data['table']) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('No record found');
        return view($this->viewPath . '\edit', $data);
    }

    /*
    * delete Table
    */
    public function delete()
    {
        $input = $this->request->getVar(null, FILTER_SANITIZE_STRING);

        $table = new Table();
        $table->whereIn('id', explode(",", $input['delete_id']));
        $table->delete();

        $session = session();
        $session->setFlashdata('success', 'Successfully deleted the table');

        return redirect()->route('admin.tables');
    }
}
