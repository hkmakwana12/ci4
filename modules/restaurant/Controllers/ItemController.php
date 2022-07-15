<?php

namespace Modules\Restaurant\Controllers;

use App\Controllers\AdminController;
use Modules\Restaurant\Models\Category;
use Modules\Restaurant\Models\Store;
use Modules\Restaurant\Models\Item;

class ItemController extends AdminController
{
    private $viewPath = 'Modules\Restaurant\Views\Items';
    /*
     * Display Items Details Action
     */
    public function index()
    {
        $item = new Item();

        $search = $this->request->getVar('search') ?? "";
        $sort = $this->request->getVar('sort');
        $field = $this->request->getVar('field');

        $item->select('items.*, stores.store_name,categories.category_name');
        $item->join('stores', 'stores.id = items.store_id');
        $item->join('categories', 'categories.id = items.category_id');
        $item->orderBy($field ?? 'id', $sort ?? 'DESC');
        $item->groupStart();
        $item->orLike('store_name', $search);
        $item->orLike('category_name', $search);
        $item->orLike('item_name', $search);
        $item->orLike('item_price', $search);
        $item->groupEnd();
        $data['items'] = $item->paginate();

        $data['pagination_link'] = $item->pager;
        $data['search'] = $search;
        $data['sort'] = $sort;
        $data['field'] = $field;

        return view($this->viewPath . '\index', $data);
    }

    /*
    * Create New  Items Action
    */
    public function create()
    {

        $data = [
            'heading' => 'Create New Items',
            'stores' => (new Store())->findAll(),
            'categories' => (new Category())->findAll(),
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
                'category_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Please Select Category',
                    ],
                ],
                'item_name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Please Enter Valid Item Name',
                    ],
                ],
                'item_price' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Please Enter Item Price',
                    ],
                ],
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $input = $this->request->getVar(null, FILTER_SANITIZE_STRING);

                $item = new Item();

                $item->save($input);

                $session = session();
                $session->setFlashdata('success', 'Successfully created new item');

                return redirect()->route('admin.items');
            }
        }

        return view($this->viewPath . '\create', $data);
    }

    /*
    * Update  Item information Action
    */
    public function edit($id = null)
    {

        $data = [
            'heading' => 'Update Item',
            'stores' => (new Store())->findAll(),
            'categories' => (new Category())->findAll(),
        ];

        $data['validation'] = \Config\Services::validation();
        helper(['form']);
        $item = new Item();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'store_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Please Select Store',
                    ],
                ],
                'category_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Please Select Category',
                    ],
                ],
                'item_name' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Please Enter Valid Item Name',
                    ],
                ],
                'item_price' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Please Enter Item Price',
                    ],
                ],
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $input = $this->request->getVar(null, FILTER_SANITIZE_STRING);
                $input['id'] = $id;

                $item->save($input);
                $session = session();
                $session->setFlashdata('success', 'Successfully updated the item');

                return redirect()->route('admin.items');
            }
        }

        $data['item'] = $item->where('id', $id)->first();
        if (!$data['item']) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('No record found');

        return view($this->viewPath . '\edit', $data);
    }

    /*
    * delete Item
    */
    public function delete()
    {
        $input = $this->request->getVar(null, FILTER_SANITIZE_STRING);

        $item = new Item();
        $item->whereIn('id', explode(",", $input['delete_id']));
        $item->delete();

        $session = session();
        $session->setFlashdata('success', 'Successfully deleted the item');

        return redirect()->route('admin.items');
    }
}
