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
    display: flex;
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


}

.table2{
    margin-top: 7%;

}

.img1{
    width: 70px;
    height: 70px;
}

.img2{
    width: 70px;
    height: 70px;
    float: right;
    border-radius: 50%;
}

.tr1{
    font-weight:bolder;
    text-align:center;
    background-color: rgb(0, 255, 251);
}

.td2{
    text-align:center;
}

  </style>

<body>
    <img class="img1" src="https://yt3.googleusercontent.com/7EElj11xPg9EqaAFGIHPBMTp715eVFKSqVnsu2BgsMs6l-HaWAek46rHizWizs38MNEmJgRzKSA=s900-c-k-c0x00ffffff-no-rj">

    <img class="img2"
     src="data:image/jpg;base64,
      {{base64_encode(file_get_contents(base_path('public/'.$student->url_img)))}}">

    <div>
        <center>
        <div class="letra">
        <p>MINISTERIO DE EDUCACION</p>
        </div>
        <p>CERTIFICADO OFICIAL DE NOTAS</p>
        </center>
        <table class="table1" border="solid">

            <tr>
              <td>DRE: </td>
              <td>UGEL: </td>
            </tr>
          
            <tr>
              <td>NIVEL: </td>
              <td>CODIGO MODULAR: </td>
            </tr>

            <tr>
                <td>I.E: </td>
                <td> </td>
            </tr>
            
            <tr>
                <td>GRADO: </td>
                <td>SECCIÓN: </td>
            </tr>

            <tr>
                <td>CODIGO DE ESTUDIANTE: {{$student->id}}</td>
                <td>DNI: {{$student->dni}}</td>
            </tr>

            <tr>
                <td>APELLIDOS Y NOMBRES: {{$student->name}} , {{$student->lastname}}</td>
                <td> </td>
            </tr>



          </table>

        </div>

        

        <table class="table2" border="solid">

            <tr class="tr1">
              <td>ÁREA </td>
              <td>CALIFICACION ANUAL </td>
            </tr>
          
            <tr>
              <td>MATEMATICA: </td>
              <td> </td>
            </tr>

            <tr>
                <td>COMUNICACIÓN: </td>
                <td> </td>
            </tr>
            
            <tr>
                <td>ARTE: </td>
                <td> </td>
            </tr>

            <tr>
                <td>CIENCIA Y AMBIENTE: </td>
                <td> </td>
            </tr>

            <tr>
                <td>EDUCACIÓN FISICA: </td>
                <td> </td>
            </tr>

            <tr>
                <td>RELIGIÓN: </td>
                <td> </td>
            </tr>

            <tr>
                <td>HISTORIA: </td>
                <td> </td>
            </tr>

            <tr>
                <td>EPT: </td>
                <td> </td>
            </tr>

            <tr>
                <td>CTA: </td>
                <td> </td>
            </tr>

            <tr>
                <td>CIVICA: </td>
                <td> </td>
            </tr>

          </table>

        
          <table class="table2" border="solid">

            <tr>
              <td>TUTOR(a): </td>
              <td class="td2" >FIRMA </td>
              <td></td>
            </tr>

            </table>


        <div class="footer-report">
            
            <div class="box-2">
                <p>
                    FIRMA Y SELLO
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