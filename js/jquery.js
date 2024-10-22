$("#term").on("keyup", function(){

    $term=$("#term").val();
    $.ajax({
        url:'js/data.php',
        method:'POST',
        data:{'term':$term},
        success:function(response)
        {
            $("#dropdata").html(response);
        }
    })

    if($("#term").val()!='')
    {
    $(".suggestionbox").show();
    }
    else
    {
        $(".suggestionbox").hide();
    }
})
function putdata(data)
{
    $("#term").val(data);
    $(".suggestionbox").hide();
}




