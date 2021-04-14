@include('includes.htmlhead')
@include('includes.navbar')
    <section class="query">
        <div class="imgbox">
            <img src="/images/hero_mail.svg" alt="mail-img">
        </div>
        <div class="formbox">
            <h3>SEND US A MAIL</h3>
            <form action="query" method="POST">
                <div class="eachline">
                    <input type="text" class="half_input left" name="first_name" placeholder="First Name">
                    <input type="text" class="half_input right" name="last_name" placeholder="Last Name">
                </div>
                <div class="eachline">
                    <input type="email" class="full_input" name="email" placeholder="Email">
                </div>
                <div class="eachline">
                   <textarea name="message" rows="7" placeholder="Enter your message"></textarea>
                </div>
                <button  type="submit" name="querysubmit" class="primary-btn">SEND MESSAGE</button>
            </form>
        </div>
    </section>
    <script src="/js/query.js"></script>
@include('includes.footer')
@include('includes.htmlend')