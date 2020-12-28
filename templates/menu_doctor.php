<section id="profile_pag">
  <article>
    <header id="dados">
      <img class="circle" src="<?php echo  $result["photo"] ?>" alt="" width="130">
      <h4><?php echo  $result["name"] ?></h4>
      <h5><?php echo  $result2["Sname"] ?></h5>

    </header>

    <aside class="aside_profile">
      <input type="checkbox" id="hamburger">
      <label class="hamburger" id="prof" for="hamburger">
        <ul id="link_profile">

          <li><a href="#profile">My Profile</a></li>
          <li><a href="#appointments">My Appointments</a></li>
          <li><a href="#schedule">Schedule</a></li>
          <li><a href="#inpatients">Inpatients</a></li>
          <li><a href="index.php">Home</a></li>
        </ul>
      </label>
    </aside>
  </article>

  <div class="info">
    <h2 id="profile"> Profile</h2>
    <span><?php echo $msg ?></span>

    <article class="info_section">
      <h4>Personal identification: </h4>
      <h5 class="atribute">Name: <p><?php echo  $result["name"] ?></p>
      </h5>
      <h5 class="atribute">Department: <p><?php echo  $result2["Sname"] ?></p>
      </h5>
    </article>

    <article class="info_section">
      <h4 class="info_section">Contacts: </h4>
      <h5 class="atribute">Mail Address: <p><?php echo  $result["mail_address"] ?></p>
      </h5>
      <?php if (strlen($result["phone_number"]) > 0) { ?>
        <h5 class="atribute">Phone Number: <p><?php echo  $result["phone_number"];
                                            } ?></p>
        </h5>
    </article>


    <h2 id="appointments">Appointments</h2>
    <article class="info_section">
      <h4 class="info_section">Scheduled appointments: </h4>
      <?php if ($numRowsAppointment['num'] != 0) { ?>
        <?php foreach ($result3 as $row) { ?>

          <?php if ($row["date"] > $today) { ?>
            <h5 class="atribute">
              <p>Name: <?php echo  $row["patient"] ?></p>
              <h6 class="subatribute">
                <p>Date: <?php echo  $row["date"] ?> </p>
                <p>Hour: <?php echo  $row["Hour"] ?> </p>

                <form action="appointment_info.php" method="post">

                  <?php $_SESSION["patient_cc"] = $row["cc"];
                  $_SESSION["appointment"] = $row["id"]; ?>
                  <input id="appointment_file" type="submit" value="Appointment file"></input>
                </form>
              </h6>
            </h5>

          <?php }  ?>

        <?php  } ?>
      <?php } else { ?>
        <p>There is no Scheduled appointments</p>
      <?php } ?>

    </article>

    <article class="info_section">

      <h4 class="info_section" id="reservation">Reservation without answer: </h4>

      <?php if ($numRowsReservation['num'] != 0) { ?>
        <?php foreach ($result4 as $row) { ?>

          <?php if (getDoctorReservationWithAnswer($row["id"], $result["id"]) == FALSE) { ?>


            <h5 class="atribute">
              <p>Name: <?php echo  $row["patient"] ?></p>
              <h6 class="subatribute">
                <p>Date: <?php echo  $row["date"] ?> </p>
                <p>Hour: <?php echo  $row["Hour"] ?> </p>
                <div id="button-container">
                <form action="Accept_reservation.php" method="post">
                  <input type="hidden" name="R_ID" value=<?php echo $row["id"] ?>></input>
                  <input type="hidden" name="D_ID" value=<?php echo $result["id"] ?>></input>
                  <input id ="accept" type="submit" value="Accept"></input>
                </form>
                <form action="Reject_reservation.php" method="post">
                  <input type="hidden" name="D_ID" value=<?php echo $result["id"] ?>></input>
                  <input type="hidden" name="R_ID" value=<?php echo $row["id"] ?>></input>
                  <input id ="reject" type="submit" value="Reject"></input>
                </form>
                </div>
              </h6>
            </h5>

          <?php } ?>
        <?php } ?>
      <?php } else { ?>
        <p>There is no Reservation Request.</p>
      <?php } ?>
      <span><?php echo $msg_R ?></span>

    </article>


    <h2 id="inpatients">Inpatient</h2>
    <article class="info_section">
      <h4 class="info_section">Monitor inpatients: </h4>
      <?php if ($numRowsInpatient['num'] != 0) { ?>
        <?php foreach ($result_inpatient as $row) { ?>

          <h5 class="atribute">
            <p>Name: <?php echo  $row["name"] ?></p>
            <h6 class="subatribute">
              <p>Bed: <?php echo  $row["bed"] ?> </p>
              <p>Code: <?php echo  $row["code"] ?> </p>
              <p>You can consult more info about the inpatient <a href='inpatient.php?code=<?php echo $row["code"] ?>'>here.</a> </p>
            </h6>
          </h5>
        <?php  } ?>
      <?php } else { ?>
        <p>You are not monitoring any inpatient.</p>
      <?php } ?>
    </article>


    <h2 id="schedule">Schedule</h2>
    <article class="info_section">
    <?php $week_days = array('MON', 'TUE', 'WED', 'THU', 'FRI'); ?>
    <?php $begin_hours = array('08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00'); ?>

    <?php if ($numRowsSchedule['num'] != 0) { ?>

      <table class="doctor_schedule">

        <tr>
          <th class="b"> Hour</th>
          <th class="b"> Monday </th>
          <th class="b"> Tuesday </th>
          <th class="b"> Wednesday </th>
          <th class="b"> Thursday </th>
          <th class="b"> Friday </th>

        </tr>
        <?php foreach ($begin_hours as $begin_hour) { ?>
          <!-- Para cada linha-->
          <tr>

            <td class="block_time"> <?php echo $begin_hour ?> - <?php echo $begin_hour + 1; ?>:00 </td>

            <?php foreach ($week_days as $day) { ?>
              <!-- Para cada coluna -->

              <?php if (canMakeAppointment($schedule, $begin_hour, $day) == 1) { ?>
                <td class="mark_appointment">
                  <?php echo "Doing Appointments"; ?>
                </td>
              <?php } else { ?>
                <td class="mark_appointment"></td>
              <?php } ?>

            <?php } ?>

          </tr>

        <?php } ?>


      </table>
    <?php } else { ?>
      <!-- create schedule -->
      <h3>Create your schedule</h3>
      <form action="action_create_schedule.php" method="post">
        <table class="doctor_schedule">

          <tr>
            
            <th class="b"> Hour</th>
          
            <th class="b"> Monday </th>
            <th class="b"> Tuesday </th>
            <th class="b"> Wednesday </th>
            <th class="b"> Thursday </th>
            <th class="b"> Friday </th>

          </tr>
          <?php foreach ($begin_hours as $begin_hour) { ?>
            <!-- Para cada linha-->
            <tr>

              <td class="block_time"> <?php echo $begin_hour ?> - <?php echo $begin_hour + 1; ?>:00 </td>

              <?php foreach ($week_days as $day) { ?>
                <!-- Para cada coluna -->
                <?php $_SESSION["hour"] = $begin_hour; ?>
                <?php $_SESSION["week_day"] = $day; ?>

                <td class="mark_appointment">
                  <input type="checkbox" name="check_list[]" value="<?php echo $begin_hour . '|' . $day ?>">
                </td>

              <?php } ?>
            </tr>

          <?php } ?>

        </table>
        <input id = "create_sche" type="submit" value="Create Schedule">
      </form>
    <?php } ?>

    </article>

    <h2>Hospitalize patient</h2>
    <article class="info_section">

      <p> Insert the cc of Patient that you want Hospitalize: </p>
      <form action="action_Hospitalize.php" class="atribute" method="post">
        <label><b>Patient's cc</b></label>
        <input type="text" name="cc" required>
        <input type="hidden" name="Dep_ID" value=<?php echo $result["speciality"] ?>></input>


        <input id="add" type="submit" value="Submit">
        <span><?php echo $msg_H ?></span>
      </form>
    </article>

    <h2>Discharge an inpatient</h2>
    <article class="info_section">

      <p> Enter the code of the inpatient who wishes to be discharged: </p>
      <form action="action_discharge.php" class="atribute" method="post">
        <label><b>Inpatient code</b></label>
        <input type="text" name="code" required>
        <input type="hidden" name="Dep_ID" value=<?php echo $result["speciality"] ?>></input>

        <input id="add" type="submit" value="Submit">
        <span><?php echo $msg_d ?></span>
      </form>
    </article>

  </div>

</section>