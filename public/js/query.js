document.getElementsByName("querysubmit")[0].addEventListener("click",check_query_data)

function check_query_data(event)
{
    event.preventDefault()
    var fname=document.getElementsByName("first_name")[0].value.trim()
    var lname=document.getElementsByName("last_name")[0].value.trim()
    var email=document.getElementsByName("email")[0].value.trim()
    var message=document.getElementsByName("message")[0].value.trim();
    var no_error=true;
    var validfname=/^[A-z ]+$/.test(fname);
    if(validfname == false)
    {
        no_error=false;
        document.getElementsByName("f_error")[0].innerHTML="*Enter a valid name";
    }
    else
    {
        document.getElementsByName("f_error")[0].innerHTML="";
    }
    var validlname=/^[A-z ]+$/.test(lname);
    if(validlname == false){
        no_error=false;
        document.getElementsByName("l_error")[0].innerHTML="*Enter a valid name";
    }
    else
    {
        document.getElementsByName("l_error")[0].innerHTML="";
    }
    var reg = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (reg.test(email) == false)
    {
        no_error=false;
        document.getElementsByName("e_error")[0].innerHTML="*Enter the correct email";
    }
    else
    {
        document.getElementsByName("e_error")[0].innerHTML="";
    }
    if(message == ""){
        no_error=false;
        document.getElementsByName("m_error")[0].innerHTML="*Query cannot be empty";
    }
    else
    {
        document.getElementsByName("m_error")[0].innerHTML="";
    }
    if(no_error)
        document.myForm.submit();
}