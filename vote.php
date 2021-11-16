<script> if (window.localStorage.getItem("Voted") == "Yes"){
    alert('You already voted!');
    window.location.href='president.php';
}
</script>
<?php
include_once "parts/nav.php";

try {
    $bdd = new PDO('mysql:host=localhost;port=3306;dbname=guinea-pig-presidentials;charset=utf8', 'root', 'root');
}
catch(Exception $e){
    die ('Erreur: '.$e->getMessage());
}

if (isset($_POST["vote"]) && isset($_POST['Piggy'])){
    //prepared statement to get number of votes
    $sql= $bdd->prepare('SELECT Votes FROM results WHERE Name = ?');
    $sql->execute([$_POST["Piggy"]]);
    $data=$sql->fetch();
   
    //update number votes 
    $sql2= 'UPDATE results SET Votes = ? WHERE Name = ?';
    $bdd->prepare($sql2) -> execute([$data[0]+1,$_POST["Piggy"]]);
    
    unset($_POST['vote']);

    echo '<script type="text/javascript">window.localStorage.setItem("Voted", "Yes");</script>';

    header("location: president.php");
}
?>
    
    <link rel="stylesheet" href="assets/css/vote.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bubblegum+Sans&display=swap" rel="stylesheet">
</head>
<body>
<div id="vote-container">
    <h1 id='vote-title'>Time to cast your vote !</h1>
    <form id='vote-form' method="post">
        <label id="vote-label" for="Piggy"> Choose your favorie piggy: </label>
        <br/>
        <select name="Piggy" id="Piggy" onchange="changeImage()">
            <option class="vote-options" value="" disabled selected> Your choice </option>
            <option class="vote-options" value="Boulette"> Boulette </option>
            <option class="vote-options" value="Nugget"> Nugget </option>
            <option class="vote-options" value="Burrito"> Burrito </option>
        </select>
        <br/>
        <div id="vote-image-container">
            <img id="vote-piggy-image" src="https://github.com/FrankZiWANG-dev/Guinea-pig-presidentials/blob/master/assets/images/President-guinea-pig.jpg?raw=true">
        </div>
        <button type="submit" id="vote-submit" name="vote" onclick="thankVoter()" >Cast your vote !</button>
    
    </form>
</div>
<?php
include_once "parts/footer.php";
?>