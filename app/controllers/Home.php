<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Home extends Controller
{
    public function __construct()
    {
        $this->homeModel = $this->model("Landing");
    }


    // ================================================================= INDEX PAGE ================================================================= /*
    public function index()
    {

        $roomsResaults = $this->homeModel->getRooms();
        $offerResaults = $this->homeModel->getOffers();
        $reviewsResaults = $this->homeModel->getReviews();

        $data = [
            "roomsResaults" => $roomsResaults,
            "offerResaults" => $offerResaults,
            "reviewsResaults" => $reviewsResaults,
            // Hotel booking 
            "hotelArrival" => "",
            "hotelDeparture" => "",
            "hotelName" => "",
            // Restaurant booking 
            "restaurantName" => "",
            "restaurantDate" => "",
            "restaurantPersons" => "",
            "restauranHour" => "",
            // Reviews
            "reviewName" => "",
            "reviewEmail" => "",
            "reviewDescription" => "",
            // Messages
            "errorMessage" => "",
            "successMessage" => "",
            "reviewMessage" => ""

        ];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // REDIRECT TO HOTEL BOOKING PAGE
            if (isset($_POST['bookHotel'])) {
                $data = [
                    "roomsResaults" => $roomsResaults,
                    "offerResaults" => $offerResaults,
                    "reviewsResaults" => $reviewsResaults,
                    // Hotel booking 
                    "hotelArrival" => $_POST['arrival'],
                    "hotelDeparture" => $_POST['departure'],
                    "hotelName" => trim($_POST['nameHotel']),
                    // Restaurant booking 
                    "restaurantName" => "",
                    "restaurantDate" => "",
                    "restaurantPersons" => "",
                    "restauranHour" => "",
                    // Reviews
                    "reviewName" => "",
                    "reviewEmail" => "",
                    "reviewDescription" => "",
                    // Messages
                    "errorMessage" => "",
                    "successMessage" => "",
                    "reviewMessage" => ""
                ];

                // Check in case JS is disabled in the browser.
                if (empty($data['hotelArrival'])) {
                    $data['errorMessage'] = "Please add a valid arrival date.";
                } elseif ($data['hotelArrival'] < date("Y-m-d")) {
                    $data['errorMessage'] = "Please add a valid arrival date.";
                } elseif (empty($data['hotelDeparture'])) {
                    $data['errorMessage'] = "Please add a valid departure date.";
                } elseif ($data['hotelDeparture'] < date("Y-m-d")) {
                    $data['errorMessage'] = "Please add a valid departure date.";
                } elseif (empty($data['hotelName'])) {
                    $data['errorMessage'] = "Please add a name.";
                } else {
                    header("Location:" . URLROOT . "/home/hotelBooking/" . $data['hotelArrival'] . "/" . $data['hotelDeparture'] . "/" . $data['hotelName']);
                }
            }
            // END OF REDIRECT TO HOTEL BOOKING PAGE


            // ADD RESTAURANT RESERVATION
            if (isset($_POST['restaurantBook'])) {

                $data = [
                    "roomsResaults" => $roomsResaults,
                    "offerResaults" => $offerResaults,
                    "reviewsResaults" => $reviewsResaults,
                    // Hotel booking 
                    "hotelArrival" => "",
                    "hotelDeparture" => "",
                    "hotelName" => "",
                    // Restaurant booking 
                    "restaurantClientName" => trim($_POST['restName']),
                    "restaurantDate" => $_POST['restDate'],
                    "restaurantPersons" => $_POST['restAdults'],
                    "restauranHour" => $_POST['restHour'],
                    // Reviews
                    "reviewName" => "",
                    "reviewEmail" => "",
                    "reviewDescription" => "",
                    // Messages
                    "errorMessage" => "",
                    "successMessage" => "",
                    "reviewMessage" => ""
                ];

                // Check in case JS is disabled in the browser.
                if (empty($data['restaurantDate'])) {
                    $data['errorMessage'] = "Please select a valid date.";
                } elseif ($data['restaurantDate'] < date("Y-m-d")) {
                    $data['errorMessage'] = "Please select a valid date.";
                } elseif (empty($data['restaurantPersons'])) {
                    $data['errorMessage'] = "Please select the number of people.";
                } elseif ($data['restaurantPersons'] == "null") {
                    $data['errorMessage'] = "Please select the number of people.";
                } elseif (empty($data['restauranHour'])) {
                    $data['errorMessage'] = "Please select an hour.";
                } elseif ($data['restauranHour'] == "null") {
                    $data['errorMessage'] = "Please select an hour.";
                } elseif (empty($data['restaurantClientName'])) {
                    $data['errorMessage'] = "Please add a name.";
                } else {
                    $this->homeModel->makeRestaurantReservation($data['restaurantClientName'], $data['restaurantPersons'], $data['restaurantDate'], $data['restauranHour']);
                    header("Location:" . URLROOT . "/home/message/restaurant");
                    die();
                }
            }
            // END OF ADD RESTAURANT RESERVATION


            // ADD A REVIEW
            if (isset($_POST['review'])) {
                $data = [
                    "roomsResaults" => $roomsResaults,
                    "offerResaults" => $offerResaults,
                    "reviewsResaults" => $reviewsResaults,
                    // Hotel booking 
                    "hotelArrival" => "",
                    "hotelDeparture" => "",
                    "hotelName" => "",
                    "bookMessage" => "",
                    // Restaurant booking 
                    "restaurantName" => "",
                    "restaurantDate" => "",
                    "restaurantPersons" => "",
                    "restauranHour" => "",
                    "bookRestMessage" => "",
                    // Reviews
                    "reviewName" => trim($_POST['reviewerName']),
                    "reviewEmail" => trim($_POST['reviewerEmail']),
                    "reviewDescription" => trim($_POST['reviewDescription']),
                    "reviewMessage" => ""
                ];

                // Check in case JS is disabled in the browser.
                if (empty($data['reviewName'])) {
                    $data['reviewMessage'] = "Please add a name.";
                } elseif (empty($data['reviewEmail'])) {
                    $data['reviewMessage'] = "Please add an email.";
                } elseif (empty($data['reviewDescription'])) {
                    $data['reviewMessage'] = "The review is empty. Please add a description.";
                } else {

                    $this->homeModel->addReview($data['reviewName'], $data['reviewEmail'], $data['reviewDescription'], date("Y-m-d"));

                    $data['reviewMessage'] = "Review added successfully. Thank you!";
                    header("Location:" . URLROOT . "/home/message/review");
                    die();
                }
            }
            // END OF ADD A REVIEW
        }

        $this->view("hotel/pages/index", $data);
    }


    // ================================================================= ABOUT PAGE ================================================================= /*
    public function about()
    {
        $data = [];
        $this->view("hotel/pages/about", $data);
    }


    // ================================================================= BUSINESS PAGE ================================================================= /*
    public function business()
    {
        $data = [];
        $this->view("hotel/pages/business", $data);
    }


    // ================================================================= ROOMS PAGE ================================================================= /*
    public function rooms()
    {
        // Plural
        $resault = $this->homeModel->getRooms();

        $data = [
            "rooms" => $resault,
            "room" => "",
            "arrival" => "",
            "departure" => "",
            "name" => "",
            "checkRoom" => "",
            "checkDate" => "",
            "hotelMessage" => "",
            "hotelMessageSuccess" => ""
        ];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // REDIRECT TO HOTEL BOOKING PAGE
            if (isset($_POST['bookHotel'])) {
                $data = [
                    "rooms" => $resault,
                    "room" => "",
                    "arrival" => $_POST['arrival'],
                    "departure" => $_POST['departure'],
                    "name" => trim($_POST['name']),
                    "checkRoom" => "",
                    "checkDate" => "",
                    "hotelMessage" => "",
                    "hotelMessageSuccess" => ""
                ];

                // Check in case JS is disabled in the browser.
                if (empty($data['arrival'])) {
                    $data['hotelMessage'] = "Please add a valid arrival date.";
                } elseif ($data['arrival'] < date("Y-m-d")) {
                    $data['hotelMessage'] = "Please add a valid arrival date.";
                } elseif (empty($data['departure'])) {
                    $data['hotelMessage'] = "Please add a valid departure date.";
                } elseif ($data['departure'] < date("Y-m-d")) {
                    $data['hotelMessage'] = "Please add a valid departure date.";
                } elseif (empty($data['name'])) {
                    $data['hotelMessage'] = "Please add a name.";
                } else {
                    header("Location:" . URLROOT . "/home/hotelBooking/" . $data['arrival'] . "/" . $data['departure'] . "/" . $data['name']);
                    exit();
                }
            }
            // END OF REDIRECT TO HOTEL BOOKING PAGE


            // CHECK HOTEL AVAILABILITY
            if (isset($_POST['checkHotel'])) {
                $data = [
                    "rooms" => $resault,
                    "room" => "",
                    "arrival" => "",
                    "departure" => "",
                    "name" => "",
                    "checkRoom" => $_POST['checkRoom'],
                    "checkDate" => $_POST['checkDate'],
                    "hotelMessage" => "",
                    "hotelMessageSuccess" => ""
                ];

                // Check in case JS is disabled in the browser.
                if (empty($data['checkDate'])) {
                    $data['hotelMessage'] = "Please add a valid date.";
                } elseif ($data['checkDate'] < date("Y-m-d")) {
                    $data['hotelMessage'] = "Please add a valid date.";
                } elseif (empty($data['checkRoom'])) {
                    $data['hotelMessage'] = "Please select a room.";
                } else {
                    $initialResault = $this->homeModel->checkHotel($data['checkDate'], $data['checkRoom']);
                    $checkResault = $initialResault;

                    $singleResault = $this->homeModel->getRoom($data['checkRoom']);
                    $nrOffRooms = (int)$singleResault->roomTotal_Of_Type;

                    if ($checkResault >= $nrOffRooms) {
                        $data['hotelMessage'] = "There are no rooms free for the selected day and hour.";
                    } else {
                        $data['hotelMessageSuccess'] = "There are rooms free for the selected day and hour.";
                    }
                }
            }
            // END OF CHECK HOTEL AVAILABILITY
        }


        $this->view("hotel/pages/rooms", $data);
    }


    // ================================================================= RESTAURANT PAGE ================================================================= /*
    public function restaurant()
    {
        $menuResaults = $this->homeModel->getMenu();
        $eventsResaults = $this->homeModel->getEvents();

        $data = [
            "menuItems" => $menuResaults,
            "eventsItems" => $eventsResaults,
            "name" => "",
            "date" => "",
            "ppl" => "",
            "hour" => "",
            "checkDay" => "",
            "checkHour" => "",
            "restMessage" => "",
            "restMessageSuccess" => ""
        ];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // ADD RESTAURANT RESERVATION
            if (isset($_POST['bookRestaurant'])) {

                $data = [
                    "menuItems" => $menuResaults,
                    "eventsItems" => $eventsResaults,
                    "name" => trim($_POST['clientName']),
                    "date" => $_POST['date'],
                    "ppl" => $_POST['adults'],
                    "hour" => $_POST['time'],
                    "checkDay" => "",
                    "checkHour" => "",
                    "restMessage" => "",
                    "restMessageSuccess" => ""
                ];

                // Check in case JS is disabled in the browser.
                if (empty($data['date'])) {
                    $data['restMessage'] = "Please add a valid date.";
                } elseif ($data['date'] < date("Y-m-d")) {
                    $data['restMessage'] = "Please add a valid date.";
                } elseif (empty($data['ppl'])) {
                    $data['restMessage'] = "Please select the number of people.";
                } elseif ($data['ppl'] == "null") {
                    $data['restMessage'] = "Please select the number of people.";
                } elseif (empty($data['hour'])) { // Will work if we only check for null, but just in case
                    $data['restMessage'] = "Please select an hour.";
                } elseif ($data['hour'] == "null") {
                    $data['restMessage'] = "Please select an hour.";
                } elseif (empty($data['name'])) {
                    $data['restMessage'] = "Please add a name.";
                } else {
                    $this->homeModel->makeRestaurantReservation($data['name'], $data['ppl'], $data['date'], $data['hour']);
                    $data['restMessageSuccess'] = "Reservation made. We look forward to see you.";
                }
            }
            // END OF ADD RESTAURANT RESERVATION


            // CHECK RESTAURANT AVAILABILITY
            if (isset($_POST['checkRest'])) {
                $data = [
                    "menuItems" => $menuResaults,
                    "eventsItems" => $eventsResaults,
                    "name" => "",
                    "date" => "",
                    "ppl" => "",
                    "hour" => "",
                    "checkDay" => $_POST['checkDay'],
                    "checkHour" => $_POST['checkHour'],
                    "restMessage" => "",
                    "restMessageSuccess" => ""
                ];

                // Check in case JS is disabled in the browser.
                if (empty($data['checkDay'])) {
                    $data['restMessage'] = "Please add a valid date.";
                } elseif ($data['checkDay'] < date("Y-m-d")) {
                    $data['restMessage'] = "Please add a valid date.";
                } elseif (empty($data['checkHour'])) { // Will work if we only check for null, but just in case
                    $data['restMessage'] = "Please select an hour.";
                } elseif ($data['checkHour'] == "null") {
                    $data['restMessage'] = "Please select an hour.";
                } else {
                    // This fictional restaurant has 20 tables, the average hours a person spends in a restaurant is 2 hours so we need the -1 to check if at the hour the person arrives there is a table free.
                    $hour = $data['checkHour'] - 1;
                    $resault = $this->homeModel->checkRestaurant($data['checkDay'], $hour);

                    // 5 tables are for walk-ins 
                    if ($resault > 14) {
                        $data['restMessage'] = "There are no tables free for the selected day and hour.";
                    } else {
                        $data['restMessageSuccess'] = "There are tables free for the selected day and hour.";
                    }
                }
            }
            // END OF CHECK RESTAURANT AVAILABILITY


        }
        $this->view("hotel/pages/restaurant", $data);
    }


    // ================================================================= CONTACT PAGE ================================================================= /*
    public function contact()
    {
        $data = [
            "name" => "",
            "email" => "",
            "deadline" => "",
            "description" => "",
            "success" => ""
        ];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $fromDate = date("Y-m-d");

            $data = [
                "name" => trim($_POST['name']),
                "email" => trim($_POST['email']),
                "description" => trim($_POST['description']),
                "fromDate" => $fromDate,
                "deadline" => $_POST['deadline'],
                "success" => ""

            ];

            // No check in case JS is disabled in the browser here because I am lazy.

            $this->homeModel->helpRequest($data['name'], $data['email'], $data['description'], $data['fromDate'], $data['deadline']);


            $subject = "Hello " . $data['name'] . ". Thank you for choosing Juno Hotel. We registerd your request and we will come back to you with an answer soon.";


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
                $mail->addAddress($data['email']);
                $mail->isHTML(true);
                $mail->Subject = "Your Juno Hotel Request";
                $mail->Body    = $subject;

                header("Location:" . URLROOT . "/home/message/help");
                die();
            } catch (Exception $e) {
                echo $e;
            }
            $data['success'] = "Your request was sent successfully.";
        }

        $this->view("hotel/pages/contact", $data);
    }




    // ================================================================= HOTEL BOOKING PAGE ================================================================= /*
    public function hotelBooking($arrival, $departure, $name)
    {
        $resault = $this->homeModel->getRooms();

        $data = [
            "rooms" => $resault,
            "arrival" => $arrival,
            "departure" => $departure,
            "name" => $name,
            "error" => "",
        ];

        $this->view("hotel/pages/hotelBooking", $data);
    }


    // ================================================================= CREATE HOTEL BOOKING ================================================================= /*
    public function setBooking()
    {
        $data = [
            "arrival" => "",
            "departure" => "",
            "rooms" => "",
            "persons" => "",
            "kids" => "",
            "type" => "",
            "name" => "",
            "email" => "",
            "phone" => ""
        ];

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


            $data = [
                "arrival" => $_POST['arrival'],
                "departure" => $_POST['departure'],
                "rooms" => $_POST['roomTotal'],
                "persons" => $_POST['persons'],
                "kids" => $_POST['kids'],
                "type" => $_POST['room'],
                "name" => trim($_POST['name']),
                "email" => trim($_POST['email']),
                "phone" => trim($_POST['phone'])
            ];

            $arriveDateForMail = date_create($data['arrival']);
            $formatArrival = date_format($arriveDateForMail, 'D M d Y');
            $departDateForMail = date_create($data['departure']);
            $formatDeparture = date_format($departDateForMail, 'D M d Y');

            // No check in case JS is disabled in the browser here because I am lazy.

            $subject = "Hello " . $data['name'] . ". Thank you for choosing Juno Hotel. Your reservation for a " . $data['type'] . " room is registerd. You have selected " . $data['rooms'] . " room/s, for " . $data['persons'] . " person/s and " . $data['kids'] . " kid/s for the period of " . $formatArrival . " to " . $formatDeparture . " . We look forword to seeing you!";

            $this->homeModel->makeReservation($data['name'], $data['type'], $data['persons'], $data['kids'], $data['rooms'], $data['phone'], $data['email'], $data['arrival'], $data['departure']);


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
                $mail->addAddress($data['email']);
                $mail->isHTML(true);
                $mail->Subject = "Your Juno Hotel Reservation";
                $mail->Body    = $subject;

                $mail->send();
                header("Location:" . URLROOT . "/home/message/booking");
                die();
            } catch (Exception $e) {
                echo $e;
            }
        }
    }



    // ================================================================= OFFERS PAGE ================================================================= /*
    public function offer($id)
    {
        $resault = $this->homeModel->getOffer($id);
        $notIn = $this->homeModel->getOfferNotIn($id);

        $data = [
            "offer" => $resault,
            "notIn" => $notIn
        ];
        $this->view("hotel/pages/offer", $data);
    }

    // ================================================================= MESSAGE PAGE ================================================================= /*
    public function message($message)
    {
        $data = [
            "message" => $message
        ];
        $this->view("hotel/pages/message", $data);
    }
}
