-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2021 at 12:09 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `juno`
--

-- --------------------------------------------------------

--
-- Table structure for table `archive`
--

CREATE TABLE `archive` (
  `id` int(11) NOT NULL,
  `archiveTitle` varchar(256) NOT NULL,
  `archiveFrom` varchar(256) NOT NULL,
  `archiveDescription` text NOT NULL,
  `archiveDetails` varchar(256) NOT NULL,
  `archiveBy` varchar(50) NOT NULL,
  `archiveDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `archive`
--

INSERT INTO `archive` (`id`, `archiveTitle`, `archiveFrom`, `archiveDescription`, `archiveDetails`, `archiveBy`, `archiveDate`) VALUES
(31, 'offer', 'From Offer', 'Free parking_Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tempore, quam sequi dolorem doloribus dolor assumenda animi fuga voluptas corporis unde enim optio perferendis adipisci quod._', 'Was archived from offer', 'morgan', '2021-04-15'),
(33, 'offer', 'From Offer', 'Free Museum Entry_Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda magni quaerat voluptates corporis. Hic distinctio animi aspernatur quos neque architecto, suscipit veniam?_', 'Was archived from offer', 'morgan', '2021-04-24'),
(34, 'offer', 'From Offer', 'Tour Guide_Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod nam quo dolor possimus, quas ullam magnam officiis explicabo iusto laborum sed dolore magni dicta commodi!_', 'Was archived from offer', 'morgan', '2021-04-24'),
(36, 'offer', 'From Offer', 'Roman Villas Access_Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero velit aliquid impedit explicabo adipisci repellendus eveniet blanditiis eaque omnis, alias ipsam suscipit, sed esse quae numquam._', 'Was archived from offer', 'morgan', '2021-04-24'),
(37, 'offer', 'From Offer', 'Street Food Festival_Lorem, ipsum dolor sit amet consectetur adipisicing elit. Officiis hic eaque, doloremque ex laudantium facere? Repudiandae rerum possimus ducimus accusamus? Fugiat, ipsum quas!_', 'Was archived from offer', 'morgan', '2021-04-24'),
(38, 'offer', 'From Offer', '50% Off Dining_Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque sit possimus fugiat suscipit hic quisquam!_', 'Was archived from offer', 'morgan', '2021-04-24'),
(48, 'event', 'From Internal Events', 'Cleaning_Test example #1._', 'Internal Events', 'morgan', '2021-05-02'),
(52, 'hotel', 'From Hotel Reservation', 'Jane Gill_Royal_jane@email.com_', 'Hotel Reservation', 'morgan', '2021-05-02'),
(54, 'dinner', 'From Restaurant Reservation', 'james_2021-05-14_', 'Restaurant Reservation', 'morgan', '2021-05-02'),
(55, 'dinner', 'From Restaurant Reservation', 'Billy_2021-05-12_', 'Restaurant Reservation', 'morgan', '2021-05-02'),
(57, 'hotel', 'From Hotel Reservation', 'name_Standard__', 'Hotel Reservation', 'morgan', '2021-05-02'),
(59, 'review', 'From Review', 'Jesse Pinkman_yea@science.com_No Message', 'Review', 'morgan', '2021-05-02'),
(60, 'hotel', 'From Hotel Reservation', 'John Doe_Standard_email@email.com_', 'Hotel Reservation', 'morgan', '2021-05-02'),
(61, 'dinner', 'From Restaurant Reservation', 'Jane Gill_2021-04-30_', 'Restaurant Reservation', 'morgan', '2021-05-02'),
(62, 'event', 'From Internal Events', 'Buy products_Buy ingredients and sheets for the restaurant and hotel rooms._', 'Internal Events', 'morgan', '2021-05-02');

-- --------------------------------------------------------

--
-- Table structure for table `dinner`
--

CREATE TABLE `dinner` (
  `id` int(11) NOT NULL,
  `clientName` varchar(50) NOT NULL,
  `nrPpl` int(3) NOT NULL,
  `day` date NOT NULL,
  `hour` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dinner`
--

INSERT INTO `dinner` (`id`, `clientName`, `nrPpl`, `day`, `hour`) VALUES
(25, 'Heisenberg', 2, '2021-05-06', '20'),
(30, 'David', 3, '2021-05-22', '19');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `eventName` varchar(256) NOT NULL,
  `eventDate` date NOT NULL,
  `eventDescription` text NOT NULL,
  `eventStatus` varchar(50) NOT NULL DEFAULT 'unresolved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `eventName`, `eventDate`, `eventDescription`, `eventStatus`) VALUES
(6, 'Repair pc', '2021-05-02', 'repair pc', 'unresolved'),
(7, 'Cleaning', '2021-05-20', 'Clean room #24', 'unresolved');

-- --------------------------------------------------------

--
-- Table structure for table `help`
--

CREATE TABLE `help` (
  `id` int(11) NOT NULL,
  `client` varchar(256) NOT NULL,
  `clientEmail` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `fromDate` date NOT NULL,
  `deadline` date NOT NULL,
  `resolvedBy` varchar(256) NOT NULL,
  `resolvedDate` date NOT NULL,
  `solution` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `help`
--

INSERT INTO `help` (`id`, `client`, `clientEmail`, `description`, `fromDate`, `deadline`, `resolvedBy`, `resolvedDate`, `solution`) VALUES
(3, 'Walter White', 'gustavo@fring.com', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Magnam maiores officiis esse rem qui laboriosam sunt nam ea, quae corrupti sed cupiditate necessitatibus. Eius nesciunt commodi explicabo accusantium quidem eligendi cumque nemo numquam laboriosam? Cumque, aliquid! Quia iure error magni ab libero consequuntur hic corporis quos dolore, natus non? Quisquam corporis consequatur dolorem dolorum praesentium nulla fuga tempora? Eveniet, vitae pariatur aspernatur nostrum sunt, ipsam aliquam totam minus quis cupiditate quam voluptates consequatur eius perferendis iure consequuntur fugiat quo inventore recusandae, eligendi repellendus ipsa iste placeat iusto? Itaque dolore, veritatis qui temporibus in maiores animi error fugit! Sunt, animi dolorum!', '2021-04-19', '2021-04-30', '', '0000-00-00', NULL),
(4, 'Jesse Pinkman', 'science@bitch.com', 'Hey, yo mr White.', '2021-04-19', '2021-04-30', '', '0000-00-00', NULL),
(8, '', '', '', '2021-04-30', '0000-00-00', '', '0000-00-00', NULL),
(9, '', '', '', '2021-04-30', '0000-00-00', '', '0000-00-00', NULL),
(10, '', '', '', '2021-04-30', '0000-00-00', '', '0000-00-00', NULL),
(11, 'Bill', 'email@email.com', 'this is a text example of a help review', '2021-05-01', '2021-05-02', '', '0000-00-00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `id` int(11) NOT NULL,
  `clientName` varchar(50) NOT NULL,
  `roomType` varchar(50) NOT NULL,
  `adultsNr` int(5) NOT NULL,
  `kidsNr` int(5) NOT NULL,
  `totalRooms` int(5) NOT NULL,
  `clientPhone` int(11) DEFAULT NULL,
  `clientEmail` varchar(256) DEFAULT NULL,
  `created` date NOT NULL,
  `startAt` date NOT NULL,
  `endAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`id`, `clientName`, `roomType`, `adultsNr`, `kidsNr`, `totalRooms`, `clientPhone`, `clientEmail`, `created`, `startAt`, `endAt`) VALUES
(29, 'name', 'Standard', 1, 0, 1, 0, 'email@email.com', '2021-04-30', '2021-04-30', '2021-05-05');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `ingredients` varchar(256) NOT NULL,
  `price` int(5) NOT NULL,
  `description` text NOT NULL,
  `img` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `ingredients`, `price`, `description`, `img`) VALUES
(8, 'Spaghetti Puttanesca', 'Spaghetti, Onion, Garlinc, Olive oil, Chopped Tomatoes, Black Olives', 9, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis, voluptatibus? Quod, minus optio excepturi sed facere, vel officia soluta rerum minima eius praesentium cupiditate inventore tempora modi explicabo ipsa dolor veniam perferendis odio, aliquam totam. Sit quis alias amet vel!', 'menu-1.jpg'),
(9, 'Classic Pizza', 'Italian Sausage,  Bread Dough Rolls, Pizza Sauce, Mozzarella Cheese, Onin, Green Pepper, Black Olives, Mushroom', 14, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem error eveniet minima amet impedit deleniti corporis, alias quaerat repellat vitae dolor facilis, id, accusamus voluptatum ratione modi nulla aliquid ipsum inventore deserunt quos recusandae. Id aperiam, facere non ea incidunt veritatis magnam reprehenderit reiciendis.', 'menu-2.jpg'),
(10, 'Lasagna', 'Italian Sausage, Ground Beef, Onion, Garlic, Tomatoes, Tomato Sauce   ', 12, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores harum nobis quo veniam consequatur cumque aliquam aut repudiandae, animi iusto quia possimus perspiciatis hic consectetur impedit, accusamus eius. Voluptas placeat reprehenderit fugit corrupti nobis voluptatem repellat beatae ipsam.', 'menu-3.jpg'),
(12, 'Tiramisu', 'Mascarpone, Ladyfingers, Coffe, Sugar, Rum, Cocoa Powder, Chocolate Shavings', 7, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores tempora provident maiores expedita voluptatem quia, esse cupiditate deleniti repellendus temporibus nam aliquam sunt ipsa? Corrupti iure saepe magnam, minus at non quidem consequatur. Est vero quam inventore minus dolorum.', 'menu-4.jpg'),
(13, 'Gelato', 'Different Recepies', 3, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Et, laudantium vero doloremque eius architecto quidem blanditiis quis minima neque molestiae. Amet laboriosam ad voluptates assumenda non ducimus porro eaque? Ullam, voluptas maiores. Illo amet mollitia officiis.', 'menu-5.jpg'),
(14, 'Collazione', 'Espresso, Croissant', 5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit ducimus minima nobis deleniti, quibusdam at voluptas numquam fuga voluptatem perferendis.', 'menu-6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE `offer` (
  `id` int(11) NOT NULL,
  `offerImage` varchar(256) NOT NULL,
  `offerName` varchar(256) NOT NULL,
  `offerDescription` text NOT NULL,
  `offerStart` date NOT NULL,
  `offerEnd` date NOT NULL,
  `offerPrice` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`id`, `offerImage`, `offerName`, `offerDescription`, `offerStart`, `offerEnd`, `offerPrice`) VALUES
(33, 'offer-1.jpg', '50% Off Dining', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque sit possimus fugiat suscipit hic quisquam!', '2021-06-01', '2021-06-30', 20),
(34, 'offer-2.jpg', 'City Guide Deals', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Totam natus distinctio qui eaque, voluptas et libero maxime? Voluptatem, ducimus numquam.', '2021-06-01', '2021-09-01', 10),
(35, 'offer-3.jpg', 'Free Parking', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nemo exercitationem libero ducimus similique alias esse impedit, sapiente commodi ipsa debitis dicta.', '2021-06-01', '2021-09-01', 12),
(36, 'offer-4.jpg', 'Airport Lyft', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vel omnis ab libero necessitatibus eligendi, sint magnam odio.', '2021-06-01', '2021-08-25', 8),
(37, 'offer-5.jpg', '40% Off Vespa Rental', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem esse quis, quaerat soluta eos harum!', '2021-07-01', '2021-07-31', 22);

-- --------------------------------------------------------

--
-- Table structure for table `restaurantevents`
--

CREATE TABLE `restaurantevents` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `details` text NOT NULL,
  `day` date NOT NULL,
  `price` int(5) NOT NULL,
  `img` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `restaurantevents`
--

INSERT INTO `restaurantevents` (`id`, `name`, `details`, `day`, `price`, `img`) VALUES
(5, 'John Doe Stand Up Comedy', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ipsum praesentium ratione ea aut tempore sed?', '2021-05-02', 10, 'event-1.jpg'),
(6, 'Roma Jazz Day', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laboriosam accusantium blanditiis laborum.', '2021-05-15', 12, 'event-2.jpg'),
(7, 'Wine Taste', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Culpa?', '2021-06-30', 8, 'event-3.jpg'),
(8, 'Children Puppet Show', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nam, atque perspiciatis.', '2021-08-28', 5, 'event-4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `fromClient` varchar(256) NOT NULL,
  `clientEmail` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `created` date NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'hidden'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `fromClient`, `clientEmail`, `description`, `created`, `status`) VALUES
(1, 'John Doe', 'email@email.com', 'description text etc', '2021-04-10', 'hidden'),
(2, 'Jane Doe', 'email@email.com', 'this is a description', '2021-04-11', 'hidden'),
(3, 'Walter White', 'heisenberg@email.com', 'Who are you talking to right now? Who is it you think you see? Do you know how much I make a year? I mean, even if I told you, you wouldn\'t believe it. Do you know what would happen if I suddenly decided to stop going into work? A business big enough that it could be listed on the NASDAQ goes belly up. Disappears. It ceases to exist, without me.', '2020-04-20', 'active'),
(4, 'Friedrich Nietzsche', 'abyss@email.com', 'Whoever fights monsters should see to it that in the process he does not become a monster. And if you gaze long enough into an abyss, the abyss will gaze back into you.', '2020-04-20', 'active'),
(6, 'Satoshi Nakamoto', 'btc@email.com', 'The  root problem  with  conventional  currency  is  all  the  trust  that’s  required  to  make  it  work.  The  central  bank  must  be  trusted  not  to  debase  the  currency,  but  the  history  of  fiat  currencies  is  full  of  breaches  of  that  trust.', '2020-04-20', 'active'),
(13, 'Morgan Marston', 'morgan@email.com', 'this is a test for a test review and words etc and so on and so on', '2021-05-01', 'hidden');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `roomImage` varchar(256) NOT NULL,
  `roomType` varchar(256) NOT NULL,
  `roomSize` int(11) NOT NULL,
  `roomBed` varchar(256) NOT NULL,
  `roomDescription` text NOT NULL,
  `roomTotal_Of_Type` int(11) NOT NULL,
  `roomPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `roomImage`, `roomType`, `roomSize`, `roomBed`, `roomDescription`, `roomTotal_Of_Type`, `roomPrice`) VALUES
(1, 'standard.jpg', 'Standard', 20, '2 twin or 1 queen or 1 king', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem dolore temporibus molestias aspernatur, quisquam corrupti.', 10, 62),
(2, 'superior.jpg', 'Superior', 25, '2 twin or 1 queen or 1 king', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem dolore temporibus molestias aspernatur, quisquam corrupti.', 6, 70),
(3, 'premium.jpg', 'Premium', 30, '2 twin or 1 queen or 1 king', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem dolore temporibus molestias aspernatur, quisquam corrupti.', 4, 90),
(4, 'royal.jpg', 'Royal', 50, '2 king or 2 queen', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem dolore temporibus molestias aspernatur, quisquam corrupti.', 2, 120),
(5, 'room-5.jpg', 'Economy', 17, '1 Twin Bed', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Praesentium tenetur maxime odit, exercitationem, delectus rem eos consequatur fuga consectetur vero dolore.', 5, 45),
(6, 'room-6.jpg', 'Family', 40, '2 Queen and 1 King', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis velit ullam dolorem est mollitia officiis quisquam, illo voluptatem odio ab?', 5, 95);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `firstName` varchar(256) NOT NULL,
  `lastName` varchar(256) NOT NULL,
  `role` varchar(256) NOT NULL,
  `employeedOn` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `firstName`, `lastName`, `role`, `employeedOn`) VALUES
(3, 'Lenny', 'Summers', 'Researcher', '2021-04-02'),
(4, 'Bill', 'Williamson', 'Gunner', '2021-04-02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'basic',
  `createdBy` varchar(256) NOT NULL,
  `createdOn` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `username`, `password`, `role`, `createdBy`, `createdOn`) VALUES
(8, 'Arthur', 'Morgan', 'morgan', '$2y$10$nYK5nl2PqZqk4BczM57nweUMzY8fMvCdwFdGTZOD.eNEFk/POMZgC', 'admin', 'Arthur Morgan', '2021-04-14'),
(11, 'John', 'Marston', 'marston', '$2y$10$kYjUG/bPWeOt6dj9VVSuhuUqHswaqhGEDBPI0x/euux/iWkk21qre', 'admin', 'Arthur Morgan', '2021-05-03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archive`
--
ALTER TABLE `archive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dinner`
--
ALTER TABLE `dinner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `help`
--
ALTER TABLE `help`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurantevents`
--
ALTER TABLE `restaurantevents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archive`
--
ALTER TABLE `archive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `dinner`
--
ALTER TABLE `dinner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `help`
--
ALTER TABLE `help`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `restaurantevents`
--
ALTER TABLE `restaurantevents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
