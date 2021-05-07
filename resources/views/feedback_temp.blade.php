@include('includes.htmlhead')
@include('includes.navbar')
    <section class="query">
        <div class="imgbox">
            <img src="/images/hero_mail.svg" alt="mail-img">
        </div>
        <div class="formbox">
            <h3>FEEDBACK FORM</h3>

            @if(count($ticket)==1)
            @foreach ($ticket as $tick)
                <form action="{{route('feedback.submit')}}" method="POST" name="myForm">
                    @csrf
                    <div class="eachline">
                        <p>Ticket ID</p>
                        <div class="eachinputbox full_input">
                            <input type="number" class="full_input" name="ticket_id" value={{ $tick->ticket_id }} readonly>
                        </div>
                    </div>
                    <div class="eachline mail">
                        <p>Customer Email</p>
                        <div class="eachinputbox full_input">
                            <input type="email" class="full_input" name="email" placeholder="Email" value={{ $tick->email }} readonly>
                            <span class="error" name="e_error"></span>
                        </div>
                    </div>
                    @php
                        $exec = DB::table('users')->where('id',$tick->assigned_to)->first();    
                    @endphp

                    <div class="eachline mail">
                        <p>Executive Assigned</p>
                        <div class="eachinputbox full_input">
                            <input type="text" class="full_input" name="exec" placeholder="Executive name" value={{ $exec->name }} readonly>
                            <span class="error" name="e_error"></span>
                        </div>
                    </div>

                    <div class="eachline">
                        <div class="eachinputbox full_input">
                            <textarea name="feedback" rows="7" placeholder="Enter your feedback"></textarea>
                            <span class="error" name="m_error"></span>
                        </div>
                    </div>
                    <div class="eachline">
                        <div class="eachinputbox full_input">
                            <input name="rating" placeholder="How much will u rate from 5?" required>
                            <span class="error" name="m_error"></span>
                        </div>
                    </div>

                    <button type="submit" name="feedbackSubmit" class="primary-btn">SEND FEEDBACK</button>
                </form>
                @endforeach
            @else  
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Either You are looking for wrong Ticket ID or you have already given Feedback for this Ticket!!! </strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </section>
    <script src="/js/query.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
@include('includes.footer')
@include('includes.htmlend')