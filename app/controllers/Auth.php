<?php

// use App\Models\User;

class Auth extends Controller
{
    public function index()
    {
        // Assuming $this->view() is a method to render a view
        // Implement your view rendering logic here
        if (isset($_SESSION['id'])) {
            header('location: ../home');
        } else {
            $this->view('auth/index');
        }
    }

    public function register()
    {
        $this->view('auth/register');
    }

    public function create()
    {
        // Retrieve form data
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'] ?? '';
        $countryCode = $_POST['country-code'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        // Initialize response array
        $response = [];

        // Check if all required fields are provided
        if (preg_match('/^[a-zA-Z]+$/', $fname) == true && preg_match('/^[a-zA-Z]+$/', $lname) == true) {


            // checking if the email entered is valid
            if (filter_var($email, FILTER_VALIDATE_EMAIL) == true) {
                // checking if the a user already has the email registered
                $usersWithEmail = User::where('email', $email)->count();

                if ($usersWithEmail < 1) {

                    // checking phone and country code
                    if (preg_match('/^\+\d{1,3}$/', $countryCode) == true && preg_match('/^\d+$/', $phone) == true) {

                        // now to check password strength
                        if (preg_match('/^(?=.*[0-9])(?=.*[A-Z])(?=.*[!@#$%^&*()\-_=+{};:,.<>?]).{8,}$/', $password)) {
                            // Check if passwords match
                            if ($password === $confirmPassword) {

                                // Create user (replace with your database logic)
                                $userCreated = $this->createUser($fname, $lname, $email, $countryCode, $phone, $password);

                                if ($userCreated) {

                                    // now retrieve user information for the session
                                    $userInfo = User::where('email', $email)->first();

                                    $_SESSION['id'] = $userInfo['user_id'];
                                    $_SESSION['fname'] = $userInfo['fname'];
                                    $_SESSION['lname'] = $userInfo['lname'];
                                    $_SESSION['email'] = $userInfo['email'];
                                    $_SESSION['country_code'] = $userInfo['country_code'];
                                    $_SESSION['phone'] = $userInfo['phone'];
                                    $_SESSION['role'] = $userInfo['role'];

                                    // User created successfully
                                    $response = [
                                        'success' => true,
                                        'message' => 'User created successfully.'
                                    ];
                                } else {
                                    // Error creating user (replace with appropriate error handling)
                                    $response = [
                                        'success' => false,
                                        'message' => 'Error creating user.'
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

    // Example method to create a user (replace with your database logic)
    private function createUser($fname, $lname, $email, $countryCode, $phone, $password)
    {
        User::create([
            'fname' => $fname,
            'lname' => $lname,
            'email' => $email,
            'country_code' => $countryCode,
            'phone' => $phone,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);

        // For demonstration purposes, return true
        return true;
    }

    public function validateUser()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $response = [];

        if (filter_var($email, FILTER_VALIDATE_EMAIL) == true) {

            $userInfo = User::where('email', $email)->first();

            if ($userInfo != null) {
                $userpassword = $userInfo->password;

                // $verified = password_verify($password, $userpassword);

                if (password_verify($password, $userpassword)) {

                    $_SESSION['id'] = $userInfo['user_id'];
                    $_SESSION['fname'] = $userInfo['fname'];
                    $_SESSION['lname'] = $userInfo['lname'];
                    $_SESSION['email'] = $userInfo['email'];
                    $_SESSION['country_code'] = $userInfo['country_code'];
                    $_SESSION['phone'] = $userInfo['phone'];
                    $_SESSION['role'] = $userInfo['role'];

                    $response = [
                        'success' => true,
                        'message' => 'Verified'
                    ];
                } else {
                    $response = [
                        'success' => false,
                        'message' => 'Incorrect password'
                    ];
                }
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Email address does not exist please register'
                ];
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'Please enter your email address'
            ];
        }

        // Output JSON response
        echo json_encode($response);
    }

    public function getUser()
    {
        
    }
}
