var open = document.getElementById('open');
        var close = document.getElementById('close');
        var mask = document.getElementById('mask');
        var links = document.getElementById('links');

        function shownav(){
            for(i = 0; i < 2; i++){
               links.style.transform = "translateX(" + i + "%)";
            }
            mask.style.display = "block";
            open.style.display = "none";
            close.style.display = "block";
        }
       
        function hidenav(){
            for(i = 0; i > -101; i--){
               links.style.transform = "translateX(" + i + "%)";
            }
            mask.style.display = "none";
            open.style.display = "block";
            close.style.display = "none";
        }

        open.addEventListener("click", shownav);
        mask.addEventListener("click", hidenav);
        close.addEventListener("click", hidenav);