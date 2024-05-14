<?php

class Products extends Controller
{
    public function index()
    {
        $productModel = $this->model('Product');

        $products = $productModel->all();

        $this->view('products/index', $products);
    }

    public function create()
    {
        $categoryModel = $this->model('Category');
        $categoryInfo = $categoryModel->all();
        $this->view('products/create', $categoryInfo);
    }

    public function createProduct()
    {
        $p_name = $_POST['p_name'];
        $p_price = $_POST['p_price'];
        $c_id = $_POST['c_id'];
        $p_description = $_POST['p_description'];

        $productModel = $this->model('Product');

        $response = [];
        if ($productModel->where('p_name', $p_name)->count() < 1) {

            if (preg_match("/^\d+$/", $p_price)) {
                $categoryModel = $this->model('Category');

                if ($categoryModel->where('id', $c_id)->count() === 1) {

                    \Tinify\setKey('vHyYxYpbQ6LZHmzdKc5KFPLvr06PF8cZ');

                    if (isset($_FILES['p_image'])) {
                        $img_name = $_FILES['p_image']['name'];
                        $img_type = $_FILES['p_image']['type'];
                        $tmp_name = $_FILES['p_image']['tmp_name'];

                        $img_explode = explode('.', $img_name);
                        $img_ext = strtolower(end($img_explode));

                        $extensions = ["jpeg", "png", "jpg"];
                        $types = ["image/jpeg", "image/jpg", "image/png"];

                        if (in_array($img_ext, $extensions) && in_array($img_type, $types)) {
                            $filesize = filesize($tmp_name);
                            $sizeInMB = ($filesize / 1024) / 1024;

                            if ($sizeInMB < 10) {

                                $unique_filename = uniqid() . '.' . $img_ext;
                                $file_path = "../public/uploads/" . $unique_filename;

                                try {
                                    $source = \Tinify\fromFile($tmp_name);
                                    $sourceResize = $source->resize(array(
                                        "method" => "cover",
                                        "width" => 300,
                                        "height" => 300
                                    ));

                                    $sourceResize->toFile($file_path);

                                    $productModel->create([
                                        'p_name' => $p_name,
                                        'p_price' => $p_price,
                                        'c_id' => $c_id,
                                        'p_image' => $unique_filename,
                                        'p_description' => $p_description
                                    ]);

                                    $response = [
                                        "success" => true,
                                        "message" => "Success"
                                    ];
                                } catch (\Tinify\Exception $e) {
                                    echo 'Error' . $e->getMessage();
                                }
                            } else {
                                $response = [
                                    "success" => false,
                                    "message" => "Image exceeds 10MB limit"
                                ];
                            }
                        } else {
                            $response = [
                                "success" => false,
                                "message" => "Invalid image type"
                            ];
                        }
                    } else {
                        $response = [
                            "success" => false,
                            "message" => "Please select an image"
                        ];
                    }
                } else {
                    $response = [
                        "success" => false,
                        "message" => "Invalid category"
                    ];
                };
            } else {
                $response = [
                    "success" => false,
                    "message" => "Invalid price specified"
                ];
            }
        } else {
            $response = [
                "success" => false,
                "message" => "Product name already exists"
            ];
        }

        echo json_encode($response);
    }

    public function edit()
    {
        $productModel = $this->model('Product');
        $categoryModel = $this->model('Category');

        $product_id = $_GET['id'];

        $product = $productModel->where('id', $product_id)->first();
        $categories = $categoryModel->all();

        $data = [
            'product' => $product,
            'categories' => $categories
        ];

        $this->view('products/edit', $data);
    }

    public function updateProductInfo()
    {
        $id = $_POST['id'];
        $p_name = $_POST['p_name'];
        $p_price = $_POST['p_price'];
        $c_id = $_POST['c_id'];
        $p_description = $_POST['p_description'];

        $response = [];

        $productModel = $this->model('Product');
        $categoryModel = $this->model('Category');

        if ($productModel->where('id', $id)->count()) {
            if (preg_match("/^\d+(\.\d+)?$/", $p_price)) {

                // update product can't update without an image change which seems a little too strict if you ask me

                if ($categoryModel->where('id', $c_id)->count() === 1) {
                    $productForUpdate = $productModel->find($id);

                    $productForUpdate->p_name = $p_name;
                    $productForUpdate->p_price = $p_price;
                    $productForUpdate->c_id = $c_id;
                    $productForUpdate->p_description = $p_description;

                    $productForUpdate->save();

                    $response = [
                        "success" => true,
                        "message" => "Product updated successfully"
                    ];
                } else {
                    $response = [
                        "success" => false,
                        "message" => "Invalid category selected"
                    ];
                }
            } else {
                $response = [
                    "success" => false,
                    "message" => "Invalid price specified"
                ];
            }
        } else {
            $response = [
                "success" => false,
                "message" => "Invalid product"
            ];
        }

        echo json_encode($response);
    }

    public function updateProductImage()
    {
        $response = [];

        $product_id = $_POST['id'];
        $productModel = $this->model('Product');

        \Tinify\setKey('vHyYxYpbQ6LZHmzdKc5KFPLvr06PF8cZ');

        if ($productModel->where('id', $product_id)->count() === 1) {

            if (isset($_FILES['p_image'])) {
                $img_name = $_FILES['p_image']['name'];
                $img_type = $_FILES['p_image']['type'];
                $tmp_name = $_FILES['p_image']['tmp_name'];

                $img_explode = explode('.', $img_name);
                $img_ext = strtolower(end($img_explode));

                $extensions = ["jpeg", "png", "jpg"];
                $types = ["image/jpeg", "image/jpg", "image/png"];

                if (in_array($img_ext, $extensions) && in_array($img_type, $types)) {
                    $filesize = filesize($tmp_name);
                    $sizeInMB = ($filesize / 1024) / 1024;

                    if ($sizeInMB < 10) {

                        $unique_filename = uniqid() . '.' . $img_ext;
                        $file_path = "../public/uploads/" . $unique_filename;

                        try {
                            $source = \Tinify\fromFile($tmp_name);
                            $sourceResize = $source->resize(array(
                                "method" => "cover",
                                "width" => 300,
                                "height" => 300
                            ));

                            $sourceResize->toFile($file_path);

                            $productForUpdate = $productModel->find($product_id);

                            $productForUpdate->p_image = $unique_filename;

                            $productForUpdate->save();

                            $response = [
                                "success" => true,
                                "message" => "Success"
                            ];
                        } catch (\Tinify\Exception $e) {
                            echo 'Error' . $e->getMessage();
                        }
                    } else {
                        $response = [
                            "success" => false,
                            "message" => "Image exceeds 10MB limit"
                        ];
                    }
                } else {
                    $response = [
                        "success" => false,
                        "message" => "Invalid image type"
                    ];
                }
            } else {
                $response = [
                    "success" => false,
                    "message" => "Please select an image"
                ];
            }
        } else {
            $response = [
                "success" => false,
                "message" => "Referred product not found"
            ];
        }

        echo json_encode($response);
    }

    public function delete()
    {
        if (!isset($_GET['product_id'])) {
            // If not provided, return an error response
            $response = [
                'success' => false,
                'message' => 'Category ID is missing'
            ];
            echo json_encode($response);
            return;
        }



        // Sanitize the input to prevent SQL injection
        $productId = filter_var($_GET['product_id'], FILTER_SANITIZE_NUMBER_INT);

        // Check if the productId is a valid integer
        if ($productId === false || $productId <= 0) {
            // If not a valid integer, return an error response
            $response = [
                'success' => false,
                'message' => 'Invalid Product ID'
            ];
            echo json_encode($response);
            return;
        }

        // Instantiate the Product model
        $productModel = $this->model('Product');

        // Attempt to delete the product
        $result = $productModel->destroy($productId);

        if ($result) {
            // If deletion is successful, return a success response
            $response = [
                'success' => true,
                'message' => 'Product deleted successfully'
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

    public function product()
    {
        $productModel = $this->model('Product');
        $categoryModel = $this->model('Category');

        $product_id = $_GET['product_id'];

        $product = $productModel->where('id', $product_id)->first();

        $this->view('products/product', $product);
    }
}
