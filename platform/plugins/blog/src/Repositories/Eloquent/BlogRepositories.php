<?php
/**
 * Created by PhpStorm.
 * User: vanth
 * Date: 6/1/2019
 * Time: 4:03 AM
 */

namespace Botble\Blog\Repositories\Eloquent;


use Botble\Blog\Models\Category;

class BlogRepositories
{
    /**
     * Get all categories in categories table
     * @return Category[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getListCategories()
    {
        $categories = Category::orderBy('created_at', 'ASC')->get();
        return $categories;
    }

    /**
     * Get the top view post and featured post of category
     * @param $id
     * @return array
     */
    public function getFeaturedPost($id)
    {
        $data = [];
        if ($id):
        $category = Category::with('posts')->where('id', $id)->first();
        $postsOfLaravel = collect($category->posts);
        $postsOfLaravel = collect($postsOfLaravel)->map(function ($item) {
            return (object)$item;
        });
        $featured_post = $postsOfLaravel->where('is_featured', 1)->sortBy('created_at')->reverse();
        $topViews = $postsOfLaravel->sortBy('views')->last();
        $data = [
            'top_views' => $topViews,
            'featured_post' => $featured_post,
        ];
        return $data;
        else:
            return abort(404);
        endif;
    }

}
