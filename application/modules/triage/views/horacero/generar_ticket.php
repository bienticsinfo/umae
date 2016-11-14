<div style="margin-top: 0px;font-size: 30px;margin-left: -20px">
    <center>
        <p style="text-align: center;font-size: 20px;margin-left: -20px"><b>TRIAGE<br>URGENCIAS</b></p>
        <b style="text-align: center;font-size: 11px;margin-left: -20px">Hospital de Traumatología </b>
        <p style="text-align: center;font-size: 11px;margin-left: -25px;margin-top: 0px">“Dr. Victorio de la Fuente Narváez”</p><br>
        <img class="code128" style="margin-left:-20px "><br><br>
        <p style="text-align:  center;font-size: 6px;margin-left: -30px">Av. Colector 15 S/N esq. Av. Instituto Politécnico Nacional,</p>
        <p style="text-align:  center;font-size: 6px;margin-left: -30px">Col. Magdalena de las Salinas. Del. Gustavo a. Madero</p>
    </center>
</div>
<script src="https://code.jquery.com/jquery-2.1.4.js" type="text/javascript"></script>
<script src="<?= base_url('assets/js/os/barcode/jquery-barcode.js')?>" type="text/javascript"></script>
<script>
    $(document).ready(function (e){
        JsBarcode(".code128", "<?=$info['triage_id']?>",{
            displayValue: true,
            height: 50,
            width: 1
        });
        print(true);
    })

</script>