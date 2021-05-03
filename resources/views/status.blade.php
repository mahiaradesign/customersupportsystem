@include('includes.htmlhead')
@include('includes.navbar')
    <section class="status">
        <div class="formbox">
            <h3>Check Status of your Query</h3>
            <form action="{{url('ticketSubmit')}}" method="POST" name="myForm">
                @csrf
                <div class="eachline">
                    <div class="eachinputbox full_input">
                        <input type="number" class="full_input" name="ticket_id" placeholder="Ticket ID">
                    </div>
                </div>
                <button type="submit" name="statussubmit" class="primary-btn">CHECK STATUS</button>
            </form>
        </div>

        {{-- if found any data of that input  --}}
        <div class="formbox resultbox">
            <h3>Live Status</h3>
            <div class="statusbox">
                <div class="eachstatus">
                    <p>Submitted</p>
                </div>
                <span class="bg"></span>
                <div class="eachstatus">
                    <p>Assigned</p>
                </div>
                <span class="bg"></span>
                <div class="eachstatus">
                    <p>Solved</p>
                </div>
            </div>
            <div class="details">
                <div class="eachline">
                    <p class="name">Ticket ID :</p>
                    <p class="value main">#12345678</p>
                </div>
                <div class="eachline">
                    <p class="name">Messsage :</p>
                    <p class="value message">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
                </div>
                <div class="eachline">
                    <p class="name">Status :</p>
                    <p class="value">Assigned</p>
                </div>
                <div class="eachline">
                    <p class="name">Assigned To :</p>
                    <p class="value">Rowdy Rathore</p>
                </div>
                <div class="eachline">
                    <p class="name">Created At :</p>
                    <p class="value">12/02/2020 12:30 PM</p>
                </div>
            </div>
                <script>
                    // just assign the status here
                    const status="assigned";
                    const status_arr=["waiting","assigned","solved"]
                    const status_box=document.querySelectorAll(".eachstatus")
                    const status_line=document.querySelectorAll(".bg")
                    for(var i=0;i<=status_arr.indexOf(status);i++)
                    {
                        status_box[i].classList.add("active")
                        status_box[i].innerHTML='<i class="fa fa-check-circle" aria-hidden="true"></i>'+status_box[i].innerHTML;
                        if(i>0)
                            status_line[i-1].classList.add("active")
                    }
                </script>
        </div>
        {{-- End if here  --}}

    </section>
    <script src="/js/query.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
@include('includes.footer')
@include('includes.htmlend')