<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Intractive &mdash; Your Profile</title>
  <?php echo $css; ?>
</head>

<body>
  <div class="container">
    <?= $navigation; ?>
    <div class="content">
      <?= $sidebar; ?>
      <main class="hotel-view">
        <div class="profile-detail detail">
          <div class="profile__container">
            <div class="profile">
              <h4>Before you finish this order, please accept our thanks for using our services!</h4>
              <h2 class="paragraph">
                <?php if($this->session->userdata('gender') == 'M') {
                  $str = 'Dear Mr.';
                }
                else {
                  $str = 'Dear Ms.';
                }
                  echo $str . ' ' . $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . ":"; 
                ?>
              </h2>
              <p class="paragraph">
                I just wanted you to know that we truly enjoy working with you and feel honored to be your chosen hotel provider.<br/>
                Your business is much appreciated, and we will do our very best to continue to meet your hotel booking needs.<br/>
                Your continued patronage and suggestions are a vital part of our growth.<br/><br/> 
                
                As the boss of Intractive, I founded this company and raised it to be glorious with my own skills and talents.<br/>
                While skills and talents can be limitless, there are two things that are more valuable, customers and friends.<br/> 
                Without my friends and team, Intractive would not be as big as now.<br/>
                Without customers, we would be nothing more than a speck of dust. For that, we are most grateful.<br/>
                Thanks again! We look forward to serving you for many years to come.<br/><br/>
                Alas, before that, allow me to present you with one philosophical statement. Something to ponder about.<br/><br/>
                <span class="paragraph--italic paragraph--bold">
                  "Humans are creatures that cannot choose the correct answer. Myself included.<br/> 
                  No matter how much anguish, how much fighting, how many repetitions, there is one single truth.<br/> 
                  Our history has never produced the "correct result."<br/> 
                  Why is that? Needless to say, it's because humans will not develop further. We are too weak.<br/> 
                  It's not because of the individual, but the entirety.<br/><br/>

                  We can only love others, approve of others, respect others, in specific environments and circumstances.<br/> 
                  Human intelligence at its core is based on depriving others.<br/>
                  Our world has no utopias. Our world has no place without victims.<br/>
                  If today's humans can't make it, then change them. If humans are a weak seed, then strengthen them.<br/><br/>

                  What if, from this, all humans living on this earth be reborn again?<br/> 
                  Abandon the human format, for with:<br/>
                    - Excellent vessels;<br/>
                    - Higher-order perception, and<br/> 
                    - Next-generation standards,<br/>
                  Humans shall advance into life forms that surpass the Gods -- beings beyond human.<br/>
                  When that happens, humanity shall shoot down the concept of God."<br/><br/>
                </span>
                Please don't think too much about it - I'm just feeling a bit philosophical when writing it.<br/><br/>
                <span class="paragraph--bold">
                  Best regards,<br/>
                  Nicholas Dwiarto Wirasbawa<br/>
                  Leader/Boss of Intractive.
                </span>
              </p><br/>
              <p class="paragraph">Please pay and give us your rating here!</p>
              <form action="<?php echo site_url() . "booking/confirmFinishBooking"; ?>" class="form-booking" method="POST">
                <input type='hidden' name='order_id' class="form-booking__input" value="<?php echo $id; ?>">
                <input type="hidden" name='room_id' class="form-booking__input" value="<?php echo $rooms['room_id']; ?>">
                <input type='hidden' name='ordered_rooms' class="form-booking__input" value="<?php echo $rooms['num_rooms']; ?>">
                <h4>Payment (Rp. <?= number_format($rooms['price']); ?>)</h4>
                <input type="number" class="form-booking__input" name='payment' placeholder="Pay..." required>
                <h4>Rating</h4>
                <select name="rating" class="form-booking__input" required>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                </select>
                <br><br>
                <div class="u-center-text">
                  <input type="submit" class='btn-inline u-center-text' value="Finish Order!">
                </div>
                <?php
                $error_message = $this->session->flashdata('error_message');
                echo "<p class='paragraph'>$error_message</p>";
                ?>
              </form>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</body>

</html>