<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="login-form">
                    <h2>Login to your account</h2>
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <input type="email" name="email" placeholder="Email" />
                        <input type="password" name="password" placeholder="Password" />
                        <button type="submit" class="btn btn-default">Login</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="register-form">
                    <h2>New User Signup!</h2>
                    <form action="{{ route('register') }}" method="post">
                        @csrf
                        <input type="text" name="name" placeholder="Name" />
                        <input type="email" name="email" placeholder="Email" />
                        <input type="password" name="password" placeholder="Password" />
                        <button type="submit" class="btn btn-default">Signup</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>