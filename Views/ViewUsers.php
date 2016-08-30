<?php
require_once('../Includes/Includes.php');

?>
<p>
<div class="gameWrapper">
    <p><h1>Players</h1></p>
    <table class="PlayerTable">
        <tr>
        <th>Player_ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Username</th>
        <th>Password</th>
        <th>Birthdate</th>
        <th>Date of Death</th>
        <th>Credits</th>
        <th>Coins Won</th>
        <th>Coins Bet</th>
        <th>Lifetime Spins</th>
        <th>Lifetime Average Returns</th>
        <th>Email</th>
        <th>Admin Privileges</th>
        <th>Registration Date</th>
        <th>Registration Time</th>"
    <?php
    ?>
    <?php

    $players = new Player();
    $players->loadAll();

    ?>
    </table>
</div>
