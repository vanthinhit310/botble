<?php
/**
 * Created by PhpStorm.
 * User: vanth
 * Date: 6/8/2019
 * Time: 11:58 PM
 */

namespace Botble\Member\Repositories\Eloquent;


use Botble\Member\Models\Member;
use Botble\Member\Repositories\Interfaces\SocialInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Contracts\User as ProviderUser;
use Laravolt\Avatar\Avatar;
use PragmaRX\Random\Random;

class SocialRepositories implements SocialInterface
{
    public function getOrCreateMember(ProviderUser $user)
    {
        $member = Member::whereProvider('facebook')
            ->where('facebook_id', $user->getId())
            ->first();
        $random = new Random();
        $avatar = new Avatar();
        try {
            if ($member && $member != null) {
                return $member;
            } else {
                DB::beginTransaction();
                $member = new Member([
                    'facebook_id' => $user->getId() ?? $random->numeric()->size(20)->get(),
                    'provider' => 'facebook',
                    'email' => $user->getEmail() ?? 'email@example.com',
                    'first_name' => $user->getName() ?? 'Facebook user',
                    'social_avatar' => $user->getAvatar() ?? $avatar->create($user->getName()),
                    'password' => Hash::make('Guest@123')
                ]);
                $member->save();
                DB::commit();
                return $member;
            }
        }catch (\Throwable $th){
            dd($th->getMessage());
            DB::rollBack();
            throw new \Exception($th->getMessage());
        }
    }
}