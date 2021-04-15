document.getElementsByName("executive_login_submit")[0].addEventListener("click",check_executive_data)

function check_executive_data(event)
{
    event.preventDefault()
    var username=document.getElementsByName("username")[0].value.trim()
    var password=document.getElementsByName("password")[0].value.trim()
    var no_error=true
    if(username == "")
    {
        no_error=false;
        document.getElementsByName("user_error")[0].innerHTML="Username cannot be empty";
    }
    else
    {
        document.getElementsByName("user_error")[0].innerHTML="";
    }
    if(password == "")
    {
        no_error=false;
        document.getElementsByName("pass_error")[0].innerHTML="Password cannot be empty";
    }
    else
    {
        document.getElementsByName("pass_error")[0].innerHTML="";
    }
    if(no_error)
        document.myForm.submit();
}