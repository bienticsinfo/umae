<div style="margin-top: 0px;font-size: 30px">
    <center>
    <p style="text-align: center"><b>TRIAGE</b></p>
    <b style="text-align: center;font-size: 9px">Hospital de Traumatología “Dr. Victorio de la Fuente Narvaez”</b>
    <p style="text-align:  center;font-size: 8px">Av. Colector 15 S/N esq. Av. Instituto Politécnico Nacional, Col. Magdalena de las Salinas. Del. Gustavo a. Madero</p>
    <div id="barcode"></div>
    </center>
</div>
<script src="https://code.jquery.com/jquery-2.1.4.js" type="text/javascript"></script>
<script src="<?= base_url('assets/js/os/barcode/jquery-barcode.js')?>" type="text/javascript"></script>
<script>
    $(document).ready(function (e){
        $("#demo").barcode(
            "00000000148",
            "C128A"
        );     
    })

</script>