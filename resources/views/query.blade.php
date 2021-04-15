@include('includes.htmlhead')
@include('includes.navbar')
    <section class="query">
        <div class="imgbox">
            <img src="/images/hero_mail.svg" alt="mail-img">
        </div>
        <div class="formbox">
            <h3>SEND US A MAIL</h3>
            <form action="{{url('ticketSubmit')}}" method="POST" name="myForm">
                @csrf
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
@include('includes.footer')
@include('includes.htmlend')