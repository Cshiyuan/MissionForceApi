<?php

/**
 * Created by PhpStorm.
 * User: Shyuan
 * Date: 2016/10/12
 * Time: 17:30
 */
class Api_User extends PhalApi_Api
{


    public function getBaseInfo()
    {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());

        //echo $this->username;
        // echo $this->test;

        $domain = new Domain_User();
        $info = $domain->getBaseInfo($this->userid);

        if (empty($info)) {
            DI()->logger->debug('user not found', $this->userid);

            $rs['code'] = 1;
            $rs['msg'] = T('user not exists');
            return $rs;
        }

        $rs['info'] = $info;
        //$rs['info']['username11'] = $this->username;

        return $rs;
    }

    /**
     * 通过相应的信息进行注册
     * @desc 通过相应的信息进行注册
     */
    public function registerUser()
    {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());  //初始化$rs
        $domain = new Domain_User();
        $result = $domain->registerUser($this->username, $this->password, $this->email); //交由domain注册并返回注册信息

        $rs['code'] = $result['code'];
        $rs['msg'] = $result['msg'];
        $rs['info'] = $result['info'];
        return $rs;

    }


    /**
     * 通过邮箱和密码进行登陆认证
     * @desc 通过邮箱和密码进行登陆认证
     */
    public function loginUser()
    {
        $rs = array('code' => 0, 'msg' => '', 'info' => array());  //初始化$rs
        $domain = new Domain_User();
        $result = $domain->loginUser($this->email, $this->password); //交由domain注册并返回注册信息

        $rs['code'] = $result['code'];
        $rs['msg'] = $result['msg'];
        $rs['info'] = $result['info'];
        return $rs;
    }


    public function getRules()
    {
        return array(
            'getBaseInfo' => array(
                'userid' => array('name' => 'userid', 'type' => 'int', 'min' => 1, 'require' => true),
                //  'username' => array('name' => 'username'),
            ),

            'registerUser' => array(
                'username' => array('name' => 'username','require' => true),
                'password' => array('name' => 'password','require' => true),
                'email' => array('name' => 'email','require' => true),
            ),

            'loginUser' => array(
                'email' => array('name' => 'email','require' => true),
                'password' => array('name' => 'password','require' => true),
            ),
        );
    }


}