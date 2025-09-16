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
                        <a href="{{ route('blogs.index') }}" class="btn"  rel="noreferrer">
                        List
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

                    <div class="col-md-12">
                        <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Elasticseach</h3>
                        </div>
                        <div class="card-body">
                            <div class="btn-list">
                                <div class="col-md-10 col-xl-10">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="searchInput" placeholder="Input placeholder">
                                    </div>
                                </div>
                                <div class="col-md-1 col-xl-1">
                                    <a class="btn btn-primary" id="searchButton" >Search</a>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>

                   <div id="resultsContainer" class="mt-4">   </div>
            
                </div>
            </div>
        </div>
 
      </div>
    </div>


    <script>
(function(){
  const input = document.getElementById('searchInput');
  const btn = document.getElementById('searchButton');
  const resultsContainer = document.getElementById('resultsContainer');

  // Helper: escape HTML (XSS koruması)
  function escapeHtml(str) {
    const div = document.createElement('div');
    div.textContent = str;
    return div.innerHTML;
  }

  function truncate(text, length = 200) {
    if (!text) return '';
    return text.length > length ? text.slice(0, length) + '...' : text;
  }

  function stripTags(html) {
    const div = document.createElement('div');
    div.innerHTML = html || '';
    return div.textContent || div.innerText || '';
  }
/*
  function renderResults(items) {
    if (!items || items.length === 0) {
      resultsContainer.innerHTML = '<div class="alert alert-warning">Arama sonucu bulunamadı.</div>';
      return;
    }

    let html = '<div class="list-group">';
    items.forEach(item => {
      // highlight varsa onu kullan, yoksa plain snippet
      let titleHtml = '';
      if (item.highlight && item.highlight.title) {
        titleHtml = item.highlight.title.join(' ... ');
      } else {
        titleHtml = escapeHtml(item.title);
      }

      let excerpt = '';
      if (item.highlight && item.highlight.content) {
        excerpt = item.highlight.content.join(' ... ');
      } else {
        excerpt = escapeHtml(truncate(stripTags(item.content), 250));
      }

      // link ihtiyaca göre düzenle (örnek: /blogs/{id})
      const url = `/blogs/${encodeURIComponent(item.id)}`;

      html += `
        <a href="${url}" class="list-group-item list-group-item-action mb-2">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">${item.title} </h5>
            <small>score: ${Math.round((item.score||0) * 100) / 100}</small>
          </div>
          <p class="mb-1">${excerpt}</p>
        </a>`;
    });
    html += '</div>';
    resultsContainer.innerHTML = html;
  }
*/
function renderResults(items) {
    if (!items || items.length === 0) {
      resultsContainer.innerHTML = '<div class="alert alert-warning">Arama sonucu bulunamadı.</div>';
      return;
    }

    // Tablo başlıklarını oluştur
    let html = `
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Başlık</th>
          <th>Yazar</th>
          <th>Açıklama</th>
        </tr>
      </thead>
      <tbody>
    `;

    // Her bir öğe için tablo satırı oluştur ve ana stringe ekle
    items.forEach(item => {
      // Highlight kontrolü aynı kalabilir
      let titleHtml = (item.highlight && item.highlight.title) ? item.highlight.title.join(' ... ') : escapeHtml(item.title);
      let authorHtml = (item.highlight && item.highlight.author) ? item.highlight.author.join(' ... ') : escapeHtml(item.author);
      let descriptionHtml = (item.highlight && item.highlight.description) ? item.highlight.description.join(' ... ') : escapeHtml(item.description);

      html += `
        <tr>
            <td>${titleHtml}</td>
            <td>${authorHtml}</td>
            <td>${descriptionHtml}</td>
        </tr>`;
    });

    // Tabloyu kapat
    html += `
      </tbody>
    </table>`;

    resultsContainer.innerHTML = html;
}

  async function doSearch() {
    const q = input.value.trim();
    if (!q) {
      resultsContainer.innerHTML = '<div class="alert alert-info">Lütfen arama terimi girin.</div>';
      return;
    }

    resultsContainer.innerHTML = '<div class="text-center py-4"><div class="spinner-border" role="status"><span class="visually-hidden">Yükleniyor...</span></div></div>';
    try {
      const resp = await fetch(`/elastic/search?q=${encodeURIComponent(q)}`, {
        headers: { 'Accept': 'application/json' }
      });

      if (!resp.ok) {
        const text = await resp.text();
        throw new Error(text || resp.statusText);
      }

      const json = await resp.json();
      renderResults(json.data || []);
    } catch (err) {
      resultsContainer.innerHTML = `<div class="alert alert-danger">Hata: ${escapeHtml(err.message)}</div>`;
      console.error(err);
    }
  }

  // Eventler
  btn.addEventListener('click', doSearch);
  input.addEventListener('keydown', function(e){
    if (e.key === 'Enter') {
      e.preventDefault();
      doSearch();
    }
  });

  // isteğe bağlı: input kaydedilmiş query varsa otomatik arama
  const urlParams = new URLSearchParams(window.location.search);
  if (urlParams.get('q')) {
    input.value = urlParams.get('q');
    doSearch();
  }

})();
</script>
  
    <script src="{{ asset('assets/js/tabler.min.js?1684106062') }}" defer></script>
    <script src="{{ asset('assets/js/demo.min.js?1684106062') }}" defer></script>
     <script src="{{ asset('assets/js/main.js') }}" defer></script>
  </body>
</html>