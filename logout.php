<?php
session_start();
session_unset();
echo "
<script>
alert('Logged Out Successfully');
window.location.assign('log1.php')
</script>
";
?>	