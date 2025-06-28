<?php

include 'conn.php';

$sql = "DELETE FROM pets WHERE idPet=" .$_REQUEST["idPet"];

if($conn->query($sql)){
    echo "<script>alert('Pet Deletado');</script>";
    print "<script>location.href='config.php';</script>";
}
else{
    echo "<script>alert('Falaha ao Deletar Pet{$conn->error}');</script>";
    print "<script>location.href='config.php'</script>";
}
