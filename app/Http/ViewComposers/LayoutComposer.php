<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

/**
 * Class LayoutComposer
 * @package App\Http\ViewComposers\
 */
class LayoutComposer
{
    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $view->with([
            'unread_notifications' => Notification::with('comment.user')->where('user_id', Auth::user()->id)->whereNull('read_at')->count(),
        ]);
    }

}
