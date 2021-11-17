<?php
include_once "parts/nav.php";
//Get Heroku ClearDB connection information
$cleardb_server = "eu-cdbr-west-01.cleardb.com";
$cleardb_username = "b7c97a87c49c7a";
$cleardb_password = "214091d4";
$cleardb_db = "heroku_94f1dd5293826c3";

// Connect to DB
try {
    $bdd = new PDO("mysql:host=$cleardb_server; port=3306 ; dbname=$cleardb_db;", $cleardb_username, $cleardb_password);
}
catch(Exception $e){
    die ('Erreur: '.$e->getMessage());
}

//get IP
//whether ip is from the proxy  
if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
}  
// whether ip is from the remote address  
else{  
 $ip = $_SERVER['REMOTE_ADDR'];  
}
var_dump($ip);
//check if IP already in db
$sql3= $bdd->query('SELECT IP FROM ip');
$sql3->execute();
$IPs=$sql3->fetchAll();
//redirect if already in db
for($x=0;$x<sizeOf($IPs);$x++){
    if ($ip == $IPs[$x][0]){
        echo "<script>
                alert('You already voted!'); 
                window.location.href='president.php'
            </script>";
    }
}


if (isset($_POST["vote"]) && isset($_POST['Piggy'])){
    //prepared statement to get number of votes
    $sql= $bdd->prepare('SELECT Votes FROM results WHERE Name = ?');
    $sql->execute([$_POST["Piggy"]]);
    $data=$sql->fetch();
   
    //update number votes 
    $sql2= 'UPDATE results SET Votes = ? WHERE Name = ?';
    $bdd->prepare($sql2) -> execute([$data[0]+1,$_POST["Piggy"]]);
    
    //add IP to db
    echo $ip;
    $sql4= $bdd->prepare('INSERT INTO ip VALUES (?)');
    $sql4->execute([$ip]);

    unset($_POST['vote']);

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