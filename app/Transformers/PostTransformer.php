namespace App\Transformers;

use App\Models\Post;

class PostTransformer
{
public static function transform(Post $post)
{
return [
'id' => $post->id,
'judul' => $post->title,
'isi' => $post->content,
'created' => $post->created_at->toDateTimeString(),
];
}
}