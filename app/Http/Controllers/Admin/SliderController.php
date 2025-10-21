<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use App\Traits\FileManagementTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SliderController extends Controller
{
	use FileManagementTrait;

	private const FOLDER = "sliders";

	public function index(): View
	{
		return view('admin.sliders.index')->with([
			'sliders' => Slider::all()
		]);
	}

	public function create(): View
	{
		return view('admin.sliders.create')->with(['slider' => new  Slider()]);
	}

	public function store(SliderRequest $request): RedirectResponse
	{
		Slider::query()->create([
			'slider_desc' => $request->get('slider_desc'),
			'slide_image' => $this->storeFile($request, 'slide_image', static::FOLDER),
		]);

		return to_route('admin.sliders.index')->with('success', 'Slide créé avec succès');
	}

	public function edit(Slider $slider): View
	{
		return view('admin.sliders.edit', compact('slider'));
	}

	public function update(SliderRequest $request, Slider $slider): RedirectResponse
	{
		$filePath = $request->hasFile('slide_image') ? $this->updateFile($request, 'slide_image', static::FOLDER, $slider->getAttribute('slide_image')) : $slider->getAttribute('slide_image');
		$slider->update([
			...$request->only('slider_desc'),
			'slide_image' => $filePath
		]);
		return to_route('admin.sliders.index')->with('success', 'Slide mis à jour avec succès');
	}

	public function destroy(Slider $slider): RedirectResponse
	{
		$this->deleteFile($slider->getAttribute('slide_image'));
		$slider->delete();
		return to_route('admin.sliders.index')->with('success', 'Slide supprimé avec succès');
	}
}
