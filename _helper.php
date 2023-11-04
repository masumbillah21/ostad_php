<?php
class Helper{
    private $userFile;
    
    public function __construct()
    {
        $this->userFile = './data/users.json';
    }

    private function getDataFromJsonFile(){
        $users = file_exists($this->userFile) ? json_decode(file_get_contents($this->userFile), true) : [];
        return $users;
    }

    private function addData($users){
        file_put_contents($this->userFile, json_encode($users, JSON_PRETTY_PRINT));
    }

    private function isAdmin(string $email): bool
    {
        $users = $this->getDataFromJsonFile();

        if($users[$email]['role'] == 'admin'){
            return true;
        } else {
            return false;
        }
    }

    public function validateUsername(string $username): array
    {
        if(!empty(trim($username)) && trim($username) != null){

            if (!preg_match("/^[a-zA-Z-' ]*$/",$username)) {
                return array('status' => false,'message'=> 'Only letters and white space allowed ');
            }else{
                return array('status' => true, 'message'=> htmlspecialchars(trim($username)));
            }
        }else{
            return array('status' => false, 'message'=> "Username is empty.");
        }
        
    }

    public function validateEmail(string $email): array
    {
        if(!empty(trim($email)) && trim($email) != null){
            $users = $this->getDataFromJsonFile();
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return array("status" => false, "message"=> "Invalid email format");
            }elseif(isset($users[$email])){
                return array("status" => false, "message"=> "Email Already Exist.");
            }
            else{
                return array("status" => true, "message"=> htmlspecialchars(trim($email)));
            }
        }else{
            return array('status' => false, 'message'=> "Email is empty.");
        }
        
    }

    public function validatePassword(string $password): array
    {
        if(!empty(trim($password)) && trim($password) != null){
            if (strlen(trim($password)) < 8) {
                return array("status"=> false,"message"=> "Your Password Must Contain At Least 8 Characters!");
            }
            else if(!preg_match("#[0-9]+#", $password)) {
                return array("status"=> false,"message"=> "Your Password Must Contain At Least 1 Number!");
            }
            else if(!preg_match("#[A-Z]+#", $password)) {
                return array("status"=> false,"message"=> "Your Password Must Contain At Least 1 Capital Letter!");
            }
            else if(!preg_match("#[a-z]+#", $password)) {
                return array("status"=> false,"message"=> "Your Password Must Contain At Least 1 Lowercase Letter!");
            } else{
                return array("status" => true,"message"=> htmlspecialchars(trim($password)));
            }
        }else{
            return array('status' => false, 'message'=> "Password is empty.");
        }
        
    }

    public function signUp($username, $email, $password): array{
        if (!empty($username) && !empty($email) && !empty($password)) {
            $users = $this->getDataFromJsonFile();
            $users[$email] = [
                "username"=> $username,
                "password"=> password_hash($password, PASSWORD_DEFAULT),
                'role' => '',
            ];
            $this->addData($users);
            return array('status'=> true,'message'=> "Successfully Signed Up.");
        }else{
            return array('status'=> false,'message'=> "Something went wrong, Please try again later.");
        }
        
    }

    public function getAllUserData(): array
    {
        $userData = [];
        $users = $this->getDataFromJsonFile();
        foreach ($users as $email => $userInfo) {
            $userData[$email] = [
                "username" => $userInfo['username'],
                "role" => $userInfo['role']
            ];
        }

        return $userData;
    }

    public function getSingleUserData($email):array
    {
        $users = $this->getDataFromJsonFile();
        $userData = [];
        if (isset($users[$email])) {
            $userData = [
                'username' => $users[$email]['username'],
                'role' => $users[$email]['role'],
            ];
        }else{
            $userData = [];
        }

        
        return  $userData;
    }

    public function verifyLogin($email, $password): array{
        if (!empty($email) && !empty($password)) {
            $users = $this->getDataFromJsonFile();
            if (isset($users[$email])) {
                if(password_verify($password, $users[$email]['password'])){
                    unset($users[$email]['password']);
                    return array('status'=> true,'message'=> $users);
                }else{
                    return array('status'=> false,'message'=> 'Email and/or password did not match.');
                }
            }else{
                return array('status'=> false,'message'=> 'User not found.');
            }
        }else{
            return array('status'=> false,'message'=> 'All Fields Are Empty.');
        }
    }

    public function createNewUser($author, $username, $email, $password, $role): array{
        if (!empty($author) && !empty($username) && !empty($email) && !empty($password)) {
            if ($this->isAdmin($author)) {
                $users = $this->getDataFromJsonFile();
                $users[$email] = [
                    "username"=> $username,
                    "password"=> password_hash($password, PASSWORD_DEFAULT),
                    'role' => $role,
                ];
                $this->addData($users);
                return array('status'=> true,'message'=> "New User Successfully Added.");
            }else{
                return array('status'=> false,'message'=> "You don't have permission to do this action.");
            }
            
        }else{
            return array('status'=> false,'message'=> "Something went wrong, Please try again later.");
        }
        
    }

    public function updateUser($author, $email, $username,  $password, $role): array{
        if (!empty($author) && !empty($email) && !empty($username)) {
            if($this->isAdmin($author)){
                $users = $this->getDataFromJsonFile();
                if (isset($users[$email])) {
                    $users[$email]['username'] = $username;
                    if(!empty($password)){
                        $users[$email]['password'] = password_hash($password, PASSWORD_DEFAULT);
                    }
                    $users[$email]['role'] = $role;
                    $this->addData($users);
                    return array('status'=> true,'message'=> "User Successfully Updated.");
                }else{
                    return array('status'=> false,'message'=> "Invalid Request");
                }
            }else{
                return array('status'=> false,'message'=> "You don't have permission to do this action.");
            }
        }else{
            return array('status'=> false,'message'=> "Invalid Request");
        }
    }
    public function deleteUser($author, $email): array{
        if (!empty($email) && !empty($author)) {
            if($this->isAdmin($author)){
                $users = $this->getDataFromJsonFile();
                unset($users[$email]);
                file_put_contents($this->userFile, json_encode($users, JSON_PRETTY_PRINT));
                return array('status'=> true,'message'=> "User Successfully Deleted.");
            }else{
                return array('status'=> false,'message'=> "You don't have permission to do this action.");
            }
        }else{
            return array('status'=> false,'message'=> "Invalid Request");
        }
    }
}
