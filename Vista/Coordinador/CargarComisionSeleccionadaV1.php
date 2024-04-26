<?php
$IDComision = $_POST['ID_Com'];
$NombreComision = $_POST['NombreCom'];
?>

<form id="myForm" method="post" action="../../Vista/Coordinador/ComisionSeleccionaV1.php">
  <input type="hidden" name="ID_Com" value="<?php echo $IDComision; ?>">
  <input type="hidden" name="NombreCom" value="<?php echo $NombreComision; ?>">
</form>

<script>
  document.getElementById("myForm").submit();
</script>