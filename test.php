<script>
function format(num) {
    val = num.value;
    val = val.replace(/[^\d.]/g,"");
    arr = val.split('.');
    lftsde = arr[0];
    rghtsde = arr[1];
    result = "";
    lng = lftsde.length;
    j = 0;
    for (i = lng; i > 0; i--){
        j++;
        if (((j % 3) == 1) && (j != 1)){
            result = lftsde.substr(i-1,1) + "," + result;
        }else{
            result = lftsde.substr(i-1,1) + result;
        }
    }
    if(rghtsde==null){
        num.value = result;
    }else{
        num.value = result+'.'+arr[1];
    }
}
</script>
<input type="text" onkeyup="format(this);" onblur="format(this);" />
