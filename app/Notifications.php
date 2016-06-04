<?php

namespace App;

use Mail;
use App\User;
use App\Discussion;

class Notifications
{
    /**
     * Starting method.
     */
    public static function send() {
        self::notifyUsers();
    }
    
    /**
     * Notifications driver.
     */
    private static function notifyUsers() {
        $users = User::all();
        
        foreach ($users as $user)
        {
            if (time() > self::getNextNotification($user))
            {
                // get discussions with activity
                $discussions = self::getDiscussions($user);
                $activeDiscussions = self::getActiveDiscussions($user, $discussions);
                
                // send notifications
                if (! empty($activeDiscussions))
                {
                    self::sendNotification($user, $activeDiscussions);
                }
                
                // update database
                // $user->last_notified = date('Y-m-d H:i:s', time());
                // $user->save();
            }
        }
    }
    
    /**
     * Get the next notification timestamp for a user
     * 
     * @param  User $user
     * @return Time
     */
    private static function getNextNotification(User $user) {
        // convert frequency to usable format
        switch ($user->notify_frequency) {
            case 'weekly':
                $frequency = '+1 minute';
                break;
            case 'monthly':
                $frequency = '+1 month';
                break;
        }
        
        // get next notification date
        $lastNotification = strtotime($user->last_notified);
        $nextNotification =  strtotime($frequency, $lastNotification);
        
        return $nextNotification;
    }
    
    /**
     * Returns an array of discussions associated with a user
     * 
     * @param  User $user
     * @return array
     */
    private static function getDiscussions(User $user) 
    {
        $userDiscussions = array();
        
        $discussions = Discussion::all();
        
        foreach ($discussions as $discussion)
        {
            if ($discussion->org_id == null) // non-org discussions
            {
                // user's discussion
                if ($discussion->user_id == $user->id)
                {
                    $userDiscussions[] = $discussion;
                }
                // non-org discussions user has contributed to
                elseif ($discussion->comments->where('user_id', $user->id)->first() != null)
                {
                    $userDiscussions[] = $discussion;
                }
            }
            else // org discussions
            {
                // user's organisations
                if ($discussion->org->users->where('id', $user->id)->first() != null)
                {
                    $userDiscussions[] = $discussion;
                }
                // org discussions user has contributed to
                elseif ($discussion->comments->where('user_id', $user->id)->first() != null)
                {
                    $userDiscussions[] = $discussion;
                }  
            }
        }
        
        return $userDiscussions;
    }
    
    /**
     * Get discussions with new comments.
     * 
     * @param  User $user
     * @param  array $discussions
     * @return array
     */
    private static function getActiveDiscussions(User $user, $discussions) 
    {
        $activeDiscussions = array();
        
        foreach ($discussions as $discussion)
        {
            $count = $discussion->comments()->where([
                ['created_at', '>=', $user->last_notified],
                ['user_id', '!=', $user->id]
            ])->count();
            
            if ($count > 0)
            {
                $discussion->newComments = $count;
                $activeDiscussions[] = $discussion;
            }
        }
        
        return $activeDiscussions;
    }
    
    /**
     * Send the emails.
     * 
     * @param  User $user
     * @param  array $discussions
     */
    private static function sendNotification(User $user, $discussions) {
        Mail::send('emails.notification', ['user' => $user, 'discussions' => $discussions], function ($m) use ($user) {
            $m->from('techtalk@advisian.com', 'Tech Talk');
            $m->to($user->email, $user->name)->subject('Test Email!');
        });
    }
}