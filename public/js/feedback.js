stars=document.querySelectorAll(".starbox i")
stars.forEach(function(each,index)
{
    each.addEventListener("click",function(){
        for(i=0;i<=index;i++)
        {
            stars[i].classList.remove("fa-star-o")
            stars[i].classList.add("fa-star")
        }
        for(i=index+1;i<stars.length;i++)
        {
            stars[i].classList.remove("fa-star")
            stars[i].classList.add("fa-star-o")
        }
        document.querySelector("#rating_value").value=index+1;
    })
})