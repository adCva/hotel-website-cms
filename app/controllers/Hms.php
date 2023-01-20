<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Hms extends Controller
{
    public function __construct()
    {
        $this->cmsModel = $this->model("Cms");
    }


    /* ======================================================================= LOGIN, LOGIN VIEW =======================================================================  */
    public function login()
    {
        $data = [
            "username" => "",
            "password" => "",
            "role" => "",
            "usernameError" => "",
            "passwordError" => ""
        ];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                "username" => trim($_POST['username']),
                "password" => trim($_POST['password']),
                "role" => $_POST['role'],
                "usernameError" => "",
                "passwordError" => ""
            ];

            // Check in case JS is disabled in the browser.
            if (empty($data['username'])) {
                $data['usernameError'] = "Please enter a username.";
            } elseif (empty($data['password'])) {
                $data['passwordError'] = "Please enter a password.";
            } elseif (empty($data['usernameError']) && empty($data['passwordError'])) {
                $loggingIn = $this->cmsModel->login($data['username'], $data['password'], $data['role']);

                if ($loggingIn) {
                    session_start();

                    $_SESSION['id'] = $loggingIn->id;
                    $_SESSION['username'] = $loggingIn->username;
                    $_SESSION['name'] = $loggingIn->firstName . " " . $loggingIn->lastName;
                    $_SESSION['role'] = $loggingIn->role;
                    header('Location:' . URLROOT . "/hms/index");
                }
            }
        } else {
            $data = [
                "username" => "",
                "password" => "",
                "role" => "",
                "usernameError" => "",
                "passwordError" => ""
            ];
        }

        $this->view("hms/pages/login", $data);
    }



    /* ======================================================================= LOGOUT =======================================================================  */
    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();

        header('Location:' . URLROOT . "/hms/login");
    }



    /* ======================================================================= INDEX VIEW =======================================================================  */
    public function index()
    {
        session_start();
        $today = date('Y-m-d');
        $restaurantBookingsToday = $this->cmsModel->rowCountColumn('dinner', 'day', $today);
        $internalEventToday = $this->cmsModel->rowCountColumn('event', 'eventDate', $today);
        $helpRequestToday = $this->cmsModel->rowCountColumn('help', 'fromDate', $today);
        $helpRequestDeadlineToday = $this->cmsModel->rowCountColumn('help', 'deadline', $today);
        $hotelReservationToday = $this->cmsModel->rowCountColumn('hotel', 'startAt', $today);
        $hotelReservationCreatedToday = $this->cmsModel->rowCountColumn('hotel', 'created', $today);
        $offerEndingToday = $this->cmsModel->rowCountColumn('offer', 'offerEnd', $today);
        $restaurantEventToday = $this->cmsModel->rowCountColumn('restaurantevents', 'day', $today);
        $reviewAddedToday = $this->cmsModel->rowCountColumn('review', 'created', $today);

        $data = [
            "restaurantBookingsToday" => $restaurantBookingsToday,
            "internalEventToday" => $internalEventToday,
            "helpRequestToday" => $helpRequestToday,
            "helpRequestDeadlineToday" => $helpRequestDeadlineToday,
            "hotelReservationToday" => $hotelReservationToday,
            "hotelReservationCreatedToday" => $hotelReservationCreatedToday,
            "offerEndingToday" => $offerEndingToday,
            "restaurantEventToday" => $restaurantEventToday,
            "reviewAddedToday" => $reviewAddedToday,
        ];

        $this->view("hms/pages/index", $data);
    }



    /* ======================================================================= SEE PROFILE =======================================================================  */
    public function profile($id)
    {
        session_start();
        $resault = $this->cmsModel->getById('users', $id);
        $data = [
            "posts" => $resault
        ];

        $this->view("hms/pages/profile", $data);
    }



    /* ======================================================================= CHANGE PASSWORD =======================================================================  */
    public function changePassword($id)
    {
        session_start();
        $resault = $this->cmsModel->getById('users', $id);
        $data = [
            "posts" => $resault,
            "old" => "",
            "new" => "",
            "confirm" => "",
            "oldError" => "",
            "confirmError" => "",
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                "posts" => $resault,
                "old" => trim($_POST['old']),
                "new" => trim($_POST['new']),
                "confirm" => trim($_POST['confirm']),
                "oldError" => "",
                "confirmError" => "",
            ];

            $checkOne = $this->cmsModel->getById('users', $id);

            // Check in case JS is disabled in the browser and some further checks.
            if (empty($data['old'])) {
                $data['oldError'] = "Current Password is empty.";
            } elseif (!password_verify($data['old'], $checkOne->password)) {
                $data['oldError'] = "Wrong password.";
            } elseif (password_verify($data['new'], $checkOne->password)) {
                $data['confirmError'] = "New password cannot be the same as old password.";
            } elseif (empty($data['new'])) {
                $data['confirmError'] = "New password is empty.";
            } elseif ($data['confirm'] !== $data['new']) {
                $data['confirmError'] = "New password does not math with confirm password.";
            } elseif (strlen($data['new']) <= 6) {
                $data['confirmError'] = "New password must be at least 6 characters long.";
            } elseif (empty($data['confirm'])) {
                $data['confirmError'] = "Confirm New password is empty.";
            } else {
                $hashPwd = password_hash($data['new'], PASSWORD_BCRYPT);
                $this->cmsModel->changePassword($id, $hashPwd);
                header('Location:' . URLROOT . "/hms/profile/" . $data['posts']->id);
                exit();
            }
        }

        $this->view("hms/pages/changePassword", $data);
    }



    /* ======================================================================= CREATE NEW USER =======================================================================  */
    public function addUser()
    {
        session_start();
        $data = [
            "firstName" => "",
            "lastName" => "",
            "username" => "",
            "password" => "",
            "role" => "",
            "createdBy" => "",
            "createdOn" => "",
            "firstNameError" => "",
            "lastNameError" => "",
            "usernameError" => "",
            "passwordError" => "",
            "roleError" => ""
        ];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                "firstName" => trim($_POST['firstName']),
                "lastName" => trim($_POST['lastName']),
                "username" => trim($_POST['username']),
                "password" => trim($_POST['password']),
                "role" => $_POST['role'],
                "createdBy" => $_POST['createdBy'],
                "createdOn" => $_POST['createdOn'],
                "firstNameError" => "",
                "lastNameError" => "",
                "usernameError" => "",
                "passwordError" => "",
                "roleError" => ""
            ];

            // Check in case JS is disabled in the browser.
            if (empty($data['firstName'])) {
                $data['firstNameError'] = "First Name is empty. Please provide one.";
            } elseif (empty($data['lastName'])) {
                $data['lastNameError'] = "Last Name is empty. Please provide one.";
            } elseif (empty($data['username'])) {
                $data['usernameError'] = "Username is empty. Please provide one.";
            } elseif ($this->cmsModel->getUsername($data['username'])) {
                $data['nameError'] = "Username is taken. Please choose a different one.";
            } elseif (empty($data['password'])) {
                $data['passwordError'] = "Password field is empty. Please provide one.";
            } elseif (strlen($data['password']) <= 5) {
                $data['passwordError'] = "Password must be at least 6 characters long.";
            } elseif ($data['role'] == "default") {
                $data['passwordError'] = "Please pick a role for this new user. Empty choosen.";
            } elseif (empty($data['createdBy'])) {
                $data['sessionError'] = "Something went wrong. Please try again.";
            } else {
                $this->cmsModel->create($data['firstName'], $data['lastName'], $data['username'], $data['password'], $data['role'], $data['createdBy'], $data['createdOn']);

                header('Location:' . URLROOT . "/hms/seeUsers");
                exit();
            }
        }

        $this->view("hms/users/add", $data);
    }



    /* ======================================================================= SEE-USER VIEW =======================================================================  */
    public function seeUsers()
    {
        session_start();
        $rows = $this->cmsModel->rowCountAll("users");

        // Pagination
        $resaultPerPage = 10;
        $totalRows = $rows;
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }
        $startingLimitNumber = ($page - 1) * $resaultPerPage;
        $resaults = $this->cmsModel->getList("users", $startingLimitNumber, $resaultPerPage);

        $data = [
            "posts" => $resaults,
            "rows" => $totalRows
        ];

        $this->view("hms/users/see", $data);
    }


    /* ======================================================================= EDIT-USER VIEW =======================================================================  */
    public function editUser($id)
    {
        session_start();
        $resault = $this->cmsModel->getById("users", $id);

        $data = [
            "post" => $resault,
            "firstName" => "",
            "lastName" => "",
            "username" => "",
            "role" => "",
            "createdBy" => "",
            "createdOn" => "",
            "nameError" => "",
            "sessionError" => ""
        ];


        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                "post" => $resault,
                "firstName" => trim($_POST['firstName']),
                "lastName" => trim($_POST['lastName']),
                "username" => trim($_POST['username']),
                "role" => $_POST['role'],
                "createdBy" => $_POST['createdBy'],
                "createdOn" => $_POST['createdOn'],
                "id" =>  $_POST['id'],
                "nameError" => "",
                "sessionError" => ""
            ];

            if ($data['post']->username !== $data['username'] && $this->cmsModel->getUsername($data['username'])) {
                $data['nameError'] = "Username is taken. Please choose a different one.";
            } elseif (empty($data['username'])) {
                $data['nameError'] = "Username is empty. Please choose one.";
            } elseif (empty($data['lastName'])) {
                $data['nameError'] = "Last Name is empty. Please choose one.";
            } elseif (empty($data['firstName'])) {
                $data['nameError'] = "First Name is empty. Please choose one.";
            } elseif (empty($data['createdBy'])) {
                $data['sessionError'] = "Something went wrong. Please try again.";
            } else {
                $this->cmsModel->editUser($data['firstName'], $data['lastName'], $data['username'], $data['role'], $data['createdBy'], $data['createdOn'], $data['id']);
                header('Location:' . URLROOT . "/hms/seeUsers");
                exit();
            }
        }


        $this->view("hms/users/edit", $data);
    }


    /* ======================================================================= DELETE USER =======================================================================  */
    public function deleteUser($id)
    {
        $table = "users";
        $this->cmsModel->delete($table, $id);
        header('Location:' . URLROOT . "/hms/seeUsers");
    }



    /* ======================================================================= EMPLOYEE LIST, EMPLOYEE VIEW =======================================================================  */
    public function employees()
    {
        session_start();
        $rows = $this->cmsModel->rowCountAll("staff");

        // Pagination
        $resaultPerPage = 10;
        $totalRows = $rows;
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }
        $startingLimitNumber = ($page - 1) * $resaultPerPage;
        $resaults = $this->cmsModel->getList("staff", $startingLimitNumber, $resaultPerPage);

        $data = [
            "posts" => $resaults,
            "rows" => $totalRows
        ];

        $this->view("hms/users/employees", $data);
    }



    /* ======================================================================= CREATE EMPLOYEE =======================================================================  */
    public function createEmployee()
    {
        session_start();
        $data = [
            "firstName" => "",
            "lastName" => "",
            "role" => "",
            "employeeddOn" => "",
            "nameError" => "",
            "roleError" => ""

        ];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                "firstName" => trim($_POST['firstName']),
                "lastName" => trim($_POST['lastName']),
                "role" => trim($_POST['role']),
                "employeeddOn" => $_POST['employeeddOn'],
                "nameError" => "",
                "roleError" => ""
            ];

            // Check in case JS is disabled in the browser.
            if (empty($data['firstName'])) {
                $data['nameError'] = "First Name is empty. Please provide one.";
            } elseif (empty($data['lastName'])) {
                $data['nameError'] = "Last Name is empty. Please provide one.";
            } elseif (empty($data['role'])) {
                $data['roleError'] = "Please provide a role.";
            } elseif (empty($data['nameError']) && empty($data['roleError'])) {

                $this->cmsModel->createEmployee($data['firstName'], $data['lastName'], $data['role'], $data['employeeddOn']);
                header('Location:' . URLROOT . "/hms/employees");
                exit();
            }
        }
        $this->view("hms/users/createEmployee", $data);
    }



    /* ======================================================================= DELETE EMPLOYEE =======================================================================  */
    public function deleteEmployee($id)
    {
        $table = "staff";
        $this->cmsModel->delete($table, $id);
        header('Location:' . URLROOT . "/hms/employees");
    }



    /* ======================================================================= ADD ROOM =======================================================================  */
    public function addRoom()
    {
        session_start();
        $data = [
            "image" => "",
            "type" => "",
            "size" => "",
            "bed" => "",
            "description" => "",
            "total" => "",
            "price" => "",
            "imageError" => "",
            "typeError" => "",
            "sizeError" => "",
            "bedError" => "",
            "descriptionError" => "",
            "totalError" => "",
            "priceError" => "",
        ];


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $img = $_FILES['img']['name'];
            $img_temp_loc = $_FILES['img']['tmp_name'];
            $img_store = $_SERVER["DOCUMENT_ROOT"] . "/juno/public/images/" . $img;

            $data = [
                "image" =>  $img,
                "type" => trim($_POST['type']),
                "size" => trim($_POST['size']),
                "bed" => trim($_POST['bed']),
                "description" => trim($_POST['description']),
                "total" => trim($_POST['total']),
                "price" => trim($_POST['price']),
                "imageError" => "",
                "typeError" => "",
                "sizeError" => "",
                "bedError" => "",
                "descriptionError" => "",
                "totalError" => "",
                "priceError" => "",
            ];

            if (empty($data['image'])) {
                $data['imageError'] = "Please add an image.";
            } elseif (empty($data['type'])) {
                $data['typeError'] = "Please add a room type.";
            } elseif (empty($data['size'])) {
                $data['sizeError'] = "Please add room size.";
            } elseif (empty($data['bed'])) {
                $data['bedError'] = "Please add a bed type and number.";
            } elseif (empty($data['description'])) {
                $data['descriptionError'] = "Please describe the room.";
            } elseif (empty($data['total'])) {
                $data['totalError'] = "Please specify how many rooms of this type are there.";
            } elseif (empty($data['price'])) {
                $data['priceError'] = "Please add price.";
            } else {
                move_uploaded_file($img_temp_loc, $img_store);
                $this->cmsModel->addRoom($data['image'], $data['type'], $data['size'], $data['bed'], $data['description'], $data['total'], $data['price']);

                header('Location:' . URLROOT . "/hms/seeRooms");
                exit();
            }
        }


        $this->view("hms/rooms/add", $data);
    }


    /* ======================================================================= SEE ROOMS =======================================================================  */
    public function seeRooms()
    {
        session_start();
        $rows = $this->cmsModel->rowCountAll("room");

        // Pagination
        $resaultPerPage = 10;
        $totalRows = $rows;
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }
        $startingLimitNumber = ($page - 1) * $resaultPerPage;
        $resaults = $this->cmsModel->getList("room", $startingLimitNumber, $resaultPerPage);

        $data = [
            "posts" => $resaults,
            "rows" => $totalRows
        ];

        $this->view("hms/rooms/see", $data);
    }


    /* ======================================================================= ROOM DETAILS =======================================================================  */
    public function roomDetail($id)
    {
        session_start();
        $resault = $this->cmsModel->getById("room", $id);

        $data = [
            "posts" => $resault
        ];

        $this->view("hms/rooms/details", $data);
    }


    /* ======================================================================= EDIT ROOM =======================================================================  */
    public function editRoom($id)
    {
        session_start();
        $resault = $this->cmsModel->getById("room", $id);
        $data = [
            "posts" => $resault,
            "image" => "",
            "type" => "",
            "size" => "",
            "bed" => "",
            "description" => "",
            "total" => "",
            "price" => "",
            "imageError" => "",
            "typeError" => "",
            "sizeError" => "",
            "bedError" => "",
            "descriptionError" => "",
            "totalError" => "",
            "priceError" => "",
        ];


        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $img = $_FILES['img']['name'];
            $img_temp_loc = $_FILES['img']['tmp_name'];
            $img_store = $_SERVER["DOCUMENT_ROOT"] . "/juno/public/images/" . $img;

            $data = [
                "posts" => $resault,
                "image" => $img,
                "type" => trim($_POST['type']),
                "size" => trim($_POST['size']),
                "bed" => trim($_POST['bed']),
                "description" => trim($_POST['description']),
                "total" => trim($_POST['total']),
                "price" => trim($_POST['price']),
                "imageError" => "",
                "typeError" => "",
                "sizeError" => "",
                "bedError" => "",
                "descriptionError" => "",
                "totalError" => "",
                "priceError" => "",
            ];


            if (empty($data['type'])) {
                $data['typeError'] = "Room type cannot be empty.";
            } elseif (empty($data['size'])) {
                $data['sizeError'] = "Room size cannot be empty.";
            } elseif (empty($data['bed'])) {
                $data['bedError'] = "Room bed cannot be empty.";
            } elseif (empty($data['description'])) {
                $data['descriptionError'] = "Room description cannot be empty.";
            } elseif (empty($data['total'])) {
                $data['totalError'] = "Room total cannot be empty.";
            } elseif (empty($data['price'])) {
                $data['priceError'] = "Room price cannot be empty.";
            } else {
                move_uploaded_file($img_temp_loc, $img_store);
                $this->cmsModel->editRoom($data['image'], $data['type'], $data['size'], $data['bed'], $data['description'], $data['total'], $data['price'], $data['posts']->id);

                header('Location:' . URLROOT . "/hms/seeRooms");
                exit();
            }
        }
        $this->view("hms/rooms/edit", $data);
    }



    /* ======================================================================= DELETE ROOM =======================================================================  */
    public function deleteRoom($id)
    {
        $table = "room";
        $this->cmsModel->delete($table, $id);
        header('Location:' . URLROOT . "/hms/seeRooms");
    }



    /* ======================================================================= ADD OFFER =======================================================================  */
    public function addOffer()
    {
        session_start();
        $data = [
            "image" => "",
            "name" => "",
            "start" => "",
            "end" => "",
            "description" => "",
            "price" => "",
            "imageError" => "",
            "nameError" => "",
            "startError" => "",
            "endError" => "",
            "descriptionError" => "",
            "priceError" => ""
        ];


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $img = $_FILES['img']['name'];
            $img_temp_loc = $_FILES['img']['tmp_name'];
            $img_store = $_SERVER["DOCUMENT_ROOT"] . "/juno/public/images/" . $img;

            $data = [
                "image" =>  $img,
                "name" => trim($_POST['name']),
                "start" => trim($_POST['start']),
                "end" => trim($_POST['end']),
                "description" => trim($_POST['description']),
                "price" => trim($_POST['price']),
                "imageError" => "",
                "nameError" => "",
                "startError" => "",
                "endError" => "",
                "descriptionError" => "",
                "priceError" => ""
            ];

            if (empty($data['image'])) {
                $data['imageError'] = "Please add an image.";
            } elseif (empty($data['name'])) {
                $data['nameError'] = "Please add a offer name.";
            } elseif (empty($data['start'])) {
                $data['startError'] = "Please add a starting date for the offer.";
            } elseif (empty($data['end'])) {
                $data['endError'] = "Please add a an ending date for the offer.";
            } elseif (empty($data['description'])) {
                $data['descriptionError'] = "Please describe the room.";
            } elseif (empty($data['price'])) {
                $data['priceError'] = "Please add price.";
            } else {
                move_uploaded_file($img_temp_loc, $img_store);
                $this->cmsModel->addOffer($data['image'], $data['name'], $data['description'], $data['start'], $data['end'], $data['price']);

                header('Location:' . URLROOT . "/hms/seeOffer");
                exit();
            }
        }


        $this->view("hms/offer/add", $data);
    }



    /* ======================================================================= SEE OFFERS =======================================================================  */
    public function seeOffer()
    {
        session_start();
        $rows = $this->cmsModel->rowCountAll("offer");

        // Pagination
        $resaultPerPage = 10;
        $totalRows = $rows;
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }
        $startingLimitNumber = ($page - 1) * $resaultPerPage;
        $resaults = $this->cmsModel->getList("offer", $startingLimitNumber, $resaultPerPage);

        $data = [
            "posts" => $resaults,
            "rows" => $totalRows
        ];

        $this->view("hms/offer/see", $data);
    }




    /* ======================================================================= OFFER DETAILS =======================================================================  */
    public function offerDetail($id)
    {
        session_start();
        $resault = $this->cmsModel->getById("offer", $id);

        $data = [
            "posts" => $resault
        ];

        $archiveDetails = $data['posts']->offerName . "_" .  $data['posts']->offerDescription . "_";

        if (isset($_POST['archive'])) {
            $this->cmsModel->archive('offer', 'From Offer', $archiveDetails, 'Was archived from offer', $_SESSION['username'], date('Y-m-d'));

            $this->cmsModel->delete('offer', $id);

            header("Location: " . URLROOT . "/hms/seeOffer");
            exit;
        }

        $this->view("hms/offer/details", $data);
    }




    /* ======================================================================= EDIT OFFER =======================================================================  */
    public function editOffer($id)
    {
        session_start();
        $resault = $this->cmsModel->getById("offer", $id);
        $data = [
            "posts" => $resault,
            "image" => "",
            "name" => "",
            "start" => "",
            "end" => "",
            "description" => "",
            "price" => "",
            "imageError" => "",
            "nameError" => "",
            "startError" => "",
            "endError" => "",
            "descriptionError" => "",
            "priceError" => ""
        ];


        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $img = $_FILES['img']['name'];
            $img_temp_loc = $_FILES['img']['tmp_name'];
            $img_store = $_SERVER["DOCUMENT_ROOT"] . "/juno/public/images/" . $img;

            $data = [
                "posts" => $resault,
                "image" =>  $img,
                "name" => trim($_POST['name']),
                "start" => trim($_POST['start']),
                "end" => trim($_POST['end']),
                "description" => trim($_POST['description']),
                "price" => trim($_POST['price']),
                "imageError" => "",
                "nameError" => "",
                "startError" => "",
                "endError" => "",
                "descriptionError" => "",
                "priceError" => ""
            ];


            if (empty($data['name'])) {
                $data['nameError'] = "Please add a offer name.";
            } elseif (empty($data['start'])) {
                $data['startError'] = "Please add a starting date for the offer.";
            } elseif (empty($data['end'])) {
                $data['endError'] = "Please add a an ending date for the offer.";
            } elseif (empty($data['description'])) {
                $data['descriptionError'] = "Please describe the room.";
            } elseif (empty($data['price'])) {
                $data['priceError'] = "Please add price.";
            } else {
                move_uploaded_file($img_temp_loc, $img_store);
                $this->cmsModel->editOffer($data['image'], $data['name'], $data['description'], $data['start'], $data['end'], $data['price'], $data['posts']->id);

                header('Location:' . URLROOT . "/hms/seeOffer");
                exit();
            }
        }
        $this->view("hms/offer/edit", $data);
    }



    /* ======================================================================= ADD EVENT =======================================================================  */
    public function addEvent()
    {
        session_start();
        $data = [
            "name" => "",
            "created" => "",
            "description" => "",
            "nameError" => "",
            "createdError" => "",
            "descriptionError" => ""
        ];


        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                "name" => trim($_POST['name']),
                "created" => $_POST['created'],
                "description" => trim($_POST['description']),
                "nameError" => "",
                "createdError" => "",
                "descriptionError" => ""
            ];

            if (empty($_POST['name'])) {
                $data['nameError'] = "Please add a name for the event";
            } elseif (empty($_POST['created'])) {
                $data['createdError'] = "Please add a date for the event";
            } elseif (empty($_POST['description'])) {
                $data['descriptionError'] = "Please add a description for the event";
            } else {
                $this->cmsModel->addEvent($data['name'], $data['created'], $data['description']);
                header('Location:' . URLROOT . "/hms/addEvent");
                exit();
            }
        }
        $this->view("hms/events/add", $data);
    }



    /* ======================================================================= SEE EVENTS =======================================================================  */
    public function seeEvent()
    {
        session_start();
        $rows = $this->cmsModel->rowCountAll("event");

        // Pagination
        $resaultPerPage = 10;
        $totalRows = $rows;
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }
        $startingLimitNumber = ($page - 1) * $resaultPerPage;
        $resaults = $this->cmsModel->getList("event", $startingLimitNumber, $resaultPerPage);

        $data = [
            "posts" => $resaults,
            "rows" => $totalRows
        ];

        // Archive
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            if (isset($_POST['archiveEvent'])) {
                $id = $_POST['id'];
                $singleResault = $this->cmsModel->getById("event", $id);
                $eventDetails = $singleResault->eventName . "_" .  $singleResault->eventDescription . "_";
                // Insert into archive
                $this->cmsModel->archive('event', 'From Internal Events', $eventDetails, 'Internal Events', $_SESSION['username'], date('Y-m-d'));
                // Delete from original table
                $this->cmsModel->delete("event", $singleResault->id);
                header("Location: " . URLROOT . "/hms/seeEvent");
                exit;
            }
        }

        $this->view("hms/events/see", $data);
    }



    /* ======================================================================= RESOLVE EVENT =======================================================================  */
    public function resolveEvent($id)
    {
        $this->cmsModel->resolve($id);
        header('Location:' . URLROOT . "/hms/seeEvent");
    }



    /* ======================================================================= SEE HOTEL RESERVATIONS =======================================================================  */
    public function seeHotelReservation()
    {
        session_start();
        $rows = $this->cmsModel->rowCountAll("hotel");

        // Pagination
        $resaultPerPage = 10;
        $totalRows = $rows;
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }
        $startingLimitNumber = ($page - 1) * $resaultPerPage;


        $resaults = $this->cmsModel->getList("hotel", $startingLimitNumber, $resaultPerPage);
        $data = [
            "posts" => $resaults,
            "rows" => $totalRows
        ];

        $this->view("hms/reservation/hotel", $data);
    }



    /* ======================================================================= HOTEL RESERVATION DETAILS =======================================================================  */
    public function hotelClientDetail($id)
    {
        session_start();
        $resault = $this->cmsModel->getById("hotel", $id);

        $data = [
            "posts" => $resault
        ];

        // Archive
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            if (isset($_POST['archiveBook'])) {

                $archiveHotelDetails = $data['posts']->clientName . "_" .  $data['posts']->roomType . "_" . $data['posts']->clientEmail . "_";

                $this->cmsModel->archive('hotel', 'From Hotel Reservation', $archiveHotelDetails, 'Hotel Reservation', $_SESSION['username'], date('Y-m-d'));
                $this->cmsModel->delete('hotel', $id);

                header("Location: " . URLROOT . "/hms/seeHotelReservation");
                exit;
            }
        }

        $this->view("hms/reservation/hotelDetails", $data);
    }



    /* ======================================================================= SEE RESTAURANT RESERVATION =======================================================================  */
    public function seeRestaurantReservation()
    {
        session_start();
        $rows = $this->cmsModel->rowCountAll("dinner");

        // Pagination
        $resaultPerPage = 10;
        $totalRows = $rows;
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }
        $startingLimitNumber = ($page - 1) * $resaultPerPage;


        $resaults = $this->cmsModel->getList("dinner", $startingLimitNumber, $resaultPerPage);
        $data = [
            "posts" => $resaults,
            "rows" => $totalRows
        ];

        // Archive
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            if (isset($_POST['archiveRest'])) {
                $id = $_POST['id'];
                $singleResault = $this->cmsModel->getById("dinner", $id);
                $eventDetails = $singleResault->clientName . "_" .  $singleResault->day . "_";
                // Insert into archive
                $this->cmsModel->archive('dinner', 'From Restaurant Reservation', $eventDetails, 'Restaurant Reservation', $_SESSION['username'], date('Y-m-d'));
                // Delete from original table
                $this->cmsModel->delete("dinner", $singleResault->id);
                header("Location: " . URLROOT . "/hms/seeRestaurantReservation");
                exit;
            }
        }

        $this->view("hms/reservation/restaurant", $data);
    }



    /* ======================================================================= SEE HELP REQUESTS =======================================================================  */
    public function seeHelp()
    {
        session_start();
        $rows = $this->cmsModel->rowCountAll("help");

        // Pagination
        $resaultPerPage = 10;
        $totalRows = $rows;
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }
        $startingLimitNumber = ($page - 1) * $resaultPerPage;


        $resaults = $this->cmsModel->getList("help", $startingLimitNumber, $resaultPerPage);
        $data = [
            "posts" => $resaults,
            "rows" => $totalRows
        ];

        $this->view("hms/customerHelp/see", $data);
    }



    /* ======================================================================= SEE REQUEST DETAILS =======================================================================  */
    public function requestDetails($id)
    {
        session_start();
        $resault = $this->cmsModel->getById("help", $id);

        $data = [
            "posts" => $resault
        ];
        // Archive
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if (isset($_POST['archiveHelp'])) {
                $archiveDetails = $data['posts']->client . "_" .  $data['posts']->clientEmail . "_" . $data['posts']->description . "_" . $data['posts']->resolvedDate . "_" . $data['posts']->solution;
                $this->cmsModel->archive('help', 'From Help Request', $archiveDetails, 'Help Request', $_SESSION['username'], date('Y-m-d'));

                $this->cmsModel->delete('help', $id);

                header("Location: " . URLROOT . "/hms/seeHelp");
                exit;
            }
        }

        $this->view("hms/customerHelp/details", $data);
    }



    /* ======================================================================= RESOLVE REQUEST =======================================================================  */
    public function resolveRequest($id)
    {
        session_start();

        $resault = $this->cmsModel->getById('help', $id);

        $data = [
            "posts" => $resault,
            "solution" => "",
            "solutionError" => ""
        ];


        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                "to" => trim($_POST['emailTo']),
                "user" => $_POST['user'],
                "date" => date('Y-m-d'),
                "solution" => trim($_POST['solution']),
                "subject" => trim($_POST['subject']),
                "solutionError" => ""
            ];

            if (empty($_POST['solution'])) {
                $data['solutionError'] = "Please add a solution";
            } else {

                $mail = new PHPMailer(true);
                try {
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                    $mail->isSMTP();
                    $mail->Host       = '';
                    // Successfully tested with smtp.gmail.com with an app-specific passwords
                    $mail->SMTPAuth   = true;
                    $mail->Username   = '';
                    $mail->Password   = '';
                    $mail->SMTPSecure = "TLS";
                    $mail->Port       = 587;
                    $mail->setFrom('', "Juno Hotel");
                    $mail->addAddress($data['to']);
                    $mail->isHTML(true);
                    $mail->Subject = $data['subject'];
                    $mail->Body    = $data['solution'];

                    $mail->send();

                    $this->cmsModel->resolveRequest($id, $data['user'], $data['date'], $data['solution']);
                    header('Location:' . URLROOT . "/hms/seeHelp");
                    exit();
                } catch (Exception $e) {
                    echo $e;
                }
            }
        }
        $this->view("hms/customerHelp/respond", $data);
    }



    /* ======================================================================= SEE RESTAURANT MENU =======================================================================  */
    public function seeMenu()
    {
        session_start();
        $rows = $this->cmsModel->rowCountAll("menu");

        // Pagination
        $resaultPerPage = 10;
        $totalRows = $rows;
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }
        $startingLimitNumber = ($page - 1) * $resaultPerPage;


        $resaults = $this->cmsModel->getList("menu", $startingLimitNumber, $resaultPerPage);
        $data = [
            "posts" => $resaults,
            "rows" => $totalRows
        ];

        $this->view("hms/restaurant/menu", $data);
    }



    /* ======================================================================= ADD MENU ITEM =======================================================================  */
    public function addMenuItem()
    {
        session_start();
        $data = [
            "img" => "",
            "name" => "",
            "ingredients" => "",
            "description" => "",
            "price" => "",
            "nameError" => "",
            "ingredientsError" => "",
            "descriptionError" => "",
            "priceError" => ""
        ];


        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $img = $_FILES['img']['name'];
            $img_temp_loc = $_FILES['img']['tmp_name'];
            $img_store = $_SERVER["DOCUMENT_ROOT"] . "/juno/public/images/" . $img;

            $data = [
                "img" => $img,
                "name" => trim($_POST['name']),
                "ingredients" => $_POST['ingredients'],
                "description" => trim($_POST['description']),
                "price" => $_POST['price'],
                "nameError" => "",
                "ingredientsError" => "",
                "descriptionError" => "",
                "priceError" => ""
            ];

            if (empty($_POST['name'])) {
                $data['nameError'] = "Please add a name for the food";
            } elseif (empty($_POST['ingredients'])) {
                $data['ingredientsError'] = "Please add ingredients";
            } elseif (empty($_POST['description'])) {
                $data['descriptionError'] = "Please add a description";
            } else {
                $this->cmsModel->addMenuItem($data['name'], $data['ingredients'], $data['price'], $data['description'], $data['img']);
                move_uploaded_file($img_temp_loc, $img_store);

                header('Location:' . URLROOT . "/hms/seeMenu");
                exit();
            }
        }
        $this->view("hms/restaurant/addMenuItem", $data);
    }



    /* ======================================================================= SEE MENU DETAILS =======================================================================  */
    public function menuDetails($id)
    {
        session_start();
        $resault = $this->cmsModel->getById("menu", $id);

        $data = [
            "posts" => $resault
        ];

        // Archive
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if (isset($_POST['archiveMenu'])) {
                $archiveDetails = $data['posts']->name . "_" .  $data['posts']->description;
                $this->cmsModel->archive('menu', 'From Restaurant Menu', $archiveDetails, 'From Restaurant Menu', $_SESSION['username'], date('Y-m-d'));

                $this->cmsModel->delete('menu', $id);

                header("Location: " . URLROOT . "/hms/seeMenu");
                exit;
            }
        }

        $this->view("hms/restaurant/menuDetails", $data);
    }



    /* ======================================================================= EDIT MENU ITEM =======================================================================  */
    public function editMenuItem($id)
    {
        session_start();
        $resault = $this->cmsModel->getById("menu", $id);

        $data = [
            "posts" => $resault,
            "image" => "",
            "name" => "",
            "ingredients" => "",
            "price" => "",
            "description" => "",
            "imageError" => "",
            "nameError" => "",
            "ingredientsError" => "",
            "priceError" => "",
            "descriptionError" => ""
        ];


        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $img = $_FILES['img']['name'];
            $img_temp_loc = $_FILES['img']['tmp_name'];
            $img_store = $_SERVER["DOCUMENT_ROOT"] . "/juno/public/images/" . $img;

            $data = [
                "posts" => $resault,
                "image" =>  $img,
                "name" => trim($_POST['name']),
                "ingredients" => trim($_POST['ingredients']),
                "price" => trim($_POST['price']),
                "description" => trim($_POST['description']),
                "imageError" => "",
                "nameError" => "",
                "ingredientsError" => "",
                "priceError" => "",
                "descriptionError" => ""
            ];


            if (empty($data['name'])) {
                $data['nameError'] = "Please add a offer name.";
            } elseif (empty($data['ingredients'])) {
                $data['ingredientsError'] = "Please add a starting date for the offer.";
            } elseif (empty($data['description'])) {
                $data['descriptionError'] = "Please describe the room.";
            } elseif (empty($data['price'])) {
                $data['priceError'] = "Please add price.";
            } else {
                move_uploaded_file($img_temp_loc, $img_store);
                $this->cmsModel->editMenu($data['posts']->id, $data['name'], $data['ingredients'], $data['price'], $data['description'], $data['image']);

                header('Location:' . URLROOT . "/hms/seeMenu");
                exit();
            }
        }
        $this->view("hms/restaurant/editMenuItem", $data);
    }



    /* ======================================================================= SEE RESTAURANT EVENTS =======================================================================  */
    public function seeRestaurantEvents()
    {
        session_start();
        $rows = $this->cmsModel->rowCountAll("restaurantevents");

        // Pagination
        $resaultPerPage = 10;
        $totalRows = $rows;
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }
        $startingLimitNumber = ($page - 1) * $resaultPerPage;


        $resaults = $this->cmsModel->getList("restaurantevents", $startingLimitNumber, $resaultPerPage);
        $data = [
            "posts" => $resaults,
            "rows" => $totalRows
        ];

        $this->view("hms/restaurant/events", $data);
    }



    /* ======================================================================= ADD RESTAURANT EVENT =======================================================================  */
    public function addRestaurantEvent()
    {
        session_start();
        $data = [
            "img" => "",
            "name" => "",
            "details" => "",
            "day" => "",
            "price" => "",
            "nameError" => "",
            "detailsError" => "",
            "dayError" => "",
            "priceError" => ""
        ];


        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $img = $_FILES['img']['name'];
            $img_temp_loc = $_FILES['img']['tmp_name'];
            $img_store = $_SERVER["DOCUMENT_ROOT"] . "/juno/public/images/" . $img;

            $data = [
                "img" => $img,
                "name" => trim($_POST['name']),
                "details" => trim($_POST['details']),
                "day" => $_POST['day'],
                "price" => $_POST['price'],
                "nameError" => "",
                "detailsError" => "",
                "dayError" => "",
                "priceError" => ""
            ];

            if (empty($_POST['name'])) {
                $data['nameError'] = "The event needs a name.";
            } elseif (empty($_POST['details'])) {
                $data['detailsError'] = "Add some details.";
            } elseif (empty($_POST['day'])) {
                $data['dayError'] = "The event needs a day.";
            } elseif (empty($_POST['price'])) {
                $data['priceError'] = "The event needs a price.";
            } else {
                $this->cmsModel->addRestEvent($data['name'], $data['details'], $data['day'], $data['price'], $data['img']);
                move_uploaded_file($img_temp_loc, $img_store);

                header('Location:' . URLROOT . "/hms/seeRestaurantEvents");
                exit();
            }
        }
        $this->view("hms/restaurant/addEvent", $data);
    }



    /* ======================================================================= SEE RESTAURANT EVENTS DETAILS =======================================================================  */
    public function eventsRestDetails($id)
    {
        session_start();
        $table = "restaurantevents";
        $resault = $this->cmsModel->getById("restaurantevents", $id);

        $data = [
            "posts" => $resault
        ];

        // Archive
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if (isset($_POST['archiveRestEvent'])) {
                $archiveDetails = $data['posts']->name . "_" .  $data['posts']->details . "_" . $data['posts']->day;
                $this->cmsModel->archive('restaurantevents', 'From Restaurant Event', $archiveDetails, 'From Restaurant Event', $_SESSION['username'], date('Y-m-d'));

                $this->cmsModel->delete('restaurantevents', $id);

                header("Location: " . URLROOT . "/hms/seeRestaurantEvents");
                exit;
            }
        }

        $this->view("hms/restaurant/eventDetails", $data);
    }


    /* ======================================================================= EDIT RESTAURANT EVENT =======================================================================  */
    public function editRestEvent($id)
    {
        session_start();
        $resault = $this->cmsModel->getById("restaurantevents", $id);

        $data = [
            "posts" => $resault,
            "image" => "",
            "name" => "",
            "details" => "",
            "day" => "",
            "price" => "",
            "imageError" => "",
            "nameError" => "",
            "detailsError" => "",
            "dayError" => "",
            "priceError" => ""
        ];


        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $img = $_FILES['img']['name'];
            $img_temp_loc = $_FILES['img']['tmp_name'];
            $img_store = $_SERVER["DOCUMENT_ROOT"] . "/juno/public/images/" . $img;

            $data = [
                "posts" => $resault,
                "image" =>  $img,
                "name" => trim($_POST['name']),
                "details" => trim($_POST['details']),
                "day" => trim($_POST['day']),
                "price" => trim($_POST['price']),
                "imageError" => "",
                "nameError" => "",
                "detailsError" => "",
                "dayError" => "",
                "priceError" => ""
            ];


            if (empty($data['name'])) {
                $data['nameError'] = "Please add a offer name.";
            } elseif (empty($data['details'])) {
                $data['detailsError'] = "Please add a starting date for the offer.";
            } elseif (empty($data['day'])) {
                $data['dayError'] = "Please describe the room.";
            } elseif (empty($data['price'])) {
                $data['priceError'] = "Please add price.";
            } else {
                move_uploaded_file($img_temp_loc, $img_store);
                $this->cmsModel->editRestEvent($data['posts']->id, $data['name'], $data['details'], $data['day'], $data['price'], $data['image']);

                header('Location:' . URLROOT . "/hms/seeRestaurantEvents");
                exit();
            }
        }
        $this->view("hms/restaurant/editEvent", $data);
    }



    /* ======================================================================= SEE REVIEWS =======================================================================  */
    public function seeReviews()
    {
        session_start();
        $rows = $this->cmsModel->rowCountAll("review");
        $totalActiveReviews = $this->cmsModel->rowCountColumn('review', 'status', 'active');

        // Pagination
        $resaultPerPage = 10;
        $totalRows = $rows;
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }
        $startingLimitNumber = ($page - 1) * $resaultPerPage;


        $resaults = $this->cmsModel->getList("review", $startingLimitNumber, $resaultPerPage);
        $data = [
            "posts" => $resaults,
            "rows" => $totalRows,
            "totalActive" => $totalActiveReviews
        ];

        $this->view("hms/reviews/see", $data);
    }


    /* ======================================================================= SEE REVIEWS DETAILS =======================================================================  */
    public function reviewDetail($id)
    {
        session_start();
        $resault = $this->cmsModel->getById("review", $id);

        $data = [
            "posts" => $resault
        ];

        // Archive
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if (isset($_POST['archiveReview'])) {
                $archiveDetails = $data['posts']->fromClient . "_" .  $data['posts']->clientEmail . "_" . $data['posts']->description;
                $this->cmsModel->archive('review', 'From Review', $archiveDetails, 'Review', $_SESSION['username'], date('Y-m-d'));

                $this->cmsModel->delete('review', $id);

                header("Location: " . URLROOT . "/hms/seeHelp");
                exit;
            }
        }

        $this->view("hms/reviews/details", $data);
    }



    /* ======================================================================= CHANGE REVIEW STATUS TO ACTIVE =======================================================================  */
    public function reviewStatus($id, $status)
    {
        $resault = $this->cmsModel->rowCountColumn('review', 'status', 'active');

        if ($status == "active" && $resault >= 5) {
            header('Location:' . URLROOT . "/hms/seeReviews?nomorethen5");
        } else {
            $this->cmsModel->reviewStatus($id, $status);
            header('Location:' . URLROOT . "/hms/seeReviews");
            exit();
        }
    }



    /* ======================================================================= SEE ARCHIVE =======================================================================  */
    public function seeArchive()
    {
        session_start();
        $rows = $this->cmsModel->rowCountAll("archive");

        // Pagination
        $resaultPerPage = 10;
        $totalRows = $rows;
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }
        $startingLimitNumber = ($page - 1) * $resaultPerPage;


        $resaults = $this->cmsModel->getList("archive", $startingLimitNumber, $resaultPerPage);
        $data = [
            "posts" => $resaults,
            "rows" => $totalRows
        ];

        $this->view("hms/archive/see", $data);
    }



    /* ======================================================================= ARCHIVE DETAILS =======================================================================  */
    public function archiveDetail($id)
    {
        session_start();
        $table = "archive";
        $resault = $this->cmsModel->getById($table, $id);

        $data = [
            "posts" => $resault
        ];

        $this->view("hms/archive/details", $data);
    }



    /* ======================================================================= DELETE ARCHIVE =======================================================================  */
    public function deleteArchive($id)
    {
        $table = "archive";
        $this->cmsModel->delete($table, $id);
        header('Location:' . URLROOT . "/hms/seeArchive");
    }
}
