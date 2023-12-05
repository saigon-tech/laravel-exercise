<?php

namespace App\Http\Controllers;

use App\Http\Services\ProjectDestroyService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProjectDestroyController extends Controller
{
    // Destroy a project.
    public function __invoke(string $id): RedirectResponse
    {
        // catch the exception, rollback and redirect back with error message
        try {
            DB::beginTransaction();

            // Destroy the project by using ProjectDestroyService.
            ProjectDestroyService::destroy($id);

            DB::commit();

            // Redirect the user to the project list page with a success message.
            return redirect()
                ->route('projects.index')
                ->with('success', __('messages.project.destroyed'));
        } catch (\Exception $e) {
            // Log the error
            Log::error($e->getMessage());

            // Rollback the transaction
            DB::rollBack();

            // Redirect back with error message
            return redirect()->back()->withInput()->with('error', __('messages.server_error'));
        }
    }
}
