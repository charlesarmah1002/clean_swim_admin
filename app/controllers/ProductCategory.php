<?php

class ProductCategory extends Controller
{
    public function index()
    {
        $this->status_check();
        $this->view('productcategory/index');
    }

    public function list()
    {
        $this->status_check();

        $categoryModel = $this->model('Category');
        $response = [];

        $categories = $categoryModel->select(
            'id',
            'p_category'
        )->get();

        if (count($categories) > 0) {
            $response = [
                'success' => true,
                'message' => 'Operation Successful',
                'categories' => $categories
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Operation Failed'
            ];
        }

        echo json_encode($response);
    }

    public function create()
    {
        $this->status_check();
        $category = $_POST['p_category'];

        $response = [];

        $categoryModel = $this->model('Category');

        $numberOfCategories = $categoryModel->where('p_category', $category)->count();

        if ($numberOfCategories == 0) {
            $categoryModel->create([
                'p_category' => $category
            ]);

            $response = [
                'success' => true,
                'message' => 'Category created successfully'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Category already exists'
            ];
        }

        echo json_encode($response);
    }

    public function getCategory()
    {
        $this->status_check();
        $categoryModel = $this->model('Category');

        $category_id = $_GET['category_id'];

        $category = $categoryModel->select(
            'id',
            'p_category'
        )->where('id', $category_id)
            ->first();

        $response = [
            'success' => true,
            'message' => 'Operation Successfull',
            'category' => $category
        ];

        echo json_encode($response);
    }

    public function updateCategory()
    {
        $this->status_check();
        $category_id = $_POST['id'];
        $category = $_POST['p_category'];

        $response = [];

        $categoryModel = $this->model('Category');

        $numberOfCategories = $categoryModel->where('p_category', $category)->count();

        if ($numberOfCategories == 0) {
            $categoryForUpdate = $categoryModel->find($category_id);

            $categoryForUpdate->p_category = $category;

            $categoryForUpdate->save();

            $response = [
                'success' => true,
                'message' => 'Category created successfully'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Category already exists'
            ];
        }

        echo json_encode($response);
    }

    public function products()
    {
        $this->status_check();
        $categoryModel = $this->model('Category');

        $products = $categoryModel->join('products', 'categories.id', '=', 'products.c_id')
            ->select(
                'products.id',
                'products.p_name',
                'products.p_price',
                'products.stock',
                'products.p_image'
            )->where('products.id', $_GET['category_id'])
            ->get();

        $response = [
            'success' => true,
            'message' => 'Operation Successful',
            'products' => $products
        ];

        echo json_encode($response);
    }
}
