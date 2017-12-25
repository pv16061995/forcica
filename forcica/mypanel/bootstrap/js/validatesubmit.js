
function checkfileSize()
{
    var iSize = ($("#image")[0].files[0].size / 1024);
    var extension = $("#image").val().substr( ($("#image").val().lastIndexOf('.') +1) );
    //var itype = $("#report"+id)[0].files[0].type;
    //alert(extension);
    
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

function checkfileSize2()
{
    var iSize = ($("#address_proof")[0].files[0].size / 1024);
    var extension = $("#address_proof").val().substr( ($("#address_proof").val().lastIndexOf('.') +1) );
    //var itype = $("#report"+id)[0].files[0].type;
    //alert(extension);
    
    var arrayExtensions = ["jpg" , "jpeg", "png", "doc", "docx"];

    if (arrayExtensions.lastIndexOf(extension) == -1) 
    {
        alert("Only JPG, PNG, DOC, DOCX files are allowed");
        $("#address_proof").val('');
    }
    
    iSize = (Math.round((iSize / 1024) * 100) / 100);
    if(iSize>2)
    {
        alert('Document size is greater than 2 MB');
        $("#address_proof").val('');
    }
}

function checkfileSize3()
{
    var iSize = ($("#education_certificate")[0].files[0].size / 1024);
    var extension = $("#education_certificate").val().substr( ($("#education_certificate").val().lastIndexOf('.') +1) );
    //var itype = $("#report"+id)[0].files[0].type;
    //alert(extension);
    
    var arrayExtensions = ["jpg" , "jpeg", "png", "doc", "docx"];

    if (arrayExtensions.lastIndexOf(extension) == -1) 
    {
        alert("Only JPG, PNG, DOC, DOCX files are allowed");
        $("#education_certificate").val('');
    }
    
    iSize = (Math.round((iSize / 1024) * 100) / 100);
    if(iSize>2)
    {
        alert('Document size is greater than 2 MB');
        $("#education_certificate").val('');
    }
}

function checkfileCSV()
{
    var extension = $("#csvfile").val().substr( ($("#csvfile").val().lastIndexOf('.') +1) );
    //var itype = $("#report"+id)[0].files[0].type;
    //alert(extension);
    
    var arrayExtensions = ["csv"];

    if (arrayExtensions.lastIndexOf(extension) == -1) 
    {
        alert("Only CSV files are allowed");
        $("#csvfile").val('');
    }
}

function validateEmail(sEmail) 
{
    var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
    if (filter.test(sEmail)) 
    {
        return true;
    }
    else 
    {
        return false;
    }
}