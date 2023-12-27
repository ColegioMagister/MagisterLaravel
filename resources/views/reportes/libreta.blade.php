<!DOCTYPE html>
<html lang="en">

<head>
    <title>Anexo 4</title>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

</head>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }

    .img1 {
        width: 70px;
        height: 70px;
        border-radius: 50%;
    }

    .img2 {
        width: 70px;
        height: 70px;
        float: right;
        border-radius: 50%;
    }



    .table1 {
        width: 80%;
        max-width: 800px;
        margin: 20px auto;
        background-color: rgb(154, 215, 250);
        box-shadow: 0 4px 8px rgba(145, 20, 20, 0.1);
        border-radius: 5px;
        border-collapse: collapse;
    }

    .table1 td {
        border: 1px solid #ddd;
        padding: 5px;
        text-align: left;
    }

    .small-text {
        font-size: 12px;
    }

    .inf {
        text-transform: uppercase;
    }

    .titulo {
        font-size: 24px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
    }

    .tabla-notas {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .tabla-notas th,
    .tabla-notas td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }

    .tabla-notas th {
        background-color: #00c3ff;
    }

    .box-1>p {
        top: 800px;
        position: fixed;
        width: 240px;
        border-top: 1px dashed black;
        text-align: center;
        padding: .5em;
    }

    .box-2>p {
        top: 800px;
        right: 20px;
        position: fixed;
        width: 240px;
        border-top: 1px dashed black;
        text-align: center;
        padding: .5em;
    }


    .footer {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        text-align: center;
        padding: 10px;
        background-color: #9bdbf8;
    }
</style>

<body>
    @foreach ($schools as $school)
        <img class="img1"
            src="data:image/jpg;base64,
        {{ base64_encode(file_get_contents(base_path('public/' . $school->url_img))) }}">

        <img class="img2"
            src="data:image/jpg;base64,
        {{ base64_encode(file_get_contents(base_path('public/' . $student->url_img))) }}">


        <center>
            <p class="inf">INSTITUCION EDUCATIVA PRIVADA {{ $school->school_name }}</p>

        </center>


        <div class="titulo">Reporte de Notas</div>

        <table class="table1">
            <tr>
                <td class="text-uppercase">APELLIDOS Y NOMBRES: {{ $student->lastname }} {{ $student->name }}</td>
                <td class="text-uppercase">ID:{{ $student->id }}</td>
            </tr>
            <tr>
                <td class="text-uppercase">FECHA DE NACIMIENTO: {{ $student->bithdate }}</td>
                <td class="text-uppercaset">DNI: {{ $student->dni }}</td>
            </tr>
            <tr>
                <td class="text-uppercase">NUMERO TELEFONICO: {{ $student->phone_number }} </td>
                <td class="text-uppercase"></td>
            </tr>

            @foreach ($sections as $section)
                <tr>
                    <td class="text-uppercase">GRADO:{{ $section->section_type->section_type }}</td>
                    <td class="text-uppercase">SECCIÓN:{{ $section->section_name }}</td>
                </tr>
            @endforeach


            <tr>

                <td class="text-uppercase">INSTITUCION EDUCATIVA </td>
                <td class="align-middle text-uppercase text-sm">{{ $school->school_name }}</td>
            </tr>
        </table>


        <table class="tabla-notas">
            <thead>
                <tr>
                    <th>Materia</th>
                    <th>Nota Final</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($section->subjectSection as $subject)
                    <tr>
                        <td class="text-uppercase">{{ $subject->subject_name }}</td>
                        <td>
                            @if (isset($PromedioXSubject[$subject->id]) && $PromedioXSubject[$subject->id] > 0)
                                {{ $PromedioXSubject[$subject->id] }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


        <div class="box-1">
            <p>
                Sello
            </p>
        </div>

        <div class="box-2">
            <p>
                Firma del Director
            </p>
        </div>



        <div class="footer">
            <p>Este reporte de NOTAS es proporcionado por la Institucion Educativa Privada {{ $school->school_name }}.
            </p>
            <p>Contacto: {{ $school->email }} | Teléfono: {{ $school->phone_number }} </p>
            <p>Direccion: {{ $school->city }} {{ $school->adress }}
        </div>
    @endforeach

</body>

</html>
