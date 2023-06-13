<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name='csrf-token' content='{{csrf_token()}}'>
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>  
</head>
<body>
  @yield('content')  

  <footer class="container-fluid bg-dark text-white mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center p-5">
                    Domain kezelő program 2023
                </div>
            </div>
        </div>
    </div>
  </footer>

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="modal-title"></h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body" id='modal-body'></div>
  
        <!-- Modal footer -->
        <div class="modal-footer" id='modal-footer'>
          <!--<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Mégsem</button>-->
        </div>
  
      </div>
    </div>
  </div>
</body>
</html>