<?php

/*
 * This file is part of Cachet.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CachetHQ\Cachet\Notifications\Subscriber;

use CachetHQ\Cachet\Notifications\AbstractSubscriberNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;

class VerifySubscriptionNotification extends AbstractSubscriberNotification
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return string[]
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())
                    ->subject(trans('notifications.subscriber.verify.mail.subject'))
                    ->greeting(trans('notifications.subscriber.verify.mail.title', ['app_name' => setting('app_name')]))
                    ->action(trans('notifications.subscriber.verify.mail.action'), cachet_route('subscribe.verify', ['code' => $notifiable->verify_code]))
                    ->line(trans('notifications.subscriber.verify.mail.content', ['app_name' => setting('app_name')]));
    }
}
