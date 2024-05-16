<?php

class ProductCategory extends Controller
{
    public function index()
    {
        $this->status_check();
        $categoryModel = $this->model('Category');

        $categories = $categoryModel->all();

        $listOfCategories = [];

        foreach ($categories as $category) {
            array_push($listOfCategories, $category);
        }

        $this->view('productcategory/index', $listOfCategories);
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

    public function edit(){
        $this->status_check();
        $categoryModel = $this->model('Category');

        $category_id = $_GET['category_id'];

        $category = $categoryModel->where('id', $category_id)->first();

        $this->view('productcategory/edit', $category);
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
}
