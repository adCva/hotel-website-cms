<?php

class Cms
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }


    /* ======================================================================= ARCHIVE =======================================================================  */
    public function archive($title, $from, $desc, $details, $by, $date)
    {
        $this->db->query("INSERT INTO archive (archiveTitle, archiveFrom, archiveDescription, archiveDetails, archiveBy, archiveDate) VALUES(:title, :from, :desc, :detail, :by, :date)");
        $this->db->bind(":title", $title);
        $this->db->bind(":from", $from);
        $this->db->bind(":desc", $desc);
        $this->db->bind(":detail", $details);
        $this->db->bind(":by", $by);
        $this->db->bind(":date", $date);
        $this->db->execute();
    }



    /* ======================================================================= LOGIN =======================================================================  */
    public function login($username, $password, $role)
    {
        $this->db->query("SELECT * FROM users WHERE username = :username AND role=:role");
        $this->db->bind("username", $username);
        $this->db->bind("role", $role);

        // No need for execute() because the getSingleResult method comes with it.
        $resault = $this->db->getSingleResult();
        $hashedPwd = $resault->password;


        if (password_verify($password, $hashedPwd)) {
            return $resault;
        } else {
            return false;
        }
    }

    /* ======================================================================= CREATE USER =======================================================================  */
    public function create($firstName, $lastName, $username, $password, $role, $createdBy, $createdOn)
    {
        $hashedPwd = password_hash($password, PASSWORD_BCRYPT);

        $this->db->query("INSERT INTO users (firstName, lastName, username, password, role, createdBy, createdOn) VALUES (:firstName, :lastName, :username, :password, :role, :createdBy, :createdOn);");
        $this->db->bind(":firstName", $firstName);
        $this->db->bind(":lastName", $lastName);
        $this->db->bind(":username", $username);
        $this->db->bind(":password", $hashedPwd);
        $this->db->bind(":role", $role);
        $this->db->bind(":createdBy", $createdBy);
        $this->db->bind(":createdOn", $createdOn);

        $this->db->execute();
    }


    /* ======================================================================= TAKEN USERNAME FOR CREATE/EDIT USER =======================================================================  */
    public function getUsername($username)
    {
        // Here you can select by username and role and so allowing a taken username assigned to different roles. Because of lazyness I just select the username.
        $this->db->query("SELECT * FROM users WHERE username=:username");
        $this->db->bind(":username", $username);

        $resault = $this->db->getRowCount();

        if ($resault > 0) {
            return true;
        } else {
            return false;
        }
    }

    /* ======================================================================= CREATE EMPLOYEE =======================================================================  */
    public function createEmployee($firstName, $lastName, $role, $employeeddOn)
    {
        $this->db->query("INSERT INTO staff (firstName, lastName, role, employeedOn) VALUES(:firstName, :lastName, :role, :employeedOn)");
        $this->db->bind(":firstName", $firstName);
        $this->db->bind(":lastName", $lastName);
        $this->db->bind(":role", $role);
        $this->db->bind(":employeedOn", $employeeddOn);
        $this->db->execute();
    }



    /* ======================================================================= GET USERS/ROOM...ETC BY ID =======================================================================  */
    public function getById($table, $id)
    {
        $this->db->query("SELECT * FROM $table WHERE id=:id");
        $this->db->bind(":id", $id);
        $resault = $this->db->getSingleResult();

        return $resault;
    }

    /* ======================================================================= SEE LISTS WITH PAGINATION =======================================================================  */
    public function getList($table, $limit1, $limit2)
    {
        $this->db->query("SELECT * FROM $table ORDER BY id LIMIT $limit1, $limit2");
        $resaults = $this->db->getMultipleResults();

        return $resaults;
    }

    /* ======================================================================= SEE LIST WITHOUT PAGINATION =======================================================================  */
    public function seeUsersList($table)
    {
        $this->db->query("SELECT * FROM $table ORDER BY id DESC");
        $resaults = $this->db->getMultipleResults();

        return $resaults;
    }

    /* ======================================================================= EDIT USER =======================================================================  */
    public function editUser($firstName, $lastName, $username, $role, $createdBy, $createdOn, $id)
    {
        $this->db->query("UPDATE users SET firstName=:firstName, lastName=:lastName, username=:username, role=:role, createdBy=:createdBy, createdOn=:createdOn WHERE id=:id");
        $this->db->bind(":firstName", $firstName);
        $this->db->bind(":lastName", $lastName);
        $this->db->bind(":username", $username);
        $this->db->bind(":role", $role);
        $this->db->bind(":createdBy", $createdBy);
        $this->db->bind(":createdOn", $createdOn);
        $this->db->bind(":id", $id);
        $this->db->execute();
    }

    /* ======================================================================= DELETE USER/EMPLOYEE =======================================================================  */
    public function delete($table, $id)
    {
        $this->db->query("DELETE FROM $table WHERE id=:id");
        $this->db->bind(":id", $id);
        $this->db->execute();
    }


    /* ======================================================================= ADD ROOM =======================================================================  */
    public function addRoom($img, $type, $size, $bed, $desc, $total, $price)
    {
        $this->db->query("INSERT INTO room (roomImage, roomType, roomSize, roomBed, roomDescription, roomTotal_Of_Type, roomPrice) VALUES (:img, :type, :size, :bed, :desc, :total, :price)");
        $this->db->bind(":img", $img);
        $this->db->bind(":type", $type);
        $this->db->bind(":size", $size);
        $this->db->bind(":bed", $bed);
        $this->db->bind(":desc", $desc);
        $this->db->bind(":total", $total);
        $this->db->bind(":price", $price);
        $this->db->execute();
    }

    /* ======================================================================= EDIT ROOM =======================================================================  */
    public function editRoom($image, $type, $size, $bed, $desc, $total, $price, $id)
    {
        if (empty($image)) {
            $this->db->query("UPDATE room SET roomType=:type, roomSize=:size, roomBed=:bed, roomDescription=:desc, roomTotal_Of_Type=:total, roomPrice=:price WHERE id=:id");
            $this->db->bind(":type", $type);
            $this->db->bind(":size", $size);
            $this->db->bind(":bed", $bed);
            $this->db->bind(":desc", $desc);
            $this->db->bind(":total", $total);
            $this->db->bind(":price", $price);
            $this->db->bind(":id", $id);
            $this->db->execute();
        } else {
            $this->db->query("UPDATE room SET roomImage=:image, roomType=:type, roomSize=:size, roomBed=:bed, roomDescription=:desc, roomTotal_Of_Type=:total, roomPrice=:price WHERE id=:id");
            $this->db->bind(":image", $image);
            $this->db->bind(":type", $type);
            $this->db->bind(":size", $size);
            $this->db->bind(":bed", $bed);
            $this->db->bind(":desc", $desc);
            $this->db->bind(":total", $total);
            $this->db->bind(":price", $price);
            $this->db->bind(":id", $id);
            $this->db->execute();
        }
    }


    /* ======================================================================= ADD OFFER =======================================================================  */
    public function addOffer($img, $name, $desc, $start, $end, $price)
    {
        $this->db->query("INSERT INTO offer (offerImage, offerName, offerDescription, offerStart, offerEnd, offerPrice) VALUES (:img, :name, :desc, :start, :end, :price)");
        $this->db->bind(":img", $img);
        $this->db->bind(":name", $name);
        $this->db->bind(":desc", $desc);
        $this->db->bind(":start", $start);
        $this->db->bind(":end", $end);
        $this->db->bind(":price", $price);
        $this->db->execute();
    }


    /* ======================================================================= EDIT OFFER =======================================================================  */
    public function editOffer($img, $name, $desc, $start, $end, $price, $id)
    {
        if (empty($img)) {
            $this->db->query("UPDATE offer SET offerName=:name, offerDescription=:desc, offerStart=:start, offerEnd=:end, offerPrice=:price WHERE id=:id");
            $this->db->bind(":name", $name);
            $this->db->bind(":desc", $desc);
            $this->db->bind(":start", $start);
            $this->db->bind(":end", $end);
            $this->db->bind(":price", $price);
            $this->db->bind(":id", $id);
            $this->db->execute();
        } else {
            $this->db->query("UPDATE offer SET offerImage=:image, offerName=:name, offerDescription=:desc, offerStart=:start, offerEnd=:end, offerPrice=:price WHERE id=:id");
            $this->db->bind(":img", $img);
            $this->db->bind(":name", $name);
            $this->db->bind(":desc", $desc);
            $this->db->bind(":start", $start);
            $this->db->bind(":end", $end);
            $this->db->bind(":price", $price);
            $this->db->bind(":id", $id);
            $this->db->execute();
        }
    }


    /* ======================================================================= ADD EVENT =======================================================================  */
    public function addEvent($name, $created, $desc)
    {
        $this->db->query("INSERT INTO event (eventName, eventDate, eventDescription) VALUES (:name, :created, :desc)");
        $this->db->bind(":name", $name);
        $this->db->bind(":created", $created);
        $this->db->bind(":desc", $desc);
        $this->db->execute();
    }


    /* ======================================================================= RESOLVE EVENT =======================================================================  */
    public function resolve($id)
    {
        $solution = "resolved";

        $this->db->query("UPDATE event SET eventStatus=:solution WHERE id=:id");
        $this->db->bind(":solution", $solution);
        $this->db->bind(":id", $id);
        $this->db->execute();
    }



    /* ======================================================================= ADD MENU ITEM =======================================================================  */
    public function addMenuItem($name, $ingredients, $price, $desc, $img)
    {
        $this->db->query("INSERT INTO menu (name, ingredients, price, description, img) VALUES (:name, :ingredients, :price, :desc, :img)");
        $this->db->bind(":name", $name);
        $this->db->bind(":ingredients", $ingredients);
        $this->db->bind(":price", $price);
        $this->db->bind(":desc", $desc);
        $this->db->bind(":img", $img);
        $this->db->execute();
    }



    /* ======================================================================= ADD RESTAURANT EVENT =======================================================================  */
    public function addRestEvent($name, $details, $day, $price, $img)
    {
        $this->db->query("INSERT INTO restaurantevents (name, details, day, price, img) VALUES (:name, :details, :day, :price, :img)");
        $this->db->bind(":name", $name);
        $this->db->bind(":details", $details);
        $this->db->bind(":day", $day);
        $this->db->bind(":price", $price);
        $this->db->bind(":img", $img);
        $this->db->execute();
    }




    /* ======================================================================= CHANGE REVIEW STATUS =======================================================================  */
    public function reviewStatus($id, $status)
    {
        $this->db->query("UPDATE review SET status=:stat WHERE id=:id");
        $this->db->bind(":stat", $status);
        $this->db->bind(":id", $id);
        $this->db->execute();
    }

    /* ======================================================================= GET ROW COUNT ALL =======================================================================  */
    public function rowCountAll($table)
    {
        $this->db->query("SELECT * FROM $table");

        $resault = $this->db->getRowCount();

        return $resault;
    }

    /* ======================================================================= GET ROW COUNT BY ID =======================================================================  */
    public function rowCount($table, $id)
    {
        $this->db->query("SELECT * FROM $table WHERE id=:id");
        $this->db->bind(":id", $id);
        $resault = $this->db->getRowCount();

        return $resault;
    }


    /* ======================================================================= GET ROW COUNT BY COLUMN =======================================================================  */
    public function rowCountColumn($table, $column, $field)
    {
        $this->db->query("SELECT * FROM $table WHERE $column=:field");
        $this->db->bind(":field", $field);
        $resault = $this->db->getRowCount();

        return $resault;
    }



    /* ======================================================================= RESOLVE HELP REQUEST =======================================================================  */
    public function resolveRequest($id, $name, $date, $solution)
    {
        $this->db->query("UPDATE help SET resolvedBy=:by, resolvedDate=:date, solution=:solution WHERE id=:id");
        $this->db->bind(":by", $name);
        $this->db->bind(":date", $date);
        $this->db->bind(":solution", $solution);
        $this->db->bind(":id", $id);
        $this->db->execute();
    }



    /* ======================================================================= CHANGE PASSWORD =======================================================================  */
    public function changePassword($id, $new)
    {
        $this->db->query("UPDATE users SET password=:pwd WHERE id=:id");
        $this->db->bind(":pwd", $new);
        $this->db->bind(":id", $id);
        $this->db->execute();
    }



    /* ======================================================================= EDIT MENU =======================================================================  */
    public function editMenu($id, $name, $ingredients, $price, $desc, $img)
    {
        if (empty($img)) {
            $this->db->query("UPDATE menu SET name=:name, ingredients=:ingredients, price=:price, description=:desc WHERE id=:id");
            $this->db->bind(":name", $name);
            $this->db->bind(":ingredients", $ingredients);
            $this->db->bind(":price", $price);
            $this->db->bind(":desc", $desc);
            $this->db->bind(":id", $id);
            $this->db->execute();
        } else {
            $this->db->query("UPDATE menu SET name=:name, ingredients=:ingredients, price=:price, description=:desc, img=:img WHERE id=:id");
            $this->db->bind(":name", $name);
            $this->db->bind(":ingredients", $ingredients);
            $this->db->bind(":price", $price);
            $this->db->bind(":desc", $desc);
            $this->db->bind(":img", $img);
            $this->db->bind(":id", $id);
            $this->db->execute();
        }
    }


    /* ======================================================================= EDIT RESTAURANT EVENT =======================================================================  */
    public function editRestEvent($id, $name, $details, $day, $price, $img)
    {
        if (empty($img)) {
            $this->db->query("UPDATE restaurantevents SET name=:name, details=:details, day=:day, price=:price WHERE id=:id");
            $this->db->bind(":name", $name);
            $this->db->bind(":details", $details);
            $this->db->bind(":day", $day);
            $this->db->bind(":price", $price);
            $this->db->bind(":id", $id);
            $this->db->execute();
        } else {
            $this->db->query("UPDATE restaurantevents SET name=:name, details=:details, day=:day, price=:price, img=:img WHERE id=:id");
            $this->db->bind(":name", $name);
            $this->db->bind(":details", $details);
            $this->db->bind(":day", $day);
            $this->db->bind(":price", $price);
            $this->db->bind(":img", $img);
            $this->db->bind(":id", $id);
            $this->db->execute();
        }
    }
}
