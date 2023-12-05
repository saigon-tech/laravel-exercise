<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectStoreRequest;
use App\Http\Services\ProjectStoreService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProjectStoreController extends Controller
{
    /**
     * Store a new project.
     *
     * @param  ProjectStoreRequest  $request
     * @return RedirectResponse
     */
    public function __invoke(ProjectStoreRequest $request): RedirectResponse
    {
        // catch the exception and rollback the transaction, log the error and redirect back with error message
        try {
            DB::beginTransaction();
            // Create the project
            ProjectStoreService::store($request->validated());

            DB::commit();
            // Return the view
            return redirect()->route('projects.create')->with('success', __('messages.project.created'));
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
