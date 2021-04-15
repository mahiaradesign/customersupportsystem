document.getElementsByName("querysubmit")[0].addEventListener("click",check_query_data)

function check_query_data(event)
{
    event.preventDefault();
    var fname=document.getElementsByName("first_name")[0].value.trim()
    var lname=document.getElementsByName("last_name")[0].value.trim()
    var email=document.getElementsByName("email")[0].value.trim()
    var message=document.getElementsByName("message")[0].innerHTML;
    var no_error=true;
    if(fname== ""){
        no_error=false;
        document.getElementsByName("f_error")[0].innerHTML="*Please enter the name";
    }
    if(lname== "" ){
        no_error=false;
        document.getElementsByName("l_error")[0].innerHTML="*Please enter the name";
    }
    var validfname=/^[A-z ]+$/.test(fname);
    if(validfname == false){
        no_error=false;
        document.getElementsByName("f_error")[0].innerHTML="*Please enter the  correct name";
    }
    var validlname=/^[A-z ]+$/.test(lname);
    if(validlname == false){
        no_error=false;
        document.getElementsByName("l_error")[0].innerHTML="*Please enter the correct name";
    }
    var reg = "^[a-zA-Z0-9]+(\.[_a-zA-Z0-9]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,15})$";
    if (reg.test(email) == false)
    {
        no_error=false;
        document.getElementsByName("e_error")[0].innerHTML="*Please enter the correct email";
    }
    if(message == ''){
        no_error=false;
        echo("enter the query");
        document.getElementsByName("m_error")[0].innerHTML="*Please enter the query";
    }
    if(no_error)
        document.myForm.submit();
}