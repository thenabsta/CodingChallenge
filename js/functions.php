<script>
function parse(val) {
    var result = "",
        temporaryArray = [];
    location.search
    //.replace ( "?", "" ) 
    // this is better, there might be a question mark inside
    .substr(1)
        .split("&") //split URL at &
        .forEach(function (item) {
        temporaryArray = item.split("=");
        //split URL and store in temporaryArray
        if (temporaryArray[0] === val) result = decodeURIComponent(temporaryArray[1]);
    });
    return(result);
}
</script>