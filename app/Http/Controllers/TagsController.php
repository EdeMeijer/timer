<?php

namespace App\Http\Controllers;

use App\Tag;
use App\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TagsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): Renderable
    {
        $user = $this->getUser();

        $allTags = $this->getTags($user);

        return view(
            'tags',
            [
                'tags' => $allTags
            ]
        );
    }

    public function createTag(Request $request): Response
    {
        $user = $this->getUser();
        $description = $request->post('description');

        $tag = new Tag();
        $tag->user_id = $user->id;
        $tag->description = $description;
        $tag->save();

        return redirect()->route('tags');
    }

    public function deleteTag(int $tagId): Response
    {
        $user = $this->getUser();
        $entry = $this->findTag($user, $tagId);

        if ($entry !== null) {
            $entry->delete();
        }

        return redirect()->route('tags');
    }

    private function getTags(User $user): Collection
    {
        return Tag::where('user_id', $user->id)
            ->orderBy('description', 'desc')
            ->get();
    }

    private function findTag(User $user, int $tagId): ?Tag
    {
        return Tag::where(['id' => $tagId, 'user_id' => $user->id])->first();
    }
}
