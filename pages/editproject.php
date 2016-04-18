<?php
include 'tables/project.php'
?>
<script>
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " ")); //script untuk mengulang dan memilih//
}

  $(document).ready(function(){{
    if(getParameterByName("editproject")!=""){
      $("#editproject").val(getParameterByName("idproject"));
    }

    $("#editproject").change(function(){
      var kode_barang=$("#kode_barang").val();

      //$("#kode_barang").val(getParameterByName("kode_barang"));
      window.location="form.php?kode_barang="+kode_barang;

      /*$.get("form.php",{kode_barang:temp},function(data){
        $("#temp").html(data);
      })*/
    })


  }})
</script>
