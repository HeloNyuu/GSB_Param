<?php
 $mdp = password_hash('123', PASSWORD_DEFAULT);
 echo $mdp;
 ?>
 
</br>
<?php
 $verify = password_verify('123', $mdp);
 echo $verify;
?>