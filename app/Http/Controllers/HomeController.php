<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\TimerEntry;
use App\Models\User;
use DateTimeImmutable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): Renderable
    {
        $user = $this->getUser();

        $current = $this->getCurrentEntry($user);
        $history = $this->getEntryHistory($user);

        $tagJsonData = array_map(function(Tag $tag) {
            return ['id' => $tag->id, 'name' => $tag->description];
        }, Tag::getByUser($user)->all());

        return view(
            'home',
            [
                'nav' => $this->topNavigation(),
                'current' => $current,
                'history' => $history,
                'tagJsonData' => $tagJsonData
            ]
        );
    }

    public function createEntry(Request $request): Response
    {
        $user = $this->getUser();
        $description = $request->post('description');

        $tagIds = $request->post('tags', []);

        $tags = null;
        if (count($tagIds) > 0) {
            $tags = Tag::findMany($tagIds)->where('user_id', $user->id);
        }

        $entry = new TimerEntry();
        $entry->user_id = $user->id;
        $entry->description = $description;
        $entry->start_date = new DateTimeImmutable();

        DB::transaction(function() use ($entry, $tags) {
            $entry->save();
            if ($tags !== null) {
                $entry->tags()->attach($tags);
            }
        });

        return redirect()->route('home');
    }

    public function stopCurrentEntry(): Response
    {
        $user = $this->getUser();
        $current = $this->getCurrentEntry($user);

        $current->end_date = new DateTimeImmutable();
        $current->save();

        return redirect()->route('home');
    }

    public function deleteEntry(int $entryId): Response
    {
        $user = $this->getUser();
        $entry = $this->findEntry($user, $entryId);

        if ($entry !== null) {
            $entry->delete();
        }

        return redirect()->route('home');
    }

    private function getCurrentEntry(User $user): ?TimerEntry
    {
        return TimerEntry::where('user_id', $user->id)
            ->whereNull('end_date')
            ->first();
    }

    private function getEntryHistory(User $user): Collection
    {
        return TimerEntry::where('user_id', $user->id)
            ->whereNotNull('end_date')
            ->orderBy('start_date', 'desc')
            ->get();
    }

    private function findEntry(User $user, int $entryId): ?TimerEntry
    {
        return TimerEntry::where(['id' => $entryId, 'user_id' => $user->id])->first();
    }
}
