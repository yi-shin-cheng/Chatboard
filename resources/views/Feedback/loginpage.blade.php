<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- use boostrap5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

        <title>留言板系統</title>
</head>

<body>
    <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <h2 class="navbar-brand" href="/">留言板系統</h2>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('index') }}">首頁</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('registerpage') }}">註冊</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('loginpage') }}">登入</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

        <h2 class="text-center">留言板系統</h2>
        <h3><small class="text-muted">登入介面</small></h3>
        @if(Session::has("message"))
            <div class = "alert alert-success" role="alert">{{ Session::get("message") }}</div>
        @endif

        @if(Session::has("warning"))
        <div class="alert alert-warning d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>{{ Session::get("warning")}}</div>
        </div>
        @endif
        <br>
        <form action = " {{ route('login') }} " method="post">
            @csrf
            <div class = "mb-3">
                <label for="user_name" class="form-label">User Name <small class="text-muted">(allow only numbers & english letters, maximum length is 15)</small></label>
                <input type = "user_name" class="form-control" name="user_name" id="user_name" placeholder="please enter your user name" pattern="[a-zA-Z0-9]+" required>
            </div>
            <div class = "mb-3">
                <label for="password" class="form-label">Password <small class="text-muted">(allow only numbers & english letters)</small></label>
                <input type = "password" class="form-control" name="password" id="password" placeholder="please enter your password" pattern="[a-zA-Z0-9]+" required>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">登入</button>
            <br><br>
            <small class="text-muted">未有帳號?   </small>
            <button type="button" class="btn btn-warning"><a href = "{{ route('registerpage') }}">註冊</a></button>
        </form>
    </div>


</body>





</html>