<?php

namespace Modules\Restaurant\Controllers;

use App\Controllers\AdminController;
use Modules\Restaurant\Models\Store;
use Modules\Restaurant\Models\Category;

class CategoryController extends AdminController
{
    private $viewPath = 'Modules\Restaurant\Views\Categories';
    /*
     * Display Categories Details Action
     */
    public function index()
    {
        $category = new Category();

        $search = $this->request->getVar('search') ?? "";
        $sort = $this->request->getVar('sort');
        $field = $this->request->getVar('field');

        $category->select('categories.*, stores.store_name');
        $category->join('stores', 'stores.id = categories.store_id');
        $category->orderBy($field ?? 'id', $sort ?? 'DESC');
        $category->groupStart();
        $category->orLike('store_name', $search);
        $category->orLike('category_name', $search);
        $category->groupEnd();
        $data['categories'] = $category->paginate();

        $data['pagination_link'] = $category->pager;
        $data['search'] = $search;
        $data['sort'] = $sort;
        $data['field'] = $field;

        return view($this->viewPath . '\index', $data);
    }

    /*
    * Create New  Categories Action
    */
    public function create()
    {

        $data = [
            'heading' => 'Create New Categories',
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
                'category_name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Please Enter Category',
                    ],
                ],
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $input = $this->request->getVar(null, FILTER_SANITIZE_STRING);
                $category = new Category();

                $category->save($input);

                $session = session();
                $session->setFlashdata('success', 'Successfully created new category');

                return redirect()->route('admin.categories');
            }
        }

        return view($this->viewPath . '\create', $data);
    }

    /*
    * Update  Category information Action
    */
    public function edit($id = null)
    {

        $data = [
            'heading' => 'Update Category',
            'stores' => (new Store())->findAll(),
        ];

        $data['validation'] = \Config\Services::validation();
        helper(['form']);
        $category = new Category();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'store_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Please Select Store',
                    ],
                ],
                'category_name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Please Enter Category',
                    ],
                ],
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $input = $this->request->getVar(null, FILTER_SANITIZE_STRING);
                $input['id'] = $id;

                $category->save($input);
                $session = session();
                $session->setFlashdata('success', 'Successfully updated the category');

                return redirect()->route('admin.categories');
            }
        }

        $data['category'] = $category->where('id', $id)->first();
        return view($this->viewPath . '\edit', $data);
    }

    /*
    * delete Category
    */
    public function delete()
    {
        $input = $this->request->getVar(null, FILTER_SANITIZE_STRING);

        $category = new Category();
        $category->whereIn('id', explode(",", $input['delete_id']));
        $category->delete();

        $session = session();
        $session->setFlashdata('success', 'Successfully deleted the category');

        return redirect()->route('admin.categories');
    }
}
