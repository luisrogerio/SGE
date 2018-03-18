<html>
    <head>
        <meta charset="utf-8"/>
        <style>
            body {
                margin: 0px;
                width: 29.7cm;
                height: 21cm;
                font-family: sans-serif;
                font-size: 10pt;
            }

            .negrito {
                font-weight: bold;
            }

            .italico {
                font-style: italic;
            }

            .negrito_italico {
                font-weight: bold;
                font-style: italic;
            }

            #c0 {
                margin: 0px;
                width: 29.7cm;
                height: 21cm;
                background-color: white;
                background-image: url("http://sistemas.jf.ifsudestemg.edu.br/sge/dede/base/fcs17_hp004d.jpg");
                background-repeat: no-repeat;
            //background-position: center;
                background-size: 100%;
                word-wrap: break-word;
            }

            #c1 {
                padding-top: 270px;
                padding-bottom: 70px;
            / / padding-right: 70 px;
            / / padding-left: 0 px;
                text-align: center;
                font-size: 26px;
                white-space: normal;
                word-wrap: normal;
            }

            #c2 {
                position: fixed;
                margin-left: 700px;
                top: 90%;
                text-align: right;
                font-size: 8px;
                word-wrap: break-word;
                width: 400px;
                color: #777;
            }

            .text-uppercase {
                text-transform: uppercase;
            }

            .text-bold {
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <div id='c0'>
            <div id='c1'>Certificamos que <span class="text-bold"> {{ $trabalho->nomePessoa }}</span> apresentou o pôster do trabalho
                <br/> <span class="text-uppercase"> {{ $trabalho->tituloTrabalho }}</span>
                <br/> no {{ $trabalho->evento->nome }}
                @if ($trabalho->classificacao != null)
                    <br/> Premiação: {{ $trabalho->classificacao }}° Lugar
                @endif
            </div>
            <div id='c2'>
                <p>
                Este documento pode ser verificado pelo link <br/>
                {{ Html::link("http://sistemas.jf.ifsudestemg.edu.br/sge/certificados/autenticar/".$codigoAutenticidade) }}</p>
            </div>
        </div>
    </body>
</html>
