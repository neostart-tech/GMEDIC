<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait FileManagementTrait
{
	private static string $disk = 'public';

	/**
	 * @param Request $request
	 * @param string $fileKey
	 * @param string $folderName
	 * @param string|null $fileName
	 * @return string
	 */
	private function storeFile(Request $request, string $fileKey, string $folderName, string $fileName = null): string
	{
		$file = $request->file($fileKey);
		$fileFullName = uniqid($fileName ?? '') . '.' . $file->getClientOriginalExtension();
		return Storage::disk(static::$disk)->putFileAs($folderName, $file, $fileFullName);
	}

	/**
	 * @param Request $request
	 * @param string $fileKey
	 * @param string $folderName
	 * @param string $fileOldName
	 * @param string|null $fileName
	 * @return string
	 */
	private function updateFile(Request $request, string $fileKey, string $folderName, string $fileOldName, string $fileName = null): string
	{
		$this->deleteFile($fileOldName);
		return $this->storeFile($request, $fileKey, $folderName, $fileName);
	}


	/**
	 * Supprime un fichier sur le disque 'public' sur le serveur
	 *
	 * @param string $fileName
	 * @return void
	 */
	private function deleteFile(string $fileName): void
	{
		if (Storage::disk(static::$disk)->exists($fileName)) {
			Storage::disk(static::$disk)->delete($fileName);
		}
	}
}
