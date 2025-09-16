<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blogs; // Kendi modelini burada kullan
use Illuminate\Support\Facades\DB;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;

class BlogController extends Controller
{
    public function elasticsearch(Request $request, Client $elasticsearch)
    {
        $q = trim((string) $request->query('q', ''));
        if ($q === '') {
            return response()->json(['data' => []]);
        }
        $params = [
            'index' => 'blogs', // index adını kendi indexine göre değiştir
            'body' => [
                'query' => [
                    'multi_match' => [
                        'query'  => $q,
                        'fields' => ['title^3', 'author^3' , 'description' ],
                        'fuzziness' => 'AUTO',
                    ],
                ],
                'highlight' => [
                    'fields' => [
                        'title' => new \stdClass(),
                        'author' => new \stdClass(),
                        'description' => new \stdClass(),
                    ],
                ],
                'size' => 10,
            ],
        ];
        $response = $elasticsearch->search($params);
    
        $arr = $response->asArray();
        $hits = $arr['hits']['hits'] ?? [];
        $results = array_map(function ($h) {
            return [
                'id' => $h['_id'],
                'score' => $h['_score'] ?? 0,
                'title' => $h['_source']['title'] ?? '',
                'author' => $h['_source']['author'] ?? '',
                'description' => $h['_source']['description'] ?? '',
                'highlight' => $h['highlight'] ?? [],
            ];
        }, $hits);
  
        return response()->json(['data' => $results]);
    }

    public function store(Request $request)
    {  
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->file('image')->storeAs('uploads', $imageName, 'public_uploads');
        }


        // 3. Veritabanına kaydet
        // Örnek:
        Blogs::create([
            'title' => $validatedData['title'],
            'author' => $validatedData['author'],
            'description' => $validatedData['description'],
            'image' => $imageName,
        ]);

        // 4. Başarılı yanıt gönder
        return response()->json([
            'message' => 'Veriler başarıyla kaydedildi!',
            'data' => $validatedData
        ], 200);
    }

    public function index()
    {  
      
        $blogs = Blogs::paginate(10);
  
        return view('index', compact('blogs'));
    }

    public function destroy($id)
    { 
          // Blogu bul
        $blog = Blogs::findOrFail($id);
        
        // Blogu sil
        $blog->delete();

        // Başarılı yanıt gönder
        return response()->json([
            'message' => 'İçerik başarıyla silindi!'
        ], 200);
    }

    public function edit($id)
    {
        $blogs = Blogs::find($id); 
        return view('edit', compact('blogs'));
    }

    public function update(Request $request   )
    {
        // 1. Gelen verileri doğrula (Validation)
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
          
        ]);

          
         
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads'), $imageName);
            $validatedData['image'] = $imageName;
        }

        // $data = [
        //     'title' => $request->title,
        //     'author' => $request->author,
        //     'description' => $request->description,
        //     'image' => $imageName,
        // ];

        Blogs::where('id', $request->id)->update($validatedData);
        return response()->json([
            'message' => 'Veriler başarıyla kaydedildi!',
            'data' => $validatedData
        ], 200);
    }

    public function search()
    {
       return view('search' );
    }

  
}