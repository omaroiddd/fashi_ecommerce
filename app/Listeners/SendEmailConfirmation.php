<?php

namespace App\Listeners;

use App\Events\OrderPlacedEvent;
use App\Mail\OrderPlaced;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmailConfirmation
{
    /**
     * Create the event listener.
     */
    // public $order;

    // public function __construct(Order $order)
    // {
    //     $this->order = $order;
    // }

    /**
     * Handle the event.
     */
    public function handle(OrderPlacedEvent $event): void
    {
        
        $order = $event->order;

        // Ensure the order email exists before sending the email
        if (!empty($order->email)) {
            // Get the list of admin emails (those you want to CC)
            $adminEmails = User::whereIn('name', ['omar', 'abdallah'])->pluck('email')->toArray();

            // Send email to the customer and CC admins
            Mail::to($order->email)
                ->cc($adminEmails)  // Add admins as CC
                ->send(new OrderPlaced($order));
        } else {
            // Handle the case where no email is found for the order
            Log::error('Order email not found for order ID: ' . $order->id);
        }
    }
}
