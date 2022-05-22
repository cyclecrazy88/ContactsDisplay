<!DOCTYPE html>
<html>
    <head>
        <title>Login Page</title>
        <link type="text/css" href="/css/login.css" rel="stylesheet"/>
    </head>
    <body>
         <meta name="csrf-token" content="{{ csrf_token() }}">
        <script type="text/javascript" src="/js/login.js"></script>

        <div class="loginContainer">
            <form class="sendForm" onsubmit="return false">
            <div class="loginSection">
                <h1>Contacts Login</h1>

                <div class="fields">

                    <input type="text" class="username" name="username" placeholder="Username"/>
                    <input type="password" class="password" name="password" placeholder="Password"/>

                </div>
                <div class="registerButton">
                    Register:<input type="checkbox" class="register"/>
                    <div class="registerFields">
                        <input type="text" class="email" placeholder="Email"/>
                    </div>
                </div>

                <button type="submit">Login</button>
            </div>
            @csrf
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            </form>
        </div>

    </body>
</html>
