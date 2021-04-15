document.getElementsByName("querysubmit")[0].addEventListener("click",check_query_data)

function check_query_data(event)
{
    event.preventDefault()
    var no_errors=true
    var fname=document.getElementsByName("first_name")[0].value.trim()
    var lname=document.getElementsByName("last_name")[0].value.trim()
    var email=document.getElementsByName("email")[0].value.trim()
    var message=document.getElementsByName("message")[0].value.trim()


    // validate and show errors 


    if(no_errors)
        document.myForm.submit()
}