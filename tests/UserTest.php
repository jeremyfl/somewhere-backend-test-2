<?php
class UserTest extends TestCase
{
    public function testUserRegister()
    {
        $this->post('/register', ['name' => 'Sally', 'email' => 'sally@gmail.com', 'password', 'sally'])
            ->seeJsonEquals([
                'status' => "success",
                'user_id' => 1,
            ]);
    }
}
