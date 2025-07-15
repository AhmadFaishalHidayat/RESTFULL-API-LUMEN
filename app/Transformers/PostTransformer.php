<?php

namespace App\Transformers;

use App\Models\Category;
use App\Models\Post;

class PostTransformer
{
  public static function transformPosts(Post $post)
  {
    return [
      'id' => $post->id,
      'judul' => $post->title,
      'isi' => $post->content,
      'created' => $post->created_at->toDateTimeString(),
    ];
  }
  public static function transformCategories(Category $category)
  {
    return [
      'id' => $category->id,
      'nama' => $category->name,
      'created' => $category->created_at->toDateTimeString(),
    ];
  }
}
