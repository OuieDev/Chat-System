<?php 
  session_start();
  include 'classes/Db.class.php';
  include 'classes/models/Show.mod.php';
  include 'classes/models/User.mod.php';

  $db = new Db();
  $conn = $db->getConnection();

  $showData = new Show();
  //this is for all user chat
  $allUser = $showData->users();
  $allUsers = $showData->users();

  include 'partials/chat-header.php';

?>


<div class="wrapper">
<?php

if(isset($_SESSION["user_email"])){
    echo "You are logged in " . $_SESSION["user_email"] . "!";
}else{
    echo "logged out";
}

?>
  <div class="second-wrapper">
      <!-- header -->
    <header class="header">
        <div class="bg-primary p-2 d-flex justify-content-evenly">
          <div class="p-2 d-flex justify-content-center"> <span class="online"></span><p class="text-center text-light fs-6"> <?= $_SESSION["user_email"] ?></p> </div>
           <a href="includes/logout.inc.php" class="text-light">Log out</a>

            <form action="one-on-one-chat.php?" method="GET">
              <select name="id" id="" placeholder="Select">
                  <option value="">Select user</option>
                  <?php
                  while ($users = $allUser->fetch(PDO::FETCH_ASSOC)) {
                    $users['name'];

                    $newUserName = str_replace(" ", "-", $users);
                    ?> 
                    <option value=<?= $newUserName['id'] ?>><?= $users['name'] ?></option>
                    <?php } ?>

              </select>
              <button type="submit">chat</button>
            </form>
        </div>
    </header>
      <!-- messages -->
    <section class="messages" id="result">
        <!-- fetching data -->
    </section>
      <!-- input -->
    <section class="form-container bg-light">
        <form action="includes/user.inc.php" method="POST" class="d-flex justify-content-between message-input">
            <input type="text" name="message" placeholder="type your message" class="border border-primary rounded p-2 me-2">
            <button type="submit" name="submit" class="btn btn-primary">send</button>
        </form>
    </section>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


    <script src="js/main.js"></script>
</body>
</html>

