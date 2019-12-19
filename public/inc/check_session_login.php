<?php 
if(Session::exist()){
    ?>
<script>
    window.location.href = "<?php echo URL;?>Cpanel/Pagina/home2";
</script>
<?php
}else{

}
?>