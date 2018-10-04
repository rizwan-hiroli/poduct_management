<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>CMS</title>

        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="css/style2.css">
        <!-- Scrollbar Custom CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
        <style type="text/css">
          #row {
                  padding-top: 200px;
                  /*border: 1px solid #4CAF50;*/
                }


        </style>
    </head> 


<div class="container ">
  <div class="row col-lg-6 col-lg-offset-3 " id="row">
       

      <h3 class="text-center">LOGIN</h3>
   

        <form method="post" action="/">

  		      	{{ csrf_field() }}
  
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          </div>
        </div>

        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label"></label>
          <div class="col-sm-10">
          <a href="/register" style="color:blue">Not a member ? register now</a>
        </div>
        </div>

        <div class="form-group row pull-right">
          <div class="col-sm-10">
            <button type="submit" class="btn btn-primary ">Sign in</button>
          </div>
        </div><br><br>

       


      </form>

      @if(Session::has('flash_message'))
          <div class="alert alert-success">
              {{ Session::get('flash_message') }}
          </div>
      @endif
      



       @if(count($errors))
          <div class="form-group">
            <div class="alert alert-danger">
              <ul>
                @foreach($errors->all() as $error)
                  <li>  {{ $error }}  </li>
                @endforeach
              </ul>
              
            </div>
          </div>
        @endif
  </div>
<div>
