<?php


class Users extends Controller
{
    public function index()
    {
        $this->status_check();
        $userModel = $this->model('User');

        $usersInfo = $userModel->where('user_id', '!=', $_SESSION['id'])
            ->get();

        $this->view('user/index', $usersInfo);
    }

    public function create()
    {
        $this->status_check();
        $this->view('user/create');
    }

    public function createUserProfile()
    {
        $this->status_check();
        $userModel = $this->model('User');

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $countryCode = $_POST['country-code'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];

        // Initialize response array
        $response = [];

        // Check if all required fields are provided
        if (preg_match('/^[a-zA-Z]+$/', $fname) == true && preg_match('/^[a-zA-Z]+$/', $lname) == true) {


            // checking if the email entered is valid
            if (filter_var($email, FILTER_VALIDATE_EMAIL) == true) {
                // checking if the a user already has the email registered
                $usersWithEmail = $userModel->where('email', $email)->count();

                if ($usersWithEmail < 1) {

                    // checking phone and country code
                    if (preg_match('/^\+\d{1,3}$/', $countryCode) == true && preg_match('/^\d+$/', $phone) == true) {

                        // now to check password strength
                        if (preg_match('/^(?=.*[0-9])(?=.*[A-Z])(?=.*[!@#$%^&*()\-_=+{};:,.<>?]).{8,}$/', $password)) {
                            // Check if passwords match
                            if ($password === $confirmPassword) {

                                $enc_pass = password_hash($password, PASSWORD_DEFAULT);

                                if (isset($_FILES['profile_image'])) {

                                    \Tinify\setKey('vHyYxYpbQ6LZHmzdKc5KFPLvr06PF8cZ');

                                    $img_name = $_FILES['profile_image']['name'];
                                    $img_type = $_FILES['profile_image']['type'];
                                    $tmp_name = $_FILES['profile_image']['tmp_name'];

                                    $img_explode = explode('.', $img_name);
                                    $img_ext = strtolower(end($img_explode));

                                    $extensions = ["jpeg", "png", "jpg"];
                                    $types = ["image/jpeg", "image/jpg", "image/png"];

                                    if (in_array($img_ext, $extensions) && in_array($img_type, $types)) {
                                        $filesize = filesize($tmp_name);
                                        $sizeInMB = ($filesize / 1024) / 1024;

                                        if ($sizeInMB < 10) {

                                            $unique_filename = uniqid() . '.' . $img_ext;
                                            $file_path = "../public/uploads/user_images/" . $unique_filename;

                                            try {
                                                $source = \Tinify\fromFile($tmp_name);
                                                $sourceResize = $source->resize(array(
                                                    "method" => "cover",
                                                    "width" => 300,
                                                    "height" => 300
                                                ));

                                                $sourceResize->toFile($file_path);

                                                if ($userModel->create([
                                                    'fname' => $fname,
                                                    'lname' => $lname,
                                                    'email' => $email,
                                                    'country_code' => $countryCode,
                                                    'phone' => $phone,
                                                    'password' => $enc_pass,
                                                    'profile_image' => $unique_filename
                                                ])) {
                                                    $response = [
                                                        'success' => true,
                                                        'message' => 'User account profile created successfully'
                                                    ];
                                                } else {
                                                    // Error creating user (replace with appropriate error handling)
                                                    $response = [
                                                        'success' => false,
                                                        'message' => 'Error creating user.'
                                                    ];
                                                }

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
                                // Passwords do not match
                                $response = [
                                    'success' => false,
                                    'message' => 'Passwords do not match'
                                ];
                            }
                        } else {
                            $response = [
                                'success' => false,
                                'message' => '  Password should be at least 8 characters long.</br>
                                            Contain at least one numeric character. </br>
                                            Contain at least one uppercase letter. </br>
                                            Contain at least one special character from the specified set.',
                            ];
                        }
                    } else {
                        $response = [
                            'success' => false,
                            'message' => 'Invalid country code or number'
                        ];
                    }
                } else {
                    $response = [
                        'success' => false,
                        'message' => 'Email address registered to another user'
                    ];
                }
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Invalid email address'
                ];
            }
        } else {
            // Required fields are empty
            $response = [
                'success' => false,
                'message' => 'Enter a proper name'
            ];
        }


        // Output JSON response
        echo json_encode($response);
    }

    public function profile()
    {
        $this->status_check();

        $userModel = $this->model('User');

        $user = $userModel->where('user_id', $_GET['user_id'])->first();

        $this->view('user/profile', $user);
    }

    public function edit()
    {
        $this->status_check();

        $userModel = $this->model('User');

        $user = $userModel->where('user_id', $_GET['user_id'])->first();

        $this->view('user/edit', $user);
    }

    public function editUserProfile()
    {
        $this->status_check();

        $userModel = $this->model('User');

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $countryCode = $_POST['country-code'];
        $phone = $_POST['phone'];
        $user_id = $_POST['user_id'];
        $user_role = $_POST['user_role'];

        if (preg_match('/^[a-zA-Z]+$/', $fname) == true && preg_match('/^[a-zA-Z]+$/', $lname) == true) {


            // checking if the email entered is valid
            if (filter_var($email, FILTER_VALIDATE_EMAIL) == true) {
                // checking if the a user already has the email registered
                $usersWithEmail = $userModel->where('email', $email)
                    ->where('user_id', '!=', $user_id)
                    ->count();

                if ($usersWithEmail < 1) {

                    // checking phone and country code
                    if (preg_match('/^\+\d{1,3}$/', $countryCode) == true && preg_match('/^\d+$/', $phone) == true) {

                        

                    } else {
                        $response = [
                            'success' => false,
                            'message' => 'Invalid country code or number'
                        ];
                    }
                } else {
                    $response = [
                        'success' => false,
                        'message' => 'Email address registered to another user'
                    ];
                }
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Invalid email address'
                ];
            }
        } else {
            // Required fields are empty
            $response = [
                'success' => false,
                'message' => 'Enter a proper name'
            ];
        }


        // Output JSON response
        echo json_encode($response);
    }
}
