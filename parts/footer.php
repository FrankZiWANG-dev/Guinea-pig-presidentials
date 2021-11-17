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

        function changeImage(){
            switch (document.getElementById('Piggy').value) {
                 case 'Boulette':
                     document.getElementById('vote-piggy-image').src = 'https://github.com/FrankZiWANG-dev/Guinea-pig-presidentials/blob/master/assets/images/Boulette-1.JPG?raw=true';
                     break;
                 case 'Nugget':
                     document.getElementById('vote-piggy-image').src = 'https://github.com/FrankZiWANG-dev/Guinea-pig-presidentials/blob/master/assets/images/Nugget-1.JPG?raw=true';
                     break;
                 case 'Burrito':
                     document.getElementById('vote-piggy-image').src = 'https://github.com/FrankZiWANG-dev/Guinea-pig-presidentials/blob/master/assets/images/Burrito-1.JPG?raw=true';
                     break;
                 default:
                     document.getElementById('vote-piggy-image').src = 'https://github.com/FrankZiWANG-dev/Guinea-pig-presidentials/blob/master/assets/images/President-guinea-pig.jpg?raw=true';
             };
        }
        
        function thankVoter(){
            window.alert('Thanks for voting!');
        }
        function confirmSubmit(){
            var agree=confirm('Please confirm your message is ready to be sent');
            if (agree)
                return true ;
            else
                return false ;
        }
        function changePresidentImage(){
            let president = String(document.getElementById('president-name').innerText);
            switch (president) {
                case 'Boulette':
                    document.getElementById('president-img').src = 'https://github.com/FrankZiWANG-dev/Guinea-pig-presidentials/blob/master/assets/images/Boulette-1.JPG?raw=true';
                    break;
                case 'Nugget':
                    document.getElementById('president-img').src = 'https://github.com/FrankZiWANG-dev/Guinea-pig-presidentials/blob/master/assets/images/Nugget-1.JPG?raw=true';
                    break;
                case 'Burrito':
                    document.getElementById('president-img').src = 'https://github.com/FrankZiWANG-dev/Guinea-pig-presidentials/blob/master/assets/images/Burrito-1.JPG?raw=true';
                    break;
                default:
                    document.getElementById('president-img').src = 'https://github.com/FrankZiWANG-dev/Guinea-pig-presidentials/blob/master/assets/images/President-guinea-pig.jpg?raw=true';
            };
        };
        window.onload = function() {
            changePresidentImage();
            window.setInterval('changeImage()', 5000);
        }
    </script>"
    ."</body>"
."</html>";

?>