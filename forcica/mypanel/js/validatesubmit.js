function validateEmail(sEmail) {var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;if (filter.test(sEmail)) {return true;}else {return false;}}
function checkfileSize()
{
    var iSize = ($("#image")[0].files[0].size / 1024);
    var extension = $("#image").val().substr( ($("#image").val().lastIndexOf('.') +1) );
    //var itype = $("#report"+id)[0].files[0].type;
    //alert($("#image")[0].files[0].name);
    
	$("#uploadimage").val($("#image")[0].files[0].name);
	
    var arrayExtensions = ["jpg" , "jpeg", "png"];

    if (arrayExtensions.lastIndexOf(extension) == -1) 
    {
        alert("Only JPG, PNG files are allowed");
        $("#image").val('');
    }
    
    iSize = (Math.round((iSize / 1024) * 100) / 100);
    if(iSize>2)
    {
        alert('Image size is greater than 2 MB');
        $("#image").val('');
    }
}
function checkfileSize3()
{
    var iSize = ($("#compimage")[0].files[0].size / 1024);
    var extension = $("#compimage").val().substr( ($("#compimage").val().lastIndexOf('.') +1) );
    //var itype = $("#report"+id)[0].files[0].type;
    //alert($("#image")[0].files[0].name);
    
	$("#uploadimage").val($("#compimage")[0].files[0].name);
	
    var arrayExtensions = ["jpg" , "jpeg", "png"];

    if (arrayExtensions.lastIndexOf(extension) == -1) 
    {
        alert("Only JPG, PNG files are allowed");
        $("#compimage").val('');
    }
    
    iSize = (Math.round((iSize / 1024) * 100) / 100);
    if(iSize>2)
    {
        alert('Image size is greater than 2 MB');
        $("#compimage").val('');
    }
}
function checkfileSize2()
{
    var maximageuploadlimit=$("#maximageuploadlimit").val();
    maximageuploadlimit=parseInt(maximageuploadlimit);
    var totalimageuploaded=$("#totalimageuploaded").val();
    totalimageuploaded=parseInt(totalimageuploaded);
    
    totalimageuploaded=totalimageuploaded+1;
    
    if(maximageuploadlimit>=totalimageuploaded)
    {
        var iSize = ($("#sliderimage")[0].files[0].size / 1024);
        var extension = $("#sliderimage").val().substr( ($("#sliderimage").val().lastIndexOf('.') +1) );
        //var itype = $("#report"+id)[0].files[0].type;
        //alert($("#image")[0].files[0].name);

            $("#uploadimage2").val($("#sliderimage")[0].files[0].name);

        var arrayExtensions = ["jpg" , "jpeg", "png"];

        if (arrayExtensions.lastIndexOf(extension) == -1) 
        {
            alert("Only JPG, PNG files are allowed");
            $("#sliderimage").val('');
        }

        iSize = (Math.round((iSize / 1024) * 100) / 100);
        if(iSize>2)
        {
            alert('Image size is greater than 2 MB');
            $("#sliderimage").val('');
        }
    }
    else {
        alert('Max image upload limit ('+maximageuploadlimit+') has been exceeded');
        $("#sliderimage").val('');
        $("#uploadimage2").val('');
    }
}
function checkfileSize4()
{
    var iSize = ($("#cashrecipt")[0].files[0].size / 1024);
    var extension = $("#cashrecipt").val().substr( ($("#cashrecipt").val().lastIndexOf('.') +1) );
    //var itype = $("#report"+id)[0].files[0].type;
    //alert($("#image")[0].files[0].name);
    
    //$("#uploadimage3").val($("#cashrecipt")[0].files[0].name);
	
    var arrayExtensions = ["jpg" , "jpeg", "png", "doc", "docx", "pdf"];

    if (arrayExtensions.lastIndexOf(extension) == -1) 
    {
        alert("Only jpg, png, doc, docx and pdf files are allowed");
        $("#cashrecipt").val('');
    }
    
//    iSize = (Math.round((iSize / 1024) * 100) / 100);
//    if(iSize>2)
//    {
//        alert('Image size is greater than 2 MB');
//        $("#cashrecipt").val('');
//    }
}
function editSliderImage(Id,img,desc)
{
    $("#presliderimage").val(img);
    $("#imgdescription").val(desc);
    $("#sliderimageId").val(Id);

}
function editStoreImage(Id,img,desc)
{
    $("#storefrm").show('fast');
    $("#prestoreimage").val(img);
    $("#storeimgdescription").val(desc);
    $("#storeId").val(Id);
}