<!DOCTYPE html>
<html lang="en">
<head>
    <title>Anexo 4</title>

      <meta charset="utf-8">

      <meta http-equiv="X-UA-Compatible" content="IE=edge" />

</head>
<style>
    table{
        border-collapse:collapse;
        width: 100%; 
        margin: auto;
        table-layout: fixed;
    }
    tr,td{
	border:1px solid;
    padding: 1px;
    }
    body{
        margin: auto;
        width: 700px;
        background: url("")
        
    }
    .footer-report
{
    display: flex;
    align-items: center;
    flex-direction: column;
    padding: 20px 50px;
}

.footer-report > div
{
    width: 100%;
}
.footer-report .box-1
{
    display: flex;
    justify-content: flex-end;
}

.footer-report .box-1 p
{
    width: auto;
    padding-right: 150px;
}


.box-2
{
    justify-content: space-between;
    padding-top: 50px;
}

.box-2 > p
{
    width: 240px;
    border-top: 1px dashed black;
    text-align: center;
    padding: .5em;
}





.letra{
    font-weight:bolder;
    line-height:5px;
}


.table1{
    background-color: rgb(214, 234, 248); 
}

.table2{
    margin-top: 7%;
    table-layout: none;
    background-color: rgb(214, 234, 248); 

}


.img1{
    width: 70px;
    height: 70px;
    border-radius: 50%;
    float: right;
}

.tr1{
    font-weight:bolder;
    text-align:center;
    background-color: rgb(0, 155, 151);
}

.td2{
    text-align:center;
}


  </style>

    <body>
        <br>
        <br>
        <img class="img1" src="https://www.magisnet.com/wp-content/uploads/2019/04/19-04-10Jaime-Nubiola.jpg">
        <div>
        <center>
        <div class="letra">
        <p>INSTITUCIÓN EDUCATIVA PRIVADA MAGISTER</p>
        </div>
        <p>LISTADO GENERAL DE ALUMNOS</p>
        </center>
        <table class="table1" border="solid">

            <tr>
              <td>GRADO: </td>
              <td>SECCIÓN: </td>
            </tr>
          
            <tr>
              <td>NRO DE ALUMNOS: </td>
              <td>UGEL: </td>
            </tr>

            <tr>
                <td>PROFESOR: </td>
                <td>CODIGO DE PROFESOR: </td>
            </tr>
            
            <tr>
                <td>CIUDAD: </td>
                <td>DIRECCIÓN: </td>
            </tr>

          </table>

        </div>

        <div>
        <BR>
        <center>
        <p class="inf">INFORMACIÓN DEL AULA</p>
        </center>
        <table class="table1" border="solid">

            <tr>
              <td>NRO DE ALUMNOS: </td>
              <td>CODIGO DE SECCIÓN: </td>
            </tr>
          
            <tr>
              <td>TURNO: </td>
              <td>PISO: </td>
            </tr>

          </table>

        </div>
        

        <table class="table2" border="solid">

            <tr class="tr1">
              <td>COD</td>
              <td>NOMBRES Y APELLIDOS</td>
              <td>DNI</td>
              <td>TELEFONO</td>

            </tr>
            @foreach ($students as $student)
            <tr>
              <td>{{$student->id}}</td>
              <td>{{$student->name}} , {{$student->lastname}}</td>
              <td>{{$student->dni}}</td>
              <td>{{$student->phone_number}}</td>
            </tr>
            @endforeach

          </table>

        
          


        <div class="footer-report">
            
            <br>
            <div class="box-2">
                <p>
                    FIRMA Y SELLO
                    <br>
                    DIRECTOR
                </p>
            </div>

            <br>


            <p>
                    Emitido: 17 de julio del 2023
            </p>

            <br>


            <p>
                NOTA: El presente formato tiene por finalidad de informar al padre de familia y/o apoderado los promedios finales de cada área de estudiante.
            </p>

            <!--  <p>Fecha</p>
            <p>Firma delTrabajador.</p>
            <p>V°B° del Gerente de Seguridad y Salud Ocupacional o Ingeniero de Seguridad</p> -->

        </div>


    </body>

</html>