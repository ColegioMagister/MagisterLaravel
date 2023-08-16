<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reporte</title>

      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />

</head>
<style>
    body {
            font-family: Arial, sans-serif;
        }
        h1 {
            color: #333;
        }
        h2 {
            color: #666;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .alumnos-header {
            background-color: #00c3ff;
            color: #333;
            text-align: center;
            font-weight: bold;
            font-size: 16px;
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

        .img1{
            width: 70px;
            height: 70px;
            border-radius: 50%;
        }

        .img2{
            width: 70px;
            height: 70px;
            border-radius: 50%;
            float: right;
        }

        

        .box-1 > p
        {
            top: 800px; 
            position: fixed;
            width: 240px;
            border-top: 1px dashed black;
            text-align: center;
            padding: .5em;
        }
        
        .box-2 > p
        {
            top: 800px; 
            right: 20px;
            position: fixed;
            width: 240px;
            border-top: 1px dashed black;
            text-align: center;
            padding: .5em;
        }

        .inf {
            text-transform: uppercase;
        }

        

  </style>

    <body>
        @foreach ($schools as $school)

        <img class="img1"
     src="data:image/jpg;base64,
      {{base64_encode(file_get_contents(base_path('public/'.$school->url_img)))}}">

        <img class="img2" src="https://yt3.googleusercontent.com/7EElj11xPg9EqaAFGIHPBMTp715eVFKSqVnsu2BgsMs6l-HaWAek46rHizWizs38MNEmJgRzKSA=s900-c-k-c0x00ffffff-no-rj">
        <div>
        
        

          </table>

        </div>

        <center>
    
            <p class="inf">INSTITUCION EDUCATIVA PRIVADA {{ $school->school_name }}</p>
            <p>Listado General de Alumnos</p>
        </center>

        <table>
            <thead>
                <tr>
                    <th colspan="5" class="alumnos-header">TOTAL DE ALUMNOS  {{ $totalStudents }}</th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>NOMBRES Y APELLIDOS</th>
                    <th>FECHA DE NACIMIENTO</th>
                    <th>TELÉFONO</th>DNI
                    <th>DNI</th>
                    
                </tr>
            </thead>
            
            <tbody>
            @foreach ($students as $student)
                <tr>
                <td>{{$student->id}}</td>
                <td>{{$student->name}} , {{$student->lastname}}</td>
                <td>{{$student->bithdate}}</td>
                <td>{{$student->phone_number}}</td>
                <td>{{$student->dni}}</td>
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
                    <p>Este reporte de alumnos es proporcionado por la Institucion Educativa Privada {{ $school->school_name }}.</p>
                    <p>Contacto: {{ $school->email }} | Teléfono:  {{ $school->phone_number }} </p>
                    <p>Direccion: {{ $school->city }} {{ $school->adress }} 
                </div>
    @endforeach 
        </div>

    </body>
</html>