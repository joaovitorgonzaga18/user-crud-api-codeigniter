<!DOCTYPE html>
<html data-mdb-theme="dark">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link rel="stylesheet" href="/assets/mdb/css/mdb.min.css">
    <script src="/assets/mdb/js/mdb.min.js"></script>
    <script src="/assets/js/jquery-3.7.1.js"></script>
    <script src="/assets/js/loadingoverlay.min.js"></script>
</head>

<body>
    <div class="container-fluid vh-100 d-flex justify-content-center align-items-center">
        <div class="row bg-light shadow p-3 mb-5 bg-white rounded" data-mdb-theme="light" style="padding: 2.5em" id="div-login">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center" style="color: #424242; font-weight: 600;">LOGIN</h1>
                    <div class="alert alert-primary d-none text-center" role="alert" id="message-alert">
                        
                    </div>
                </div>
            </div>
            <form id="login-form" method="post" action="">
                <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="email" id="email" name="email" class="form-control required" required />
                    <label class="form-label" for="email">Email address</label>
                </div>

                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" id="password" name="password" class="form-control required" required />
                    <label class="form-label" for="password">Password</label>
                </div>

                <!-- Submit button -->
                <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">Sign in</button>
            </form>
        </div>
    </div>
</body>

<script src="/assets/js/login.js"></script>

</html>