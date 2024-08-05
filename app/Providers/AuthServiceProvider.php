<?php

namespace App\Providers;

use App\Models\Vacante;
use App\Policies\VacantePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Vacante::class => VacantePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        VerifyEmail::toMailUsing(function($notifiable, $url) {
            return (new MailMessage)
                ->subject("Verificar cuenta")
                ->line("Tu cuenta ya esta casi lista, solo presiona el enlace a continiuación")
                ->action("Confirmar mi cuenta", $url)
                ->line("Si tu no solicitaste una cuenta en DevJobs, solamente haz caso omiso");

        });
    }
}
