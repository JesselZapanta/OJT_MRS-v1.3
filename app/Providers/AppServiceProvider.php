<?php

namespace App\Providers;

use App\Models\SetRequirement;
use App\Models\SubmittedRequirement;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('coordinator.*', function ($view) {
            $institute = Auth::user()->institute;

            $approvedCount = User::where('userole', 'intern')->where('institute', $institute)->where('status', 'pending')->count();
            
            $userIdsWithPendingRequirements = SubmittedRequirement::query()
            ->where('status', 'pending') // Keep this filter
            ->orWhere('status', 'declined') // Keep this filter
            ->where('institute', $institute)
            ->distinct('userId')
            ->pluck('userId');

            // Fetch the complete user information for those IDs
            $usersWithPendingRequirementsCount = User::query()
                ->whereIn('id', $userIdsWithPendingRequirements)
                ->count();
        

            $view->with([
                'approvedCount' => $approvedCount,
                'usersWithPendingRequirementsCount' => $usersWithPendingRequirementsCount
            ] );
        });

        view()->composer('intern.*', function ($view) {
            $user = Auth::user()->id;
            $institute = Auth::user()->institute;


            // Get the IDs of requirements already submitted by the user
            $submittedRequirementIds = SubmittedRequirement::where('userId', Auth::id())
                                                            ->pluck('requirementId');

            // Fetch only requirements that are not in the submitted list
            $requirementsCount = SetRequirement::whereIn('office', [$institute, 'ojt'])
                                            ->whereNotIn('id', $submittedRequirementIds)
                                            ->count();
        
            
            $declinedDisapprovedCount = SubmittedRequirement::with('setRequirement')
                                    ->where('userId', $user)
                                    ->where(function ($query) {
                                        $query->where('status', 'declined')
                                            ->orWhere('status', 'disapproved');
                                    })
                                    ->count();


            $view->with([
                'requirementsCount' => $requirementsCount,
                'declinedDisapprovedCount' => $declinedDisapprovedCount
            ] );
        });

        view()->composer('admin.*', function ($view) {

        $userIdsWithPendingRequirements = SubmittedRequirement::query()
            ->where('status', 'checked') // Keep this filter
            ->orWhere('status', 'disapproved') // Keep this filter
            // ->where('institute', $institute)
            ->distinct('userId')
            ->pluck('userId');

        $usersWithPendingRequirementsCount = User::query()
            ->whereIn('id', $userIdsWithPendingRequirements)
            ->count();
        

            $view->with([
                'usersWithPendingRequirementsCount' => $usersWithPendingRequirementsCount
            ] );
        });

    }
}
    