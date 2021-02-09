<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Arr;
use Revolution\Line\Notifications\LineNotifyChannel;
use Revolution\Line\Notifications\LineNotifyMessage;
use Revolution\Ordering\Contracts\Payment\PaymentMethodFactory;

class OrderEntryNotification extends Notification
{
    use Queueable;

    /**
     * 詳細を含む商品データ.
     *
     * @var array|null
     */
    public ?array $items;

    /**
     * テーブル番号.
     *
     * @var string|null
     */
    public ?string $table;

    /**
     * 追加メモ.
     *
     * @var string|null
     */
    public ?string $memo;

    /**
     * オプションデータ.
     *
     * @var array|null
     */
    public ?array $options;

    /**
     * Create a new notification instance.
     *
     * @param  array|null  $items
     * @param  string|null  $table
     * @param  string|null  $memo
     * @param  array|null  $options
     */
    public function __construct(?array $items, ?string $table, ?string $memo, ?array $options)
    {
        $this->items = $items;
        $this->table = $table;
        $this->memo = $memo;
        $this->options = $options;
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
        $payment = app(PaymentMethodFactory::class)
            ->name(Arr::get($this->options, 'payment', 'cash'));

        $items = collect($this->items)
            ->map(fn ($item) => '【'.Arr::get($item, 'name').'】('.Arr::get($item, 'price').'円)')
            ->implode(PHP_EOL);

        $message = collect([
            '',
            '◆テーブル：'.$this->table,
            '◆メモ：'.$this->memo,
            '◆合計：'.collect($this->items)->sum('price').'円',
            '◆支払い方法：'.$payment,
            '◆注文◆'.PHP_EOL.$items,
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
