<html>
    <head>
        <style>
            body{
                background:rgb(255,0,0);
            }
            #canvas{
                background:#fff;
                width:750px;
                height:500px;
                margin:150px auto;
               
                
            }
            #board{
                background:#fff;
                border:2px solid red;
            }
            @media (max-width: 1600px) and (max-height: 1200px) {
               #canvas{
                   margin:300px auto;
               }
               body{
                   background:blue;
               }
            }
        </style>
    </head>
    <body>
        <div id="canvas">
            <canvas id="board" width></canvas>
        </div>
    </body>

</html>
