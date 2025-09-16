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
                        <a href="{{ route('add.form') }}" class="btn"   rel="noreferrer">
                        Add
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
                        <div class="card">
                        <div class="table-responsive">
                            <table class="table table-vcenter table-mobile-md card-table">
                                <thead>
                                    <tr>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Description</th>
                                    <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($blogs))
                                    @foreach($blogs as $key => $val)
                                    <tr>
                                        <td data-label="Name">
                                            <div class="d-flex py-1 align-items-center">
                                                <span class="avatar avatar-2 me-2" style="background-image: url({{ asset('uploads/'.$val->image) }})"> </span>
                                            
                                                <div class="flex-fill">
                                                    <div class="font-weight-medium">{{$val->title}}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-label="Title">
                                            <div>{{$val->author}}</div>
                                        </td>
                                        <td class="text-secondary" data-label="Role">{{ Str::limit($val->description, 240) }}</td>
                                        <td>
                                            <div class="btn-list flex-nowrap">
                                                <a href="{{ route('blogs.edit', ['id' => $val->id]) }}" class="btn btn-1"> Edit </a>
                                                <a  data-id="{{ $val->id }}" class="btn btn-1 delete-btn"> Delete </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                
                                </tbody>
                               
                            </table>
                            <div class="card-footer">
                                <div class="row   justify-content-center justify-content-sm-between">
                                    {{ $blogs->links() }}
                                </div>
                            </div>

                            
                        </div>
                        </div>
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