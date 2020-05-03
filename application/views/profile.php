<?php 
  defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Intractive &mdash; Your Profile</title>
  
  <!-- Will only use modal on this page only, so I will not include it on other pages. -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
  <!-- Done jQuery -->

  <?php echo $css; ?>
</head>

<body>

  <!-- jQuery Modal -->
  <div id="ex1" class="modal">
    <form action="<?php echo site_url() . ""; ?>" method="POST">
      <input type='hidden' name='order_id'>
      <input type="hidden" name='room_id'>
      <h2>Payment</h2>
      <input type="number" name='payment'>
      <select name="rating">
        <option value="1">1</option>
      </select>
      <input type="submit" value="Finish!">
    </form>    
    <a href="#" rel="modal:close">Close</a>
  </div>
  <!-- End jQuery Modal -->

  <div class="container">
    <?php
      echo $navigation;
    ?>

    <div class="content">
      <?php
        echo $sidebar;
      ?>

      <main class="hotel-view">
        <div class="profile-detail detail">
          <div class="profile__container">

            <div class="profile">
              <div class="profile__profile-picture">
                <img src="<?php echo base_url() . $user_data['profile_pic']; ?>" alt="">
              </div>

              <div class="profile__content">
                <?php echo "<p class='paragraph--bold'>" . $user_data['first_name'] . " " . $user_data['last_name'] . "</p>"; ?>
                <?php echo "<p class='paragraph'>" . $user_data['birthdate'] .  "</p>"; ?>
                  
                <div class="profile__text-gallery">
                  <p class='profile__text-gallery__text-par'>Posts 0</p>
                  <p class='profile__text-gallery__text-par'>Likes 0</p>
                  <p class='profile__text-gallery__text-par'>Friends 0</p>
                  <p class='profile__text-gallery__text-par'>Reputation 0</p>
                </div>
                <a href="index.php">Return to Home</a>
              </div>
            </div>

            <?php
              if($user_data['username'] === $this->session->userdata('username')) {
                $username = $user_data['username'];
                echo "
                <div class='profile__change-picture'>
                  <form action='' method='POST' enctype='multipart/form-data'>
                    <p class='paragraph'>Change your profile picture here:</p>
                    <input type='hidden' name='username' value=$username readonly/>
                    <input type='file' name='fileToUpload' id='fileToUpload'>
                    <input type='submit' value='Upload Image' name='submit' class='btn-inline'>
                  </form>
                </div>
                ";
              }
            ?>
          </div>
        </div>

        <div class="profile-detail detail">
          <div class="profile__container">
            <div class="profile">
              
              <?php
                if($user_hotel !== FALSE && $this->session->userdata('username') === $user_data['username']) {
              ?>

              <h2>My Transactions</h2>
              <table class='profile__table'>
                <thead class='profile__table__header'>
                  <th>Order ID</th>
                  <th>Hotel Name</th>
                  <th>Room Name</th>
                  <th>Rooms</th>
                  <th>Nights</th>
                  <th>Price (Rp.)</th>
                  <th>Action</th>
                </thead>
                <tbody class='profile__table__body'>
                  <?php
                    /*  Combine joined arrays by its primary key.
                    *   The length of the array should be same, as it's a simple logic - one cannot have more rooms that he/she had ordered.
                    *   Algorithm: Knapsack. Can't believe I have to use this in web development.
                    */
                    for($i = 0; $i < count($user_hotel); $i++) {
                      $order_id = $transaction_data[$i]['id'];
                      $hotel_name = $user_hotel[$i]['name'];
                      $room_name = $user_rooms[$i]['room_name'];
                      $duration = $user_hotel[$i]['duration'];
                      $price = number_format($user_hotel[$i]['price']);
                      $num_rooms = $user_hotel[$i]['num_rooms'];

                      echo "<tr>";
                        echo "<td>$order_id</td>";
                        echo "<td>$hotel_name</td>";
                        echo "<td>$room_name</td>";
                        echo "<td>$num_rooms</td>";
                        echo "<td>$duration</td>";
                        echo "<td>$price</td>";
                        echo "<td><a href='#ex1' rel='modal:open'>Finish</a></td>";
                      echo "</tr>";
                    }
                  ?>
                </tbody>
              </table>

              <?php
                }
                else if($this->session->userdata('username') !== $user_data['username']) {
                  echo "<h2>You cannot see someone else's transaction history!</h2>";
                }
                else {
                  echo "<h2>You currently have no transactions!</h2>";
                }
              ?>
            
            </div>
          </div>
        </div>

      </main>

    </div>
  </div>

</body>

</html>