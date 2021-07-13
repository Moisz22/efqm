<?php
 if (isset($_SESSION['id']))
 {
   header('Location:views/dashboard');
 }
 else
  header('Location:views/dashboard');