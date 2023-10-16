<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use function Webmozart\Assert\Tests\StaticAnalysis\string;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        return view('dashboard.post.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.post.create', ['post' => new Post(), 'categories' => Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePost $request)
    {
        $ruta = '';
        if ($request->hasFile('image')) {
            $imagen = $request->file('image');
            $nombre = time() . '_' . $imagen->getClientOriginalName();
            $ruta = $imagen->storeAs('imagenes', $nombre, 'public'); // Almacenar la imagen en el sistema de archivos

            // Aquí puedes guardar la información de la imagen en la base de datos si es necesario

        }
        $postForm = $request->input();
        $post = [
            'name'=>$postForm['name'],
            'description'=>$postForm['description'],
            'state'=>$postForm['state'],
            'image'=>$nombre,
            /*'category_id'=>$postForm['category_id']*/
        ];
        Post::create($post);
        return back()->with('status', 'Publicación creada con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('dashboard.post.show', ["post" => $post, 'categories' => Category::all()]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('dashboard.post.edit', ["post" => $post, 'categories' => Category::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Post $post)
    // public function update(StorePostPost $request, Post $post) Creo que hay error
    public function update(Request $request, Post $post)
    {
        $ruta ='';
            var_dump($request->file('image'));
        if ($request->hasFile('image')) {
            $imagen = $request->file('image');
            $nombre = time() . '_' . $imagen->getClientOriginalName();
            $ruta = $imagen->storeAs('imagenes', $nombre, 'public'); // Almacenar la imagen en el sistema de archivos

            // Aquí puedes guardar la información de la imagen en la base de datos si es necesario

        }
        $p = $request->input();
        $pu = [
          'name'=>$p['name'],
          'state'=>$p['state'],
          'description'=>$p['description'],
          'image'=>$nombre
        ];

        Post::where('id', $p['postid'])->update($pu);

        return back()->with('status',"Post modificado exitosamente");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $data = $request->input();
        Post::where('id', $data['id'])->delete();
        return back()->with('status', 'Post eliminado exitosamente');
    }

    public function image(Request $request, Post $post)
    {
        $request->validate([
            'image' => 'required|mimes:jpeg,bmp,png|max:10240',
        ]);
        $filename = time() . "." . $request->image->extension();
        $request->image->move(public_path('images'), $filename);
        echo "subio la imagen" . $filename;
        PostImage::create(['image' => $filename, 'post_id' => $post->id]);
        return back()->with('status', 'Imagen cargada con exito');
    }

    public function allPostApi(){
        $posts = Post::all()->collect();

        foreach ($posts as $post){
            $post->image = asset('imagenes/'. $post->image);
        }
        return $posts;
    }
}
