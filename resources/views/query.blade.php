@include('includes.htmlhead')
@include('includes.navbar')
    <section class="query">
        <div class="imgbox">
            <img src="/images/hero_mail.svg" alt="mail-img">
        </div>
        <div class="formbox">
            <h3>SEND US A MAIL</h3>

            {{-- Some styling required (optional) --}}
            @if($message=Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if($message=Session::get('fail'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{url('ticketSubmit')}}" method="POST" name="myForm">
                @csrf
                <div class="eachline">
                    <p>Ticket ID</p>
                    <div class="eachinputbox full_input">
                        <input type="number" class="full_input" name="ticket_id" value={{ $ticket_id }} readonly>
                    </div>
                </div>
                <div class="eachline">
                    <div class="eachinputbox half_input left">
                        <input type="text" class="" name="first_name" placeholder="First Name">
                        <span class="error"  name="f_error"></span>
                    </div>
                    <div class="eachinputbox half_input right">
                        <input type="text" class="" name="last_name" placeholder="Last Name">
                        <span  name="l_error" class="error"></span>
                    </div>
                </div>
                <div class="eachline mail">
                    <div class="eachinputbox full_input">
                        <input type="email" class="full_input" name="email" placeholder="Email">
                        <span class="error" name="e_error"></span>
                    </div>
                </div>
                <div class="eachline">
                    <div class="eachinputbox full_input">
                        <textarea name="message" rows="7" placeholder="Enter your message"></textarea>
                        <span class="error" name="m_error"></span>
                    </div>
                </div>
                <button type="submit" name="querysubmit" class="primary-btn">SEND MESSAGE</button>
            </form>
        </div>
    </section>
    <script src="/js/query.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
@include('includes.footer')
@include('includes.htmlend')