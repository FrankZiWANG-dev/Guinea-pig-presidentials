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
    <form id='vote-form' action="vote.php" method="post">
        <label id="vote-label" for="Piggy"> Choose your favorie piggy: </label>
        <br/>
        <select name="Piggy" id="Piggy" onchange="changeImage()">
            <option value="" disabled selected> Your choice </option>
            <option value="Boulette"> Boulette </option>
            <option value="Nugget"> Nugget </option>
            <option value="Burrito"> Burrito </option>
        </select>
        <br/>
        <div id="vote-image-container">
            <img id="vote-piggy-image" src="https://github.com/FrankZiWANG-dev/Guinea-pig-presidentials/blob/master/assets/images/President-guinea-pig.jpg?raw=true">
        </div>
        <input type="submit" id="vote-button" name="vote" onclick="thankVoter()" value="Cast your vote !">
    
    </form>
</div>
<?php
include_once "parts/footer.php";
?>