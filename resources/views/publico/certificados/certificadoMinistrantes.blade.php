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
                background-color: #bbcccc;
                background-image: url("http://sistemas.jf.ifsudestemg.edu.br/sge/dede/base/fcs17_hp004d.jpg");
                background-repeat: no-repeat;
                //background-position: center;
                background-size: 100%;
            }

            #c1 {
                padding-top: 200px;
                padding-bottom: 70px;
            / / padding-right: 70 px;
            / / padding-left: 0 px;
                text-align: center;
                font-size: 16px;
                white-space: nowrap;
                word-wrap: normal;
            }

            #c2 {
                position: absolute;
                margin-left: 10px;
                padding-top: 5%;
                text-align: left;
                font-size: 8px;
                word-wrap: break-word;
                width: 300px;
                color: #777;
            }
        </style>
    </head>
    <body>
        <div id='c0'>
            <div id='c1'>Certificamos que {{ $atividadesResponsavel->nome }} foi ministrante do(a) {{ $atividade->tipoDeAtividade->nome }}
                <br/> {{ $atividade->nome }}
                <br/> durante o {{ $atividade->evento->nome }}
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
