<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\LoginResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Notification;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Custom login redirect based on user role
        $this->app->singleton(LoginResponse::class, function () {
            return new class implements LoginResponse {
                public function toResponse($request)
                {
                    $user = Auth::user();
                    return redirect()->intended($user->role === 'admin' ? '/admin/dashboard' : '/dashboard');
                }
            };
        });

        // Share a limited number of recent notifications with all views for dropdown display
        View::composer('*', function ($view) {
            $recentNotifications = collect();

            if (Auth::check()) {
                // Authenticated users get both 'user' and 'public' notifications plus event reminders for upcoming events
                $recentNotifications = Notification::whereIn('user_type', ['user', 'public'])
                    ->where(function ($query) {
                        $query->whereNull('event_id')->orWhereHas('event', function ($q) {
                            $q->where('date', '>=', now()); // show upcoming events only
                        });
                    })
                    ->orderBy('created_at', 'desc')
                    ->take(10) // limit for dropdown
                    ->get();
            } else {
                // Guests get only public notifications
                $recentNotifications = Notification::where('user_type', 'public')
                    ->orderBy('created_at', 'desc')
                    ->take(10)
                    ->get();
            }

            $view->with('recentNotifications', $recentNotifications);
        });
    }
}
