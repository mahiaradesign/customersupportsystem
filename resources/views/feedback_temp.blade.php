@include('includes.htmlhead')
@include('includes.navbar')
    <section class="query feedback">
        <div class="imgbox">
            <img src="/images/review.png" alt="mail-img">
        </div>
        <div class="formbox">
            <h3>FEEDBACK FORM</h3>

            @if($ticket)
            {{-- @foreach ($ticket as $tick) --}}
                <form action="{{route('feedback.submit')}}" method="POST" name="myForm">
                    @csrf
                    <div class="eachline">
                        <p class="name">Ticket ID</p>
                        <p class="value">{{$ticket->ticket_id}}</p>
                        <input type="hidden" name="ticket_id" value={{ $ticket->ticket_id }}>
                    </div>
                    <div class="eachline mail">
                        <p class="name">Customer Email</p>
                        <p class="value">{{$ticket->email}}</p>
                    </div>
                    @php
                        $exec = DB::table('users')->where('id',$ticket->assigned_to)->first();    
                    @endphp

                    <div class="eachline mail">
                        <p class="name">Executive Assigned</p>
                        <p class="value">{{$exec->name}}</p>
                    </div>

                    <div class="eachline">
                        <div class="eachinputbox full_input">
                            <textarea name="feedback" rows="7" placeholder="Enter your feedback"></textarea>
                            <span class="error" name="m_error"></span>
                        </div>
                    </div>
                    <div class="eachline rating-box">
                        <p>Rate your experience with us:</p>
                        <input type="hidden" name="rating" value="0" id="rating_value">
                        <div class="starbox">
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                        </div>
                    </div>
                    <button type="submit" name="feedbackSubmit" class="primary-btn">SEND FEEDBACK</button>
                </form>
                {{-- @endforeach --}}
            @else  
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Either You are looking for wrong Ticket ID or you have already given Feedback for this Ticket!!! </strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </section>
    <script src="/js/feedback.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
@include('includes.footer')
@include('includes.htmlend')