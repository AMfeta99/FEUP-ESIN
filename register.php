<!--pagina para registar se na plataforma-->
<?php
  require_once('config/init.php');

?>
  <!--não sei se é valido meter assim senão temos o header_register q é exatamente igual ao header_profile mas com estes links... ia ser repetir o codigo todo mas se achares melhor ...-->
    <link href="animation.css" rel="stylesheet">
    <link href="forms.css" rel="stylesheet">
<?php

  include('templates/header_profile.php');
  include('templates/register_pag.php'); // content
  include('templates/footer.php');
?>
