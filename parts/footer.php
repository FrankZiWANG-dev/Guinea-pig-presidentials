<?php

echo "<footer>"
        ."<a href='index.php'> Home </a>"
        ."<a href='project.php'> About the project </a>"
        ."<a href='candidates.php'> Candidates </a>"
        ."<a href='contact.php'> Contact us </a>"
        ."<a href='vote.php'> Vote! </a>"
    ."</footer>"
    ."<script>
    if (window.innerWidth < 480 ) {
        document.getElementById('nav').display = none;
        document.getElementById('hamburger').display = block;
    }
    </script>"
    ."</body>"
."</html>";

?>