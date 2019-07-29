<?php

namespace App\Http\Controllers;

use App\TimerEntry;
use App\User;
use DateTimeImmutable;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
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

        return view(
            'home',
            [
                'current' => $current,
                'history' => $history
            ]
        );
    }

    public function createEntry(Request $request): Response
    {
        $user = $this->getUser();
        $description = $request->post('description');

        $entry = new TimerEntry();
        $entry->user_id = $user->id;
        $entry->description = $description;
        $entry->start_date = new DateTimeImmutable();
        $entry->save();

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
