<!-- ************ DELETETAR SQL com comandos preparados ******** -->

<html>
  <head>
    <title>DELETAR BD</title>
    <meta charset="utf-8"/> 
  </head>
    
<body> 

<?php

//Config. para acesso ao mySql localmente 
$servername = "sql311.epizy.com";
$username = "epiz_26899365";
$password = "EGacsonXcBn0v";
$dbname = "epiz_26899365_concurso";
$num_delete = $_GET['num_concurso'];

$conn = mysqli_connect($servername, $username, $password);


if (!$conn) {
  die("Falha na Conexão: " . mysqli_connect_error());
}
echo "Conectado com Sucesso <BR><BR>";

// Selecionando banco
if (!mysqli_select_db($conn,$dbname)) {
    echo "Não foi possível selecionar base de dados \"$dbname\": " . mysqli_error($conn);
    exit;
}

//stmt = statment ou comando
//stmt é o comando a ser preparado    
$stmt = mysqli_stmt_init($conn);

//devolve um boolen indicando se a string do stmt está ok
$stmt_prepared_okay =  mysqli_stmt_prepare($stmt, "DELETE FROM concurso WHERE num_concurso = ?");

if ($stmt_prepared_okay) {

    /* atribui os parâmetros aos marcadores */
    /*tipos possíveis de marcadores:
      i - integer
      d - double
      s - string
      b - BLOB*/
      mysqli_stmt_bind_param($stmt, "i", $num_delete);
    
    $stmt_executed_okay = mysqli_stmt_execute($stmt);

    if ($stmt_executed_okay) {
	   echo "Os registros foram excluidos com sucesso.";
    } else {
        echo "Não foi possível executar a inserção de ".
             "$nome $salario no banco de dados" . 
             mysqli_error($conn);
        exit;
    }
      mysqli_stmt_close($stmt);
}


/* fecha a conexão */
mysqli_close($conn);    

?>
    <br><br>
    <button onclick="window.location.href ='q1.php'">Home</button>
    <button onclick="window.location.href ='consulta.php'">Consulta</button>
</body>
</html>