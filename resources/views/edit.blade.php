<!doctype html>
 
<html lang="en"> 
  <head>
    <meta charset="utf-8"/> 
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Elasticseach</title>
    <link href="{{ asset('assets/css/tabler.min.css?1684106062') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/tabler-flags.min.css?1684106062') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/tabler-payments.min.css?1684106062') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/tabler-vendors.min.css?1684106062') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/demo.min.css?1684106062') }}" rel="stylesheet"/>
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
  </head>
  <body >
    <script src="{{ asset('assets/js/demo-theme.min.js?1684106062') }}"></script>
    <div class="page">
 
      <header class="navbar navbar-expand-md d-print-none" >
        <div class="container-xl">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            Elasticseach
          </h1>

            <div class="navbar-nav flex-row order-md-last">
                <div class="nav-item d-none d-md-flex me-3">
                    <div class="btn-list">
                      <a href="{{ route('add.form') }}" class="btn"  rel="noreferrer">
                        Add
                        </a>
                        <a href="{{ route('blogs.index') }}" class="btn"  rel="noreferrer">
                        List
                        </a>
                        <a href="{{ route('blogs.search') }}" class="btn"   rel="noreferrer">
                        Search
                        </a>
                    </div>
                </div>
            </div>

        </div>
      </header>

      <div class="page-wrapper">
       
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">

                    <div class="col-12">
                    
                        <form action="{{ route('blogs.update', $blogs->id) }}" method="POST"  enctype="multipart/form-data"  class="card ">
                               @csrf
                                @method('PUT')
                            <div class="card-header">
                                <h4 class="card-title">Form Edit</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="row">

                                        <input type="text" hidden class="form-control" name="id" value="{{$blogs->id}}">

                                            <div class="col-md-6 col-xl-6">
                                                <div class="mb-3">
                                                <label class="form-label">Title</label>
                                                <input type="text" class="form-control" name="title" value="{{$blogs->title}}">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-xl-6">
                                                <div class="mb-3">
                                                <label class="form-label">Author</label>
                                                <input type="text" class="form-control" name="author" value="{{$blogs->author}}">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-xl-12">
                                                <div class="mb-3">
                                                <label class="form-label">Description</label>
                                                <textarea class="form-control" name="description" rows="6" placeholder="Description..">{{$blogs->description}}</textarea>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col-auto">
                                                    <span class="avatar avatar-md" style="background-image: url({{ asset('uploads/'.$blogs->image) }})"> </span>
                                                    </div>
                                                    <div class="col">
                                                    <div class="mb-3">
                                                        <label class="form-label">Image</label>
                                                         <input type="file" name="image" class="form-control" />
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <div class="d-flex">
                                    <a href="#" class="btn btn-link">Cancel</a>
                                    <button type="submit" class="btn btn-primary ms-auto">Send data</button>
                                </div>
                            </div>
                        </form>
                    </div>
            
                </div>
            </div>
        </div>
 
      </div>
    </div>
  
    <script src="{{ asset('assets/js/tabler.min.js?1684106062') }}" defer></script>
    <script src="{{ asset('assets/js/demo.min.js?1684106062') }}" defer></script>
     <script src="{{ asset('assets/js/main.js') }}" defer></script>
  </body>
</html>