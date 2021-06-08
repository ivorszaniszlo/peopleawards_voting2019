<?php

/**
 * Do a query from active directory and check the login data
 * @param string $username
 * @param string $password
 * @return mixed
 */
function checkLoginDataInActiveDirectory($username = NULL, $password = NULL){

    // username or password can't be empty
    if(empty($username) || empty($password)){
        return NULL;
    }

    // details of the connection
    $adServer = 'ldap://bp-dc1.as.local';
    $ldap = ldap_connect($adServer);
    $ldaprdn = 'as' . '\\' . $username;

    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

    $bind = @ldap_bind($ldap, $ldaprdn, $password);

    if ($bind) {
        $filter="(sAMAccountName=$username)";
        $result = ldap_search($ldap,'dc=as,dc=local',$filter);

        ldap_sort($ldap,$result,'sn');
        $info = ldap_get_entries($ldap, $result);

        for ($i=0; $i<$info['count']; $i++){
            if($info['count'] > 1) break;

            $data = [];
            $data['fullname'] = $info[$i]['givenname'][0] . ' ' . $info[$i]['sn'][0];
            $data['firstname'] = $info[$i]['sn'][0];
            $data['lastname'] = $info[$i]['givenname'][0];
            $data['email'] = $info[$i]['mail'][0];
            $data['company'] = $info[$i]['company'][0];
            $data['permission'] = [];
            $data['permission']['write'] = NULL;
            $data['permission']['read'] = NULL;

            // check the group
            foreach($info[$i]['memberof'] AS $group){
                $groupDetail = explode(',', $group);

                if($groupDetail[0] == 'CN=Rejtveny_RW'){
                    $data['permission']['read'] = TRUE;
                    $data['permission']['write'] = TRUE;
                }

                if($groupDetail[0] == 'CN=Rejtveny_R'){
                    $data['permission']['read'] = TRUE;
                }

            }
        }
        print_r($data);

        @ldap_close($ldap);

    } else {
        $data = NULL;
    }

    return $data;
}