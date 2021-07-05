<?php
session_start();
session_destroy();
//header('Location: index');
echo "<script type='text/javascript'>alert('ออกจากระบบเรียบร้อย');location='index?p=logout'</script>"
//exit();
?>