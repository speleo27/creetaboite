<!-- sur cette page les conditions d'utilisations-->
<?php
session_start();
if(!isset($_SESSION['auth'])){
session_destroy();
    header("Location:accueil");

}
require_once 'template/header.php';
?>
<!-- en attente du texte doit être fournis -->
<section>
    <div class="container" >
        <form action="controller/ctrlcgu.php" method="post">
            <div id="checkbox"> 
                    <input type="checkbox" aria-label="Checkbox for control docs" id="validcgu" name="validcgu" value="validcgu" onclick=" validcheck();" required>
                    <label   for="validcgu">Je reconnais avoir pris connaissance des CGU et les approuvent</label>
            </div> 
            <div id="checkbox"> 
                    <input type="checkbox" aria-label="Checkbox for control docs" id="validcgu1" name="validcgu" value="validcgu" onclick=" validcheck();" required >
                    <label   for="validcgu">J'autorise la société Euripole à utiliser les données fournies </label>
            </div> 
            
            <button class="btn  btn-block btn-outline-light" type="submit" disabled='disabled' id="btnvalidcgu">Valider</button>
        </form>
    </div>
</section>
<script>
     function validcheck(){
        if(
            $('input[name=validcgu]').prop('checked'))
            {
$('#btnvalidcgu').removeAttr('disabled');
}else{
    $('#btnvalidcgu').attr('disabled', 'disabled');
}
    }
</script>
<?php
require_once 'template/footer.php';