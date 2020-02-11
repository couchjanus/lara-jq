<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                margin: 0;
            }


            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <h1 style = "color:green;">Data from Server</h1> 
                
                <table id="table" align = "center" border="1px"></table> 
               
                
            </div>
        </div>
        <script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
        <script>
        function makeTable(list) { 
                var cols = []; 
              
                for (var i = 0; i < list.length; i++) { 
                    for (var k in list[i]) { 
                        if (cols.indexOf(k) === -1) { 
                            // Push all keys to the array 
                            cols.push(k); 
                        } 
                    } 
                } 
              
                // Create a table element 
                var table = document.createElement("table"); 
                
                // Create table row tr element of a table 
                var tr = table.insertRow(-1); 
                
                for (var i = 0; i < cols.length; i++) { 
                    
                    // Create the table header th element 
                    var theader = document.createElement("th"); 
                    theader.innerHTML = cols[i]; 
                    
                    // Append columnName to the table row 
                    tr.appendChild(theader); 
                } 
              
                // Adding the data to the table 
                for (var i = 0; i < list.length; i++) { 
                    
                    // Create a new row 
                    trow = table.insertRow(-1); 
                    for (var j = 0; j < cols.length; j++) { 
                        var cell = trow.insertCell(-1); 
                        
                        // Inserting the cell at particular place 
                        cell.innerHTML = list[i][cols[j]]; 
                    } 
                } 
              
                // Add the newely created table containing json data 
                var el = document.getElementById("table"); 
                el.innerHTML = ""; 
                el.appendChild(table); 
            }   
            $.ajax({
                url: '/api/users',
                type: 'GET',
                contentType: "application/json;",
            })
            .then(function (responce) {
                console.log(responce.data);
                makeTable(responce.data)
            });
        </script>
    </body>
</html>
