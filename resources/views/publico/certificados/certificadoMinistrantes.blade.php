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

            .page {
                overflow: hidden;
                page-break-after: always;
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
                margin-left: 700px;
                margin-top: 32%;
                text-align: right;
                font-size: 8px;
                word-wrap: break-word;
                width: 400px;
                color: #777;
                position: relative;
                bottom: 10px;
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
        <div id='c0' class="page">
            <div id='c1'>Certificamos que <span class="text-bold"> {{ $atividadesResponsavel->nome }}</span> foi ministrante do(a) {{ $atividade->tipoDeAtividade->nome }}
                <br/> <span class="text-uppercase"> {{ $atividade->nome }}</span>
                <br/> durante o {{ $atividade->evento->nome }}.
                <br/><font size='-1'><em>(Carga horária: {{ $cargaHoraria }}h)</em></font>
            </div>
            <div id='c2'>
                <p>
                Este documento pode ser verificado pelo link <br/>
                {{ Html::link("http://sistemas.jf.ifsudestemg.edu.br/sge/certificados/autenticar/".$codigoAutenticidade) }}</p>
            </div>
        </div>
    </body>
</html>
