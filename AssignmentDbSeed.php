<?php
require_once 'vendor/autoload.php';

class DbTransactions
{

  public $db_connection;
  private $servername = "localhost";
  private $username = "root";
  private $password = "";
  private $dbname = "assignment";
  private $conn;

  function __construct()
  {
    try {
      if (!isset($this->conn)) {
        $this->conn = new PDO("mysql:host=" . $this->servername . ";dbname=" . $this->dbname, $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
    } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
    $this->db_connection = $this->conn;
  }
}


$db = new DbTransactions();

$conn = new mysqli("localhost", "root", "", "assignment");

$query = $db->db_connection->query("SHOW TABLES");
$tables = $query->fetchAll(PDO::FETCH_COLUMN);
foreach ($tables as $table) {
  $sql = "DROP TABLE $table";
  $conn->query($sql);
}

$faker = Faker\Factory::create();


$db->db_connection->query('CREATE TABLE `order_request` (
    `id` int(11) NOT NULL,
    `type` varchar(255) NOT NULL,
    `description` varchar(255) DEFAULT NULL,
    `duration` varchar(255) DEFAULT NULL,
    `status` varchar(255) DEFAULT NULL,
    `page_number` int(11) DEFAULT NULL,
    `price` int(11) DEFAULT NULL,
    `created_at` int(11) DEFAULT NULL,
    `user_id` int(11) NOT NULL,
    `service` varchar(190) DEFAULT NULL,
    `lavel` varchar(255) DEFAULT NULL,
    `style` varchar(255) DEFAULT NULL,
    `source` varchar(255) DEFAULT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');

$db->db_connection->query('CREATE TABLE `category` (
    `id` int(11) NOT NULL,
    `name` varchar(255) NOT NULL,
    `icon` varchar(255) DEFAULT NULL,
    `created_at` date NOT NULL DEFAULT current_timestamp()
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');

$db->db_connection->query('CREATE TABLE `chatroom` (
  `id` int(11) NOT NULL,
  `big_id_participent` int(11) NOT NULL,
  `small_id_participent` int(11) NOT NULL,
  `approach` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `offer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');

$db->db_connection->query('CREATE TABLE `email` (
    `id` int(11) NOT NULL,
    `recipient` varchar(255) NOT NULL,
    `subject` varchar(255) DEFAULT NULL,
    `body` varchar(255) DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');

$db->db_connection->query('CREATE TABLE `essay` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `sold_out` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `lang_id` int(11) DEFAULT NULL,
  `sub_cat_id` int(11) NOT NULL,
  `order_req_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');

$db->db_connection->query('CREATE TABLE `language` (
    `id` int(11) NOT NULL,
    `name` varchar(255) NOT NULL,
    `code` varchar(255) NOT NULL,
    `created_at` date NOT NULL DEFAULT current_timestamp()
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
  ');

$db->db_connection->query("CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `writer_name` varchar(255) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `rating` varchar(25) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");


$db->db_connection->query('CREATE TABLE `log` (
    `id` int(11) NOT NULL,
    `name` varchar(255) NOT NULL,
    `description` varchar(255) DEFAULT NULL,
    `performedBy` varchar(255) DEFAULT NULL,
    `isResolved` varchar(255) DEFAULT NULL,
    `created_at` date NOT NULL DEFAULT current_timestamp()
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');

$db->db_connection->query('CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `mediable_id` int(11) NOT NULL,
  `mediable_type` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');

$db->db_connection->query('CREATE TABLE `message` (
    `id` int(11) NOT NULL,
    `sender_id` int(11) NOT NULL,
    `receiver_id` int(11) NOT NULL,
    `chat_room_id` int(11) NOT NULL,
    `message` text NOT NULL,
    `isFile` varchar(255) NOT NULL,
    `status` varchar(255) DEFAULT NULL,
    `spam` varchar(255) DEFAULT NULL,
    `created_at` date NOT NULL DEFAULT current_timestamp()
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');

$db->db_connection->query('CREATE TABLE `offer` (
    `id` int(11) NOT NULL,
    `description` varchar(255) NOT NULL,
    `duration` varchar(255) NOT NULL,
    `status` varchar(255) NOT NULL,
    `page_number` varchar(255) NOT NULL,
    `price` varchar(255) NOT NULL,
    `order_req_id` int(11) NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `user_id` int(11) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');

$db->db_connection->query("CREATE TABLE `orders` (
    `id` int(11) NOT NULL,
    `startingTime` varchar(255) NOT NULL,
    `endingTime` varchar(255) NOT NULL,
    `status` varchar(255) NOT NULL,
    `writer_id` int(11) NOT NULL,
    `student_id` int(11) NOT NULL,
    `offer_id` int(11) NOT NULL,
    `price` int(11) NOT NULL,
    `created_at` int(11) DEFAULT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");


$db->db_connection->query('CREATE TABLE `payment` (
    `id` int(11) NOT NULL,
    `payment_type` varchar(255) NOT NULL,
    `currency` varchar(255) NOT NULL,
    `transaction_id` varchar(255) NOT NULL,
    `medium` int(11) NOT NULL,
    `created_at` date NOT NULL DEFAULT current_timestamp(),
    `order_id` int(11) NOT NULL,
    `ammount` int(11) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');

$db->db_connection->query('CREATE TABLE `rating` (
    `id` int(11) NOT NULL,
    `rateable_id` int(11) NOT NULL,
    `rateable_type` varchar(255) NOT NULL,
    `rating` varchar(255) NOT NULL,
    `comment` text DEFAULT NULL,
    `created_at` date NOT NULL DEFAULT current_timestamp()
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
  ');

$db->db_connection->query('CREATE TABLE `roles` (
    `id` int(11) NOT NULL,
    `name` varchar(255) NOT NULL,
    `created_at` datetime DEFAULT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');

$db->db_connection->query('CREATE TABLE `submission` (
    `id` int(11) NOT NULL,
    `stubmissionTime` varchar(255) NOT NULL,
    `note` text NOT NULL,
    `status` varchar(255) NOT NULL,
    `order_id` int(11) NOT NULL,
    `created_at` date NOT NULL DEFAULT current_timestamp()
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');

$db->db_connection->query('CREATE TABLE `sub_category` (
    `id` int(11) NOT NULL,
    `name` varchar(255) NOT NULL,
    `icon` varchar(255) NOT NULL,
    `cat_id` int(11) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');

$db->db_connection->query('CREATE TABLE `user` (
    `id` int(11) NOT NULL,
    `f_name` varchar(255) DEFAULT NULL,
    `l_name` varchar(255) DEFAULT NULL,
    `email` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `address` text DEFAULT NULL,
    `phone_number` varchar(255) DEFAULT NULL,
    `last_login` varchar(255) DEFAULT NULL,
    `token` varchar(255) DEFAULT NULL,
    `lang_id` int(11) DEFAULT NULL,
    `role` varchar(255) DEFAULT NULL,
    `created_at` date NOT NULL DEFAULT current_timestamp(),
    `updated_at` varchar(255) DEFAULT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');

$db->db_connection->query('CREATE TABLE `user_role` (
    `id` int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `role_id` int(11) NOT NULL,
    `created_at` int(11) DEFAULT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
  ');

$db->db_connection->query('CREATE TABLE `visit` (
    `id` int(11) NOT NULL,
    `ip` int(11) NOT NULL,
    `last_visit` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    `page` varchar(255) DEFAULT NULL,
    `created_at` int(11) DEFAULT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');

$db->db_connection->query('CREATE TABLE `website` (
    `id` int(11) NOT NULL,
    `color` varchar(255) NOT NULL,
    `font` varchar(255) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;');

$db->db_connection->query("CREATE TABLE `subject` (
    `id` int(11) NOT NULL,
    `name` varchar(255) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

$db->db_connection->query("CREATE TABLE `type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

$db->db_connection->query("CREATE TABLE `writer_subject` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `priority` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

$db->db_connection->query("CREATE TABLE `writer_service` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `priority` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

$db->db_connection->query("CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

$db->db_connection->query("CREATE TABLE `request_writer_queue` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `writer_id_on_queue_list` text DEFAULT NULL,
  `current_writer_id` int(11) DEFAULT NULL,
  `already_queued_id` text DEFAULT NULL,
  `itteration_no` int(11) NOT NULL DEFAULT 0,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `won_by_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
");

$db->db_connection->query("CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

$db->db_connection->query("CREATE TABLE `writer_type` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `priority` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

$db->db_connection->query("ALTER TABLE `contact_us`
ADD PRIMARY KEY (`id`);");
$db->db_connection->query("ALTER TABLE `contact_us`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");


$db->db_connection->query("ALTER TABLE `service`
ADD PRIMARY KEY (`id`);");


$db->db_connection->query("ALTER TABLE `service`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");


$db->db_connection->query("ALTER TABLE `writer_service`
ADD PRIMARY KEY (`id`);");

$db->db_connection->query("ALTER TABLE `request_writer_queue`
ADD PRIMARY KEY (`id`);
");

$db->db_connection->query("ALTER TABLE `request_writer_queue`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT");

$db->db_connection->query("ALTER TABLE `writer_service`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");

$db->db_connection->query("ALTER TABLE `writer_subject`
ADD PRIMARY KEY (`id`);");

$db->db_connection->query("ALTER TABLE `writer_subject`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");


$db->db_connection->query("ALTER TABLE `writer_type`
ADD PRIMARY KEY (`id`);");

$db->db_connection->query("ALTER TABLE `writer_type`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");

$db->db_connection->query("ALTER TABLE `type`
ADD PRIMARY KEY (`id`);");

$db->db_connection->query("ALTER TABLE `type`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");

$db->db_connection->query("ALTER TABLE `subject`
ADD PRIMARY KEY (`id`);");

$db->db_connection->query("ALTER TABLE `subject`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;");

$db->db_connection->query('ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);
');

$db->db_connection->query('ALTER TABLE `order_request`
  ADD PRIMARY KEY (`id`);
');

$db->db_connection->query('ALTER TABLE `chatroom`
  ADD PRIMARY KEY (`id`);');

$db->db_connection->query('ALTER TABLE `email`
  ADD PRIMARY KEY (`id`);');

$db->db_connection->query('ALTER TABLE `essay`
  ADD PRIMARY KEY (`id`);');
$db->db_connection->query('ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);');
$db->db_connection->query('ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);');
$db->db_connection->query('ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);');
$db->db_connection->query('ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);');
$db->db_connection->query('ALTER TABLE `offer`
  ADD PRIMARY KEY (`id`);');
$db->db_connection->query('ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);');
$db->db_connection->query("ALTER TABLE `review`
ADD PRIMARY KEY (`id`);");

$db->db_connection->query("ALTER TABLE `review` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT");

$db->db_connection->query('ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);');
$db->db_connection->query('ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);');
$db->db_connection->query('ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);');
$db->db_connection->query('ALTER TABLE `submission`
  ADD PRIMARY KEY (`id`);');
$db->db_connection->query('ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`id`);');
$db->db_connection->query('ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);');
$db->db_connection->query('ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);');
$db->db_connection->query('ALTER TABLE `visit`
  ADD PRIMARY KEY (`id`);');
$db->db_connection->query('ALTER TABLE `website`
  ADD PRIMARY KEY (`id`);
');
$db->db_connection->query("ALTER TABLE `orders` CHANGE `status` `status` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'draft, completed, canceled, progress, deactivated';");

$db->db_connection->query('ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;');
$db->db_connection->query('ALTER TABLE `email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;');
$db->db_connection->query('ALTER TABLE `essay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;');
$db->db_connection->query('ALTER TABLE `language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;');
$db->db_connection->query('ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;');
$db->db_connection->query('ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;');
$db->db_connection->query('ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;');
$db->db_connection->query('ALTER TABLE `offer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;');
$db->db_connection->query('ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;');
$db->db_connection->query('ALTER TABLE `order_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;');
$db->db_connection->query('ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;');
$db->db_connection->query('ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;');
$db->db_connection->query('ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;');
$db->db_connection->query('ALTER TABLE `submission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;');
$db->db_connection->query('ALTER TABLE `sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;');
$db->db_connection->query('ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;');
$db->db_connection->query('ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;');
$db->db_connection->query('ALTER TABLE `visit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;');
$db->db_connection->query('ALTER TABLE `website`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;');
$db->db_connection->query("ALTER TABLE `user` 
  ADD `title` VARCHAR(255) NULL AFTER `l_name`, ADD `description` TEXT NULL AFTER `title`;");
$db->db_connection->query("ALTER TABLE `user` ADD `profile_image` VARCHAR(255) NULL AFTER `token`;");

$db->db_connection->query("ALTER TABLE `order_request` ADD `language` VARCHAR(190) NULL DEFAULT NULL AFTER `source`;");
$db->db_connection->query("ALTER TABLE `order_request` ADD `price_after_service_charge` DOUBLE NOT NULL DEFAULT '0' AFTER `language`;");
$db->db_connection->query("ALTER TABLE `order_request` CHANGE `price` `price` DOUBLE NULL DEFAULT '0';");
$db->db_connection->query("ALTER TABLE `order_request` CHANGE `status` `status` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'draft, completed, canceled, progress, deactivated';");
$db->db_connection->query("ALTER TABLE `order_request` ADD `topic` VARCHAR(355) NULL AFTER `page_number`, ADD `subject` VARCHAR(190) NULL AFTER `topic`;");
$db->db_connection->query("ALTER TABLE `user` ADD `status` VARCHAR(25) NULL AFTER `role`;");
$db->db_connection->query("ALTER TABLE `website` ADD `email` VARCHAR(255) NULL AFTER `font`, ADD `phone` VARCHAR(255) NULL AFTER `email`, ADD `facebook` VARCHAR(255) NULL AFTER `phone`, ADD `twitter` VARCHAR(255) NULL AFTER `facebook`, ADD `instagram` VARCHAR(255) NULL AFTER `twitter`, ADD `linkedin` VARCHAR(255) NULL AFTER `instagram`;");

$db->db_connection->query("ALTER TABLE `orders` CHANGE `offer_id` `request_id` INT(11) NOT NULL;");
$db->db_connection->query("ALTER TABLE `orders` ADD `price_after_service_charge` DOUBLE NOT NULL AFTER `created_at`, ADD `finished_at` INT(11) NULL AFTER `price_after_service_charge`;");

$db->db_connection->query("INSERT INTO `contact_us` (`id`, `name`, `phone_number`, `email`, `message`) VALUES
(1, 'caggle', '0141433414', 'test@email.com', 'sadasd');");

$db->db_connection->query("INSERT INTO `subject` (`id`, `name`) VALUES
(1, 'Aviation'),
(2, 'Art'),
(3, 'Architecture'),
(4, 'Business'),
(5, 'Management'),
(6, 'Computer_Science'),
(7, 'Economics'),
(8, 'Engineering'),
(9, 'English'),
(10, 'Literature'),
(11, 'Health_Care'),
(12, 'Life_Science'),
(13, 'Sport'),
(14, 'History'),
(15, 'Humanities'),
(16, 'Law'),
(17, 'Marketing'),
(18, 'Mathematics'),
(19, 'Statistics'),
(20, 'Science'),
(21, 'Philosophy'),
(22, 'Political_Science'),
(23, 'Psychology'),
(24, 'Theology'),
(25, 'Ethics'),
(26, 'Social_Science'),
(27, 'History'),
(28, 'Geography'),
(29, 'Hospitality'),
(30, 'Other');");


$db->db_connection->query("INSERT INTO `type` (`id`, `name`) VALUES
(1, 'Essay'),
(2, 'Article_Review'),
(3, 'Book_Review'),
(4, 'Business_Plan'),
(5, 'Case_Study'),
(6, 'Creative_Writing'),
(7, 'Literature_Review'),
(8, 'Assignment'),
(9, 'Presentation'),
(10, 'Report'),
(11, 'Thesis_paper'),
(12, 'Home_Work');");


$db->db_connection->query("INSERT INTO `service` (`id`, `name`) VALUES
(1, 'Writing'),
(2, 'Editing'),
(3, 'Re_Writing'),
(4, 'Presentation');");

for ($i = 1; $i < 41; $i++) {
  $fakeFirstName = $faker->firstName();
  $fakeAddress = $faker->address;
  $fakeEmail = $faker->email;
  $stmt = $db->db_connection->prepare("INSERT INTO user (`id`,`f_name`, `l_name`, `email`, `password`, `lang_id`)
     VALUE (?, ?, ?, ?, ?, ?)");
  $stmt->execute([$i, $fakeFirstName, $faker->lastName, $fakeEmail, password_hash("secret", PASSWORD_DEFAULT), 1]);
}
for ($i = 0; $i < 40; $i++) {
  $roleId = rand(2, 4);
  $userId = rand(1, 39);
  $stmt = $db->db_connection->prepare("INSERT INTO user_role (`user_id`, `role_id`)
     VALUE (?, ?)");
  $stmt->execute([$userId, $roleId]);
}
for ($i = 0; $i < 90; $i++) {
  $type = [
    'Essay',
    'Article_Review',
    'Book_Review',
    'Business_Plan',
    'Case_Study',
    'Creative_Writing',
    'Literature_Review',
    'Assignment',
    'Presentation',
    'Report',
    'Thesis_paper',
    'Home_Work'
  ];
  $des = $faker->text;
  $page = $faker->randomDigit;
  $duration = rand(1, 8);
  $status = ['progress', 'draft', 'canceled', 'completed', 'denied'];

  $subject = [
    'Aviation',
    'Art',
    'Architecture',
    'Business',
    'Management',
    'Computer_Science',
    'Economics',
    'Engineering',
    'English',
    'Literature',
    'Health_Care',
    'Life_Science',
    'Sport',
    'History',
    'Humanities',
    'Law',
    'Marketing',
    'Mathematics',
    'Statistics',
    'Science',
    'Philosophy',
    'Political_Science',
    'Psychology',
    'Theology',
    'Ethics',
    'Social_Science', 'History', 'Geography', 'Hospitality', 'Other'
  ];
  $price = rand(20, 700);
  $user_id = rand(4, 34);
  $style = 'MLA';
  $lavel = ['high_school', 'college', "masters", "hw", "undergraduate"];


  $stmt = $db->db_connection->prepare("INSERT INTO order_request (`type`, `description`, `duration`, 
    `status`, `page_number`, `price`, `user_id`, `service`, `lavel`, `style`, `source`, `created_at`, `subject`) 
    VALUE (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? , ?, ? )");
  $stmt->execute([
    $faker->randomElement($type), $des, $duration, $faker->randomElement($status), $page,
    $price, $user_id, 'Writing', $faker->randomElement($lavel), $style, '1', time(), $faker->randomElement($subject)
  ]);
}
for ($i = 1; $i < 5; $i++) {
  $role = ['', 'root', 'admin', 'writer', 'student'];
  $stmt = $db->db_connection->prepare("INSERT INTO roles (`id`, `name`) VALUE (?,?)");
  $stmt->execute([$i, $role[$i]]);
}
for ($i = 0; $i < 15; $i++) {
  $category = [
    'AI', 'Scocial', 'Science', 'Arts', 'Com', 'Data Analysis', 'Pure math', 'advance math', 'Stat.', 'Education', 'Rural science', 'Business study', 'Business Admin', 'Business Analysist', 'Journalism', 'Marketer', 'Network', 'GSM'
  ];
  $stmt = $db->db_connection->prepare("INSERT INTO category (`name`) VALUE (?)");
  $stmt->execute([$category[$i]]);
}
for ($i = 0; $i < 60; $i++) {
  $stmt = $db->db_connection->prepare("INSERT INTO email (`recipient`, `subject`, `body`, `created_at`)
     VALUE (?, ?, ?, ?)");
  $stmt->execute([$faker->email, $faker->text, $faker->sentence(50, true), time()]);
}
for ($i = 0; $i < 40; $i++) {
  $stmt = $db->db_connection->prepare("INSERT INTO visit (`ip`, `page`, `last_visit`, `created_at`)
     VALUE (?, ?, ?, ?)");
  $stmt->execute(['127.0.0.1', '/home', time(), time()]);
}
for ($i = 0; $i < 90; $i++) {
  for ($j = 0; $j < 4; $j++) {

    $stmt = $db->db_connection->prepare("INSERT INTO offer (`description`, `duration`,
        `page_number`, `price`, `status`, `order_req_id`, `user_id`, `created_at`) VALUE (?, ?, ?, ?, ?, ?, ? ,?)");
    $stmt->execute([
      $faker->sentence(50, true), rand(2, 5), rand(2, 4), rand(10, 400),
      'pendinga', $i, rand(3, 34), time()
    ]);
  }
}

$stmt = $db->db_connection->prepare("SELECT `user`.`id` FROM `user` JOIN `user_role` ON  `user`.`id` = `user_role`.`user_id` WHERE `role_id` = ? ;");
$stmt->execute([3]);
$writerIds = $stmt->fetchAll(\PDO::FETCH_ASSOC);
foreach ($writerIds as $id) {
  for ($i = 0; $i < 4; $i++) {
    $stmt = $db->db_connection->prepare("INSERT INTO `writer_subject` (`user_id`,`subject_id`) VALUE (?,?);");
    $stmt->execute([$id['id'], rand(1, 25)]);
  }
  for ($i = 0; $i < 2; $i++) {
    $stmt = $db->db_connection->prepare("INSERT INTO `writer_service` (`user_id`,`service_id`) VALUE (?,?)");
    $stmt->execute([$id['id'], rand(1, 4)]);
  }
  for ($i = 0; $i < 4; $i++) {
    $stmt = $db->db_connection->prepare("INSERT INTO `writer_type` (`user_id`,`type_id`) VALUE (?,?)");
    $stmt->execute([$id['id'], rand(1, 12)]);
  }
}

$db->db_connection->query("INSERT INTO `review` (`id`, `customer_name`, `writer_name`, `topic`, `comment`, `rating`, `date`) VALUES
(3, 'Henry cavil', 'Nortorious', 'Programming', 'There is so much satisfaction in his writing', '5', '20-12-2020');");
echo "success";
