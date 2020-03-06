(function()
        {
            var langorigine = document.querySelector('input[name=langorigine]');

            if(null !== langorigine) {
                langorigine.addEventListener('blur', function()
                {
                    var req = new XMLHttpRequest();
                    console.log("mm");
                    req.open('POST', 'http://localhost/web/public/index/chectradajax');
                    req.send("langorigine"+this.value);
                    req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');



                   // req.send("Username=" + this.value);
                }, false);
            }
        })();