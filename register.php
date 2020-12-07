<!--pagina para registar se na plataforma-->
<?php
  session_start();
  require_once('config/init.php');

?>
  <!--não sei se é valido meter assim senão temos o header_register q é exatamente igual ao header_profile mas com estes links... ia ser repetir o codigo todo mas se achares melhor ...-->
    <link href="css/animation.css" rel="stylesheet">
    <link href="css/forms.css" rel="stylesheet">
<?php

  include('templates/header_profile.php');
  include('templates/register_pag.php'); // content
  include('templates/footer.php');
?>
