<?php

namespace Botble\Blog\Http\Controllers;

use Botble\ACL\Repositories\Interfaces\UserInterface;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Blog\Repositories\Eloquent\BlogRepositories;
use Botble\Blog\Repositories\Interfaces\PostInterface;
use Botble\Blog\Repositories\Interfaces\TagInterface;
use Botble\SeoHelper\SeoOpenGraph;
use Botble\Slug\Repositories\Interfaces\SlugInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use SeoHelper;
use Theme;

class PublicController extends Controller
{

    /**
     * @var TagInterface
     */
    protected $tagRepository;

    /**
     * @var SlugInterface
     */
    protected $slugRepository;

    /**
     * PublicController constructor.
     * @param TagInterface $tagRepository
     * @param SlugInterface $slugRepository
     */
    public function __construct(TagInterface $tagRepository, SlugInterface $slugRepository)
    {
        $this->tagRepository = $tagRepository;
        $this->slugRepository = $slugRepository;
    }

    /**
     * @param Request $request
     * @param PostInterface $postRepository
     * @return \Response
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getSearch(Request $request, PostInterface $postRepository)
    {
        $query = $request->input('q');
        SeoHelper::setTitle(__('Search result for: ') . '"' . $query . '"')
            ->setDescription(__('Search result for: ') . '"' . $query . '"');

        $posts = $postRepository->getSearch($query, 0, 12);

        Theme::breadcrumb()
            ->add(__('Home'), url('/'))
            ->add(__('Search result for: ') . '"' . $query . '"', route('public.search'));

        return Theme::scope('search', compact('posts'))->render();
    }

    /**
     * @param string $slug
     * @param UserInterface $userRepository
     * @return \Response
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getAuthor($slug, UserInterface $userRepository)
    {
        $author = $userRepository->getFirstBy(['username' => $slug]);
        if (!$author) {
            return abort(404);
        }

        admin_bar()->registerLink('Edit this user', route('user.profile.view', $author->id));

        SeoHelper::setTitle($author->getFullName())->setDescription($author->about);
        Theme::breadcrumb()
            ->add(__('Home'), url('/'))
            ->add($author->getFullName(), route('public.author', $slug));

        do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, USER_MODULE_SCREEN_NAME, $author);

        return Theme::scope('author', compact('author'), 'plugins/blog::themes.author')->render();
    }

    /**
     * @param string $slug
     * @return \Botble\Theme\Facades\Response|\Illuminate\Http\Response|\Response
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getTag($slug)
    {
        $slug = $this->slugRepository->getFirstBy(['key' => $slug, 'reference' => TAG_MODULE_SCREEN_NAME]);
        if (!$slug) {
            abort(404);
        }
        $tag = $this->tagRepository->getFirstBy(['id' => $slug->reference_id, 'status' => BaseStatusEnum::PUBLISHED]);

        if (!$tag) {
            abort(404);
        }

        SeoHelper::setTitle($tag->name)->setDescription($tag->description);

        $meta = new SeoOpenGraph();
        $meta->setDescription($tag->description);
        $meta->setUrl(route('public.tag', $slug->key));
        $meta->setTitle($tag->name);
        $meta->setType('article');

        admin_bar()->registerLink(trans('plugins/blog::tags.edit_this_tag'), route('tags.edit', $tag->id));

        $posts = get_posts_by_tag($tag->id);

        Theme::breadcrumb()->add(__('Home'), url('/'))->add($tag->name, route('public.tag', $slug->key));

        do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, TAG_MODULE_SCREEN_NAME, $tag);

        return Theme::scope('tag', compact('tag', 'posts'), 'plugins/blog::themes.tag')->render();
    }

    /**
     * Get view of blog page
     * @param BlogRepositories $blogRepositories
     * @return \Botble\Theme\Facades\Response|\Illuminate\Http\Response|\Response
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getBlog(BlogRepositories $blogRepositories)
    {
        $params = [];
        $params ['posts'] = $blogRepositories->getAllPost();
        return Theme::scope('blog_index', $params, 'plugins/blog::blog.blog_index')->render();
    }

    /**
     * Get view of Categories page
     * @param $tags
     * @param BlogRepositories $blogRepositories
     * @return \Botble\Theme\Facades\Response|\Illuminate\Http\Response|\Response
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getCategories($tags, BlogRepositories $blogRepositories)
    {
        if ($tags) {
            $params = [];
            $params['posts'] = $blogRepositories->getPostByCategory($tags);
            $params['category_name'] = $blogRepositories->getCategoryName($tags);
            return Theme::scope('category_index', $params, 'plugins/blog::categories.category_index')->render();
        } else {
            return abort(404);
        }
    }

    /**
     * Get blog details page
     * @param $slug
     * @param BlogRepositories $blogRepositories
     * @return \Botble\Theme\Facades\Response|\Illuminate\Http\Response|\Response
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getBlogDetails($slug, BlogRepositories $blogRepositories)
    {
        if ($slug) {
            $params = [];
            $params['detail'] = $blogRepositories->getPostDetails($slug);
            event('public.blog.details', $params['detail']);
            return Theme::scope('index_details', $params, 'plugins/blog::details.index_details')->render();
        } else {
            return abort(404);
        }
    }
}
