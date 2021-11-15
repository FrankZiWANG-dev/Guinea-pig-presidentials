<?php

echo "<footer>"
        ."<a href='index.php'> Home </a>"
        ."<a href='project.php'> About the project </a>"
        ."<a href='candidates.php'> Candidates </a>"
        ."<a href='contact.php'> Contact us </a>"
        ."<a href='vote.php'> Vote! </a>"
    ."</footer>"
    ."<script>
        let hamburger = document.getElementById('hamburgerIcon');
        let nav = document.getElementById('navHamburger');
        let number = 0;
        hamburger.addEventListener('click', () => {
            nav.setAttribute('style', 'height: 200px ; padding: 5px;');
            number++;
            if (number == 2){
                nav.setAttribute('style', 'height: 0px ; padding: 0px');
            number = 0;
            }
        });

        function confirmSubmit(){
            var agree=confirm('Please confirm your message is ready to be sent');
            if (agree)
                return true ;
            else
                return false ;
        }
    </script>"
    ."</body>"
."</html>";

?>