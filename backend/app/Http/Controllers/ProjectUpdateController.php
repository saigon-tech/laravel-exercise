<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectUpdateRequest;
use App\Http\Services\ProjectUpdateService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProjectUpdateController extends Controller
{
    // Update a project.
    public function __invoke(ProjectUpdateRequest $request, string $id): RedirectResponse
    {
        // catch the exception, rollback and redirect back with error message
        try {
            DB::beginTransaction();

            // Update the project by using ProjectUpdateService.
            ProjectUpdateService::update($request->validated(), $id);

            DB::commit();

            // Redirect the user to the project list page with a success message.
            return redirect()
                ->route('projects.index')
                ->with('success', __('messages.project.updated'));
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
