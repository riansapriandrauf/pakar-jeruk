<?php
session_unset();
session_destroy();
?>
<script>window.location.href="<?= url() ?>login";</script>