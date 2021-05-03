@include('includes.htmlhead')
@include('includes.navbar')
    <section class="status">
        <div class="formbox">
            <h3>Check Status of your Query</h3>
            <form action="{{route('check')}}" method="post" name="myForm">
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
        @if($ticket=Session::get('success'))
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
                @php
                    $exec= DB::table('users')->where('id',$ticket->assigned_to)->first();
                @endphp
                <div class="details">
                    <div class="eachline">
                        <p class="name">Ticket ID :</p>
                        <p class="value main">#{{$ticket->ticket_id}}</p>
                    </div>
                    <div class="eachline">
                        <p class="name">Messsage :</p>
                        <p class="value message">{{$ticket->message}}</p>
                    </div>
                    @if($ticket->status =="waiting")
                        <div class="eachline">
                            <p class="name">Status :</p>
                            <p class="value">No Executive Assigned</p>
                        </div>
                    @else
                        <div class="eachline">
                            <p class="name">Status :</p>
                            <p class="value">{{$ticket->status}}</p>
                        </div>
                        <div class="eachline">
                            <p class="name">Assigned To :</p>
                            <p class="value">{{$exec->name}}</p>
                        </div>
                    @endif
                    <div class="eachline">
                        <p class="name">Created At :</p>
                        <p class="value">{{$ticket->created_at}}</p>
                    </div>
                </div>
                <script>
                    // just assign the status here
                    const status={!! json_encode($ticket->status) !!};
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
        @endif

        {{-- if ticket not found --}}
        @if($msg=Session::get('msg'))
        <div class="formbox resultbox">
            <div class="details">
                <div class="alert alert-danger" role="alert">
                    {{$msg}}
                </div>
            </div>
        </div>
        @endif
        {{-- End if here  --}}

    </section>
    <script src="/js/query.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
@include('includes.footer')
@include('includes.htmlend')