<section id="profile_pag">

  <article>
    <header id="dados">
      <img class="circle" src="images/w1.PNG" alt="" width="130">
      <h4><?php echo  $result["name"] ?></h4>
    </header>


    <aside class="aside_profile">
      <input type="checkbox" id="hamburger">
      <label class="hamburger" id="prof" for="hamburger">
        <ul id="link_profile">
          <li><a href="#profile">My Profile</a></li>
          <li><a href="Appointment.php">Book Appointment</a></li>
          <li><a href="#appointments">My Appointments </a></li>
          <li><a href="#medical">Medical prescriptions</a></li>
          <li><a href="#inpatients">Inpatient Profile</a></li>
          <li><a href="#Notifications">Notifications</a></li>
          <li><a href="index.php">Home</a></li>
        </ul>
      </label>
    </aside>

  </article>

  <div class="info">
    <h2 Id="profile">Profile</h2>
    <span><?php echo $msg ?></span>

    <article class="info_section">
      <h4>Personal identification: </h4>
      <h5 class="atribute">Name: <p><?php echo  $result["name"] ?></p>
      </h5>
      <h5 class="atribute">Age: <p><?php echo  $result["age"] ?></p>
      </h5>
      <h5 class="atribute">CC: <p><?php echo  $result["cc"] ?></p>
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

    <article class="info_section">
      <h4 class="info_section">Diagnosed disease: </h4>

      <?php $i = 0;
      $sum_null = 0; ?>
      <?php foreach ($result2 as $row) { ?>
        <?php $i = $i + 1; ?>
        <?php if (!is_null($row['disease_name'])) { ?>
          <!-- Se tiver algum diagnóstico-->
          <h5 class="atribute">Name : <p><?php echo $row["disease_name"]; ?></p>
          </h5>
        <?php } else {
          $sum_null = $sum_null + 1;
        } ?>

      <?php } ?>
      <?php if ($sum_null == $i) { ?>
        <p> You have no diagnosed disease. </p>
      <?php } ?>
    </article>

    <article class="info_section" id="appointments">
      <h4 class="info_section">Appointments: </h4>
      <?php $i = 0;
      $sum_null = 0; ?>
      <?php foreach ($result2 as $row) { ?>
        <?php $i = $i + 1; ?>
        <?php if (!is_null($row['doctor'])) { ?>
          <?php if ($row["date"] > $today) { ?>
          <h5 class="atribute">
            <p>Speciality: <?php echo  $row["speciality"] ?></p>
            <h6 class="subatribute">
              <p>Doctor: <?php echo  $row["doctor"] ?></p>
              <p>Date: <?php echo  $row["date"] ?> <tab> Hour: <?php echo  $row["Hour"] ?></p>
              <?php if (!is_null($row['disease_name'])) { ?>
                <p>Diagnostic: <?php echo  $row["disease_name"] ?></p>
              <?php } ?>
            </h6>
          </h5>
          <?php } ?>
        <?php } else {
          $sum_null = $sum_null + 1;
        } ?>
      <?php  } ?>
      <?php if ($sum_null == $i) { ?>
        <p> You have no appointments. </p>
      <?php } ?>
    </article>

    <article class="info_section" id="medical">
      <h4 class="info_section">Prescriptions: </h4>

      <?php $i = 0;
      $sum_null = 0; ?>
      <?php foreach ($result3 as $row) { ?>
        <?php $i = $i + 1; ?>
        <?php if ($row["date_limit"] > $today) { ?>
          <!-- apenas mostrar as receitas que estão dentro da data limit -->
          <h5 class="atribute">
            <p><a href="prescription.php?id=<?php echo $row["id_prescription"] ?>"> Prescription ID:<?php echo  $row["id_prescription"] ?></a><br> Date limit: <?php echo  $row["date_limit"] ?> </p>
          </h5>
        <?php } else {
          $sum_null = $sum_null + 1;
        } ?>
      <?php  } ?>
      <?php if ($sum_null == $i) { ?>
        <p> You have no Prescriptions. </p>
      <?php } ?>
    </article>

    <article class="info_section" id="inpatients">
      <h4 class="info_section">Inpatient Profile: </h4>
      <!-- verificar se o paciente está registado na tabela inpatient -->

      <?php if (!is_null($result4['code'])) { ?>
        <h5 class="atribute">
          <p> The patient is hospitalized with the code <a href="inpatient.php?code=<?php echo $result4["code"] ?>"> <?php echo  $result4["code"] ?></a>
            in the department of <?php echo  $result4["depart_name"] ?>, and in bed number <?php echo  $result4["bed"] ?>. </p>
        </h5>

      <?php  } else { ?>
        <p> The patient doesn't have a profile inpatient. </p>
      <?php } ?>
    </article>


    <article class="info_section" id="Notifications">
      <h4 class="info_section">Notification: </h4>
      <?php $i = 0;
      $sum_null = 0; ?>
      <?php foreach ($result5 as $row) { ?>
        <?php $i = $i + 1; ?>
        <?php if (!is_null($row['message'])) { ?>
          <form action="Action_receive_Notification.php" method="post">
            <span>
              <p> Your reservation for an appointment for day <?php echo $row["date"] ?> at <?php echo $row["begin_time"] ?>
                for <?php echo $row["department"] ?> Doctor <?php echo $row["doctor"] ?> has been <?php echo $row["message"] ?></p>
            </span>

            <input type="hidden" name="message" value=<?php echo $row["message"] ?>></input>
            <input type="hidden" name="notification_ID" value=<?php echo $row["id"] ?>></input>
            <input type="hidden" name="reserv_ID" value=<?php echo $row["reservation"] ?>></input>
            <input type="hidden" name="patient_cc" value=<?php echo $_SESSION['user'] ?>></input>
            <input type="submit" value="received"></input>

            <span><?php echo $msg_N  ?></span>
          </form>
        <?php } else {
          $sum_null = $sum_null + 1;
        } ?>
      <?php  } ?>
      <?php if ($sum_null == $i) { ?>
        <p> You have no Notification to read. </p>
      <?php } ?>

    </article>

  </div>
</section>