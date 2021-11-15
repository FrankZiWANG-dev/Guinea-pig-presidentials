<?php
include_once "parts/nav.php";

try {
    $bdd = new PDO('mysql:host=localhost;port=3306;dbname=guinea-pig-presidentials;charset=utf8', 'root', 'root');
}
catch(Exception $e){
    die ('Erreur: '.$e->getMessage());
}

if (isset($_POST['vote'])){
    $sql='SELECT Votes FROM results WHERE Name = ?';
    $votes = $bdd->prepare($sql) -> execute([$_POST["Piggy"]]);
    $votes++;
    $sql2= 'UPDATE results SET Votes = ? WHERE Name = ?';
    $bdd->prepare($sql2) -> execute([$votes,$_POST["Piggy"]]);
}
?>
    
    <link rel="stylesheet" href="assets/css/vote.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bubblegum+Sans&display=swap" rel="stylesheet">
</head>
<body>
<div id="vote-container">
    <h1>Time to cast your vote !</h1>
    <form action="vote.php" method="post">
        <label for="Piggy"> Choose your favorie piggy: </label>
        <br/>
        <select name="Piggy">
            <option value="https://github.com/FrankZiWANG-dev/Guinea-pig-presidentials/blob/master/assets/images/President-guinea-pig.jpg?raw=true" disabled selected> Choose wisely </option>
            <option value="https://github.com/FrankZiWANG-dev/Guinea-pig-presidentials/blob/master/assets/images/Boulette-1.jpg?raw=true"> Boulette </option>
            <option value="https://github.com/FrankZiWANG-dev/Guinea-pig-presidentials/blob/master/assets/images/Nugget-1.jpg?raw=true"> Nugget </option>
            <option value="https://github.com/FrankZiWANG-dev/Guinea-pig-presidentials/blob/master/assets/images/Burrito-1.jpg?raw=true"> Burrito </option>
        </select>
        <br/>
        <img id="vote-piggy-image" src="https://github.com/FrankZiWANG-dev/Guinea-pig-presidentials/blob/master/assets/images/President-guinea-pig.jpg?raw=true">
        <br/>
        <input type="submit" name="vote" value="Cast your vote !">
    
    </form>
</div>
<?php
include_once "parts/footer.php";
?>