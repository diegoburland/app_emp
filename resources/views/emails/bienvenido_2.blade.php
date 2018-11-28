<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <style>
            .btn{
                color: #212529;

                background-color: #ffc107;
                border-color: #ffc107;
                display: inline-block;
                font-weight: 400;
                text-align: center;
                white-space: nowrap;
                vertical-align: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                border: 1px solid transparent;
                padding: .375rem .75rem;
                font-size: 1rem;
                line-height: 1.5;
                border-radius: .25rem;
                transition: color .15s;
                text-decoration: none;
                   
            }  
            body{
                font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
            }
            .card {
                position: relative;
                display: inline-flex;
                -ms-flex-direction: column;
                flex-direction: column;
                min-width: 0;
                word-wrap: break-word;
                background-color: #fff;
                background-clip: border-box;
                border: 1px solid rgba(0,0,0,.125);
                border-radius: .25rem;
                text-align: center!important;
            }
            .card-footer {
                padding: .75rem 1.25rem;
                background-color: rgba(0,0,0,.03);
                border-top: 1px solid rgba(0,0,0,.125);
                color: #6c757d!important;
                -ms-flex: 1 1 auto;
                flex: 1 1 auto;
            }
            .card-body {
                -ms-flex: 1 1 auto;
                flex: 1 1 auto;
                padding: 1.25rem;
            }
            
        </style>
          
    </head>
    <body>
        <div class="card">
        
            <div class="card-body">
                  <img src="https://co.vidaandwork.com/img/transparente1-k.png" alt="Vida And Work" width="200px"><br>
                    <b>¡Muchas gracias por tu evaluación anónima sobre la empresa {{$empresa}}!</b><br>

                    <p>
                        Dale clic al botón abajo para confirmar tu correo electrónico:
                    </p>

                    <p><a class="btn" href="https://co.vidaandwork.com/code/{{$confir_code}}" target="_blank">Confirmar correo</a></p>
                    <p>¡Gracias por tu aporte para un mercado laboral más transparente!</p>
                    <p>¡Te prometemos un 100% de anonimato y un manejo confiable de tus datos en todo momento!</p>

                    <p>Tu equipo de Vida and Work</p>
                    <p>¿Tú no publicaste esta evaluación en <a href="https://www.vidaandwork.com" target="_blank">www.vidaandwork.com</a>?<br>
                        - Por favor, responda a este correo electrónico con el asunto: No creé esta evaluación</p>
         
                    
            </div>
         
        </div>
        
    </body>
</html>