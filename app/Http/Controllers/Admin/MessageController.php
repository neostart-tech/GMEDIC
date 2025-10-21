<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\{RedirectResponse, Response};
use Illuminate\Support\Str;
use Illuminate\View\View;
use Throwable;

class MessageController extends Controller
{
	public function index(): View
	{
		$messages = Message::query()
			->orderByDesc('created_at')
			->get()
			->map(fn(Message $message) => $message->setAttribute('date', Str::upper($message->getAttribute('created_at')->translatedFormat('d F Y'))));

		return view('admin.messages.index')->with([
			'messages' => $messages
		]);
	}

	public function read(string $slug): Response|ResponseFactory
	{
		$message = Message::query()->firstWhere('id', $slug);
		if (!$message) return __404();

		if ($message->getAttribute('read')) return __200();

		try {
			$message->update(['read' => true]);
		} catch (Throwable $throwable) {
			return __500($throwable->getMessage());
		}
		return __200();
	}

	public function destroy(Message $message): RedirectResponse
	{
		$message->delete();
		return back()->with('success', 'Message supprimé avec succès');
	}
}
