<?php
namespace Codiant\Agora;

class RtcTokenBuilder
{
    public const ROLE_ATTENDEE = 0;
    public const ROLE_PUBLISHER = 1;
    public const ROLE_SUBSCRIBER = 2;
    public const ROLE_ADMIN = 101;
    
    /**
     * Method buildTokenWithUid
     *
     * @return mixed
     */
    public function buildTokenWithUid(
        $appID,
        $appCertificate,
        $channelName,
        $uid,
        $role,
        $privilegeExpireTs
    ) {
        return self::buildTokenWithUserAccount($appID, $appCertificate, $channelName, $uid, $role, $privilegeExpireTs);
    }

        
    /**
     * Method buildTokenWithUserAccount
     *
     * @return void
     */
    public static function buildTokenWithUserAccount(
        $appID,
        $appCertificate,
        $channelName,
        $userAccount,
        $role,
        $privilegeExpireTs
    ) {
        $token = AccessToken::init($appID, $appCertificate, $channelName, $userAccount);
        $Privileges = AccessToken::PRIVILIGES;

        $token->addPrivilege($Privileges["kJoinChannel"], $privilegeExpireTs);

        if (($role == self::ROLE_ATTENDEE)
            ||($role == RtcTokenBuilder::ROLE_PUBLISHER)
            ||($role == RtcTokenBuilder::ROLE_ADMIN)
        ) {
            $token->addPrivilege(
                $Privileges["kPublishVideoStream"],
                $privilegeExpireTs
            );
            $token->addPrivilege(
                $Privileges["kPublishAudioStream"],
                $privilegeExpireTs
            );
            $token->addPrivilege(
                $Privileges["kPublishDataStream"],
                $privilegeExpireTs
            );
        }
        return $token->build();
    }
    
    /**
     * Method buildTokenWithUidAndPrivilege
     *
     * @return void
     */
    public static function buildTokenWithUidAndPrivilege(
        $appID,
        $appCertificate,
        $channelName,
        $uid,
        $joinChannelPrivilegeExpiredTs,
        $pubAudioPrivilegeExpiredTs,
        $pubVideoPrivilegeExpiredTs,
        $pubDataStreamPrivilegeExpiredTs
    ) {
        return self::buildTokenWithUserAccountAndPrivilege(
            $appID,
            $appCertificate,
            $channelName,
            $uid,
            $joinChannelPrivilegeExpiredTs,
            $pubAudioPrivilegeExpiredTs,
            $pubVideoPrivilegeExpiredTs,
            $pubDataStreamPrivilegeExpiredTs
        );
    }
    
    /**
     * Method buildTokenWithUserAccountAndPrivilege
     *
     * @return void
     */
    public static function buildTokenWithUserAccountAndPrivilege(
        $appID,
        $appCertificate,
        $channelName,
        $userAccount,
        $joinChannelPrivilegeExpiredTs,
        $pubAudioPrivilegeExpiredTs,
        $pubVideoPrivilegeExpiredTs,
        $pubDataStreamPrivilegeExpiredTs
    ) {
        $token = AccessToken::init(
            $appID, $appCertificate, $channelName, $userAccount
        );
        $Privileges = AccessToken::PRIVILIGES;
        $token->addPrivilege(
            $Privileges["kJoinChannel"], 
            $joinChannelPrivilegeExpiredTs
        );
        $token->addPrivilege(
            $Privileges["kPublishAudioStream"],
            $pubAudioPrivilegeExpiredTs
        );
        $token->addPrivilege(
            $Privileges["kPublishVideoStream"],
            $pubVideoPrivilegeExpiredTs
        );
        $token->addPrivilege(
            $Privileges["kPublishDataStream"],
            $pubDataStreamPrivilegeExpiredTs
        );
        return $token->build();
    }
}


?>