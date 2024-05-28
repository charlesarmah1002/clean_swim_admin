<?php

class ProductCategory extends Controller
{
    public function index()
    {
        $this->status_check();
        $this->view('productcategory/index');
    }

    public function getCategories()
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
        $this->view('productcategory/create');
    }

    public function createCategory()
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

    public function delete()
    {
        $this->status_check();
        // Check if the category_id is provided in the POST request
        if (!isset($_GET['category_id'])) {
            // If not provided, return an error response
            $response = [
                'success' => false,
                'message' => 'Category ID is missing'
            ];
            echo json_encode($response);
            return;
        }

        // Sanitize the input to prevent SQL injection
        $categoryId = filter_var($_GET['category_id'], FILTER_SANITIZE_NUMBER_INT);

        // Check if the categoryId is a valid integer
        if ($categoryId === false || $categoryId <= 0) {
            // If not a valid integer, return an error response
            $response = [
                'success' => false,
                'message' => 'Invalid Category ID'
            ];
            echo json_encode($response);
            return;
        }

        // Instantiate the Category model
        $categoryModel = $this->model('Category');

        // Attempt to delete the category
        $result = $categoryModel->destroy($categoryId);

        if ($result) {
            // If deletion is successful, return a success response
            $response = [
                'success' => true,
                'message' => 'Category deleted successfully'
            ];
        } else {
            // If deletion fails, return an error response
            $response = [
                'success' => false,
                'message' => 'Failed to delete category'
            ];
        }

        // Encode the response array into JSON format and echo it
        echo json_encode($response);
    }

    public function edit()
    {
        $this->status_check();
        $categoryModel = $this->model('Category');

        $category_id = $_GET['category_id'];

        $category = $categoryModel->where('id', $category_id)->first();

        $this->view('productcategory/edit', $category);
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
        $productModel = $this->model('Product');

        $products = $productModel->select(
            'id',
            'c_id'
        )->where('c_id', '=', $_GET['category_id'])
            ->get();

            $products = $productModel->join('categories', 'categories.id', '=', 'products.c_id')
            ->select(
                'products.id',
                'products.p_name',
                'products.p_description',
                'products.p_price',
                'products.c_id',
                'products.stock',
                'products.p_image',
                'categories.p_category'
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
