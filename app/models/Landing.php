<?php

class Landing
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }


    // ================================================================= GET ROOMS (singular) ================================================================= 
    public function getRoom($type)
    {
        $this->db->query("SELECT * FROM room WHERE roomType=:type");
        $this->db->bind(":type", $type);
        $resault = $this->db->getSingleResult();
        return $resault;
    }

    // ================================================================= GET ROOMS (plural) ================================================================= 
    public function getRooms()
    {
        $this->db->query("SELECT * FROM room");
        $resaults = $this->db->getMultipleResults();
        return $resaults;
    }

    // ================================================================= GET OFFERS ================================================================= 
    public function getOffers()
    {
        $this->db->query("SELECT * FROM offer");
        $resaults = $this->db->getMultipleResults();
        return $resaults;
    }

    // ================================================================= GET OFFERS BY ID ================================================================= 
    public function getOffer($id)
    {
        $this->db->query("SELECT * FROM offer WHERE id=:id");
        $this->db->bind(":id", $id);
        $resaults = $this->db->getSingleResult();
        return $resaults;
    }

    // ================================================================= GET OFFERS SQL-NOT IN, FOR OFFERS PAGE ================================================================= 
    public function getOfferNotIn($id)
    {
        $this->db->query("SELECT * FROM offer WHERE id NOT IN (:id)");
        $this->db->bind(":id", $id);
        $resaults = $this->db->getMultipleResults();
        return $resaults;
    }


    public function getReviews()
    {
        $this->db->query("SELECT * FROM review WHERE status='active'");
        $resaults = $this->db->getMultipleResults();
        return $resaults;
    }

    public function getMenu()
    {
        $this->db->query("SELECT * FROM menu");
        $resaults = $this->db->getMultipleResults();
        return $resaults;
    }

    public function getEvents()
    {
        $this->db->query("SELECT * FROM restaurantevents");
        $resaults = $this->db->getMultipleResults();
        return $resaults;
    }



    // ================================================================= ADD HOTEL BOOKING ================================================================= /*
    public function makeReservation($name, $type, $persons, $kids, $rooms, $phone, $email, $arrival, $departure)
    {
        $date = date('Y-m-d');
        $this->db->query("INSERT INTO hotel (clientName, roomType, adultsNr, kidsNr, totalRooms, clientPhone, clientEmail, created, startAt, endAt) VALUES(:name, :type, :adults, :kids, :rooms, :phone, :email, :created, :arrival, :departure)");

        $this->db->bind(":name", $name);
        $this->db->bind(":type", $type);
        $this->db->bind(":adults", $persons);
        $this->db->bind(":kids", $kids);
        $this->db->bind(":rooms", $rooms);
        $this->db->bind(":phone", $phone);
        $this->db->bind(":email", $email);
        $this->db->bind(":created", $date);
        $this->db->bind(":arrival", $arrival);
        $this->db->bind(":departure", $departure);

        $this->db->execute();
    }

    // ================================================================= CHECK HOTEL AVAILABILITY ================================================================= /*
    public function checkHotel($type, $start)
    {
        $this->db->query("SELECT * FROM hotel WHERE roomType=:type AND startAt=:start");
        $this->db->bind(":type", $type);
        $this->db->bind(":start", $start);

        $resault = $this->db->getRowCount();
        return $resault;
    }




    // ================================================================= ADD RESTAURANT BOOKING ================================================================= /*
    public function makeRestaurantReservation($name, $ppl, $day, $hour)
    {
        $this->db->query("INSERT INTO dinner (clientName, nrPpl, day, hour) VALUES (:name, :ppl, :day, :hour)");
        $this->db->bind(":name", $name);
        $this->db->bind(":ppl", $ppl);
        $this->db->bind(":day", $day);
        $this->db->bind(":hour", $hour);
        $this->db->execute();
    }



    // ================================================================= CHECK RESTAURANT AVAILABILITY ================================================================= /*
    public function checkRestaurant($day, $hour)
    {
        $this->db->query("SELECT * FROM dinner WHERE day=:day AND hour=:hour");
        $this->db->bind(":day", $day);
        $this->db->bind(":hour", $hour);

        $resault = $this->db->getRowCount();
        return $resault;
    }


    public function helpRequest($name, $email, $description, $fromDate, $deadline)
    {
        $this->db->query("INSERT INTO help (client, clientEmail, description, fromDate, deadline) VALUES (:client, :email, :desc, :date, :deadline)");
        $this->db->bind(":client", $name);
        $this->db->bind(":email", $email);
        $this->db->bind(":desc", $description);
        $this->db->bind(":date", $fromDate);
        $this->db->bind(":deadline", $deadline);

        $this->db->execute();
    }


    // ADD REVIEW
    public function addReview($name, $email, $description, $date)
    {
        $this->db->query("INSERT INTO review (fromClient, clientEmail, description, created) VALUES(:from, :email, :desc, :date)");
        $this->db->bind(":from", $name);
        $this->db->bind(":email", $email);
        $this->db->bind(":desc", $description);
        $this->db->bind(":date", $date);
        $this->db->execute();
    }
}
