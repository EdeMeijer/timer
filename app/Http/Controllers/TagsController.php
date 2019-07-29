<?php

namespace App\Http\Controllers;

use App\Tag;
use App\User;
use Illuminate\Contracts\Support\Renderable;
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
        return view(
            'tags',
            ['tags' => Tag::getByUser($this->getUser())]
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

    private function findTag(User $user, int $tagId): ?Tag
    {
        return Tag::where(['id' => $tagId, 'user_id' => $user->id])->first();
    }
}
