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
        if (!preg_match("/^[a-zA-Z-' ]*$/",$username)) {
            return array('status' => false,'message'=> 'Only letters and white space allowed ');
        }else{
            return array('status' => true, 'message'=> $username);
        }
    }

    public function validateEmail(string $email): array
    {
        $users = $this->getDataFromJsonFile();
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return array("status" => false, "message"=> "Invalid email format");
        }elseif(isset($users[$email])){
            return array("status" => false, "message"=> "Email Already Exist.");
        }
        else{
            return array("status" => true, "message"=> $email);
        }
    }

    public function validatePassword(string $password): array
    {
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
            return array("status" => true,"message"=> $password);
        }
    }

    public function saveUsers($username, $email, $password): array{
        if (!empty($username) && !empty($email) && !empty($password)) {
            $users = $this->getDataFromJsonFile();
            $users[$email] = [
                "username"=> $username,
                "password"=> password_hash($password, PASSWORD_DEFAULT),
                'role' => '',
            ];
            file_put_contents($this->userFile, json_encode($users, JSON_PRETTY_PRINT));
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

    public function updateRole($author, $email, $role): array{
        if (!empty($email) && !empty($role) && !empty($author)) {
            if($this->isAdmin($author)){
                $users = $this->getDataFromJsonFile();
                $users[$email]['role'] = $role;
                file_put_contents($this->userFile, json_encode($users, JSON_PRETTY_PRINT));
                return array('status'=> true,'message'=> "Role Successfully Updated.");
            }else{
                return array('status'=> false,'message'=> "You don't have permission to do this action.");
            }
        }else{
            return array('status'=> false,'message'=> "Invalid Request");
        }
    }
    public function deleteRole($author, $email): array{
        if (!empty($email) && !empty($author)) {
            if($this->isAdmin($author)){
                $users = $this->getDataFromJsonFile();
                $users[$email]['role'] = '';
                file_put_contents($this->userFile, json_encode($users, JSON_PRETTY_PRINT));
                return array('status'=> true,'message'=> "Role Successfully Deleted.");
            }else{
                return array('status'=> false,'message'=> "You don't have permission to do this action.");
            }
        }else{
            return array('status'=> false,'message'=> "Invalid Request");
        }
    }
}
