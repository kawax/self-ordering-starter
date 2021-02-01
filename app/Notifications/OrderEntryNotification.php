<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Arr;
use Revolution\Line\Notifications\LineNotifyChannel;
use Revolution\Line\Notifications\LineNotifyMessage;

class OrderEntryNotification extends Notification
{
    use Queueable;

    /**
     * @var array
     */
    public $items;

    public $table;

    public $memo;

    /**
     * Create a new notification instance.
     *
     * @param $items
     * @param $table
     * @param $memo
     */
    public function __construct($items, $table, $memo)
    {
        $this->items = $items;
        $this->table = $table;
        $this->memo = $memo;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return [
            //'mail',
            LineNotifyChannel::class,
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * @param  mixed  $notifiable
     *
     * @return LineNotifyMessage
     */
    public function toLineNotify($notifiable)
    {
        $message = collect([
            '',
            '◆テーブル：'.$this->table,
            '◆メモ：'.$this->memo,
            '◆合計：'.collect($this->items)->sum('price').'円',
            '◆注文◆'.PHP_EOL.collect($this->items)
                ->map(fn ($item) => '【'.Arr::get($item, 'name').'】('.Arr::get($item, 'price').'円)')
                ->implode(PHP_EOL),
        ])->implode(PHP_EOL.PHP_EOL);

        return LineNotifyMessage::create($message);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
