<?php
include_once "parts/nav.php";

try {
    $bdd = new PDO('mysql:host=localhost;port=3306;dbname=guinea-pig-presidentials;charset=utf8', 'root', 'root');
}
catch(Exception $e){
    die ('Erreur: '.$e->getMessage());
}

$sql= $bdd->query('SELECT * FROM results');
$sql->execute();
$data=$sql->fetchAll();
$highest = 0;
$president = "Me";

for ($x=0; $x<sizeOf($data); $x++){
    if ($data[$x][1] > $highest){
        $highest = $data[$x][1];
        $president = $data[$x][0];
    }
}

?>
    
    <link rel="stylesheet" href="assets/css/president.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bubblegum+Sans&display=swap" rel="stylesheet">
</head>
<body>
<div id="president-container">
    <h1 id='president-title'>BEHOLD!!<br/> Your current Piggy President !</h1>
    <div id='president-img-box'>
        <img id='president-img' src=''>
    </div>
    <div id='president-info'>
        <p id='president-name'> <?php echo $president ?> </p>
        <p id='president-vote'>(Votes: <?php echo $highest ?> )</p>
    </div>
</div>
<?php
include_once "parts/footer.php";
?>