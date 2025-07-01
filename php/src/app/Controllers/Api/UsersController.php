<?php

namespace App\Controllers\Api;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class UsersController extends ResourceController {
     
    protected $request;
    protected $helpers = [];

    protected $select_fields = ['id', 'name', 'email', 'access_level', 'created_at', 'updated_at'];
    
    protected $userModel;

    public function __construct() {

        $this->userModel = new UserModel();
    }

    public function index() {

        $users = $this->userModel->select($this->select_fields)->findAll();

        $data = [];

        foreach($users as $user) {
            $data['users'][] = [
                "id" => $user->id,
                "name" => $user->name,
                "email" => $user->email,
                "access_level" => ($user->access_level == 1) ? 'Admin' : 'User',
                "created_at" => date('d/m/Y h:i:s', strtotime($user->created_at)),
                "updated_at" => date('d/m/Y h:i:s', strtotime($user->updated_at)),
            ];
        }

        // var_dump($data);exit;

        return view('main_view', $data);
    }

    public function create() {

        $post = (($this->request->getJSON()));

        if (!$this->validate($this->userModel->getValidationRules())) {            
            return $this->failValidationErrors($this->validator->getErrors());
        } else {

            try {

                $post->password = password_hash($post->password, PASSWORD_BCRYPT); 

                if (!$this->userModel->insert($post)) {                    
                    return $this->failServerError('Error on user creation');
                } else {
                    return $this->respondCreated(['status' => 200, 'message' => 'User Created successfuly']);
                }

            } catch (Exception $e) {                
                return $this->failServerError($e);
            }
        }

    }

    public function getAll() {

        $users = $this->userModel->select($this->select_fields)->findAll();

        if ($users) {
            return $this->respond(['status' => 200, 'message' => 'Users Found', 'data' => $users]);
        } else {
            return $this->failNotFound('Users not found');
        }
    }

    public function get($user_id = 0) {

        if ($user_id > 0) {
            
            $user = $this->userModel->select($this->select_fields)->find($user_id);

            if ($user) {
                return $this->respond(['status' => 200, 'message' => 'User Found', 'data' => $user]);
            } else {
                return $this->failNotFound('User not Found');
            }

        } else {
            return $this->respond(['status' => 400, 'message' => 'Invalid User ID'], 400);
        }

    }

    public function update($user_id = 0) {

        $post = (($this->request->getJSON()));

        if ($user_id > 0) {

            if (!$this->validate($this->userModel->getValidationRules())) {            
                return $this->failValidationErrors($this->validator->getErrors());
            } else {                

                $user = $this->userModel->find($user_id);

                try {

                    if ($user) {

                        if ($post->password) {                 
                            $post->password = password_hash($post->password, PASSWORD_BCRYPT); 
                        }                        

                        if (!$this->userModel->update($user_id, $post)) {                    
                            return $this->failServerError('Error on user update');
                        } else {
                            return $this->respondUpdated(['status' => 200, 'message' => 'User Updated successfuly']);
                        }

                    } else {
                        return $this->failNotFound('User not Found');
                    }

                } catch (Exception $e) {                
                    return $this->failServerError($e);
                }
            }

        } else {
            return $this->respond(['status' => 400, 'message' => 'Invalid User ID'], 400);
        }

    }

    public function delete($user_id = 0) {

        if ($user_id > 0) {

            $user = $this->userModel->find($user_id);

                try {

                    if ($user) {      

                        if (!$this->userModel->delete($user_id)) {                    
                            return $this->failServerError('Error on user deletion');
                        } else {
                            return $this->respondDeleted(['status' => 200, 'message' => 'User Deleted successfuly']);
                        }

                    } else {
                        return $this->failNotFound('User not Found');
                    }

                } catch (Exception $e) {                
                    return $this->failServerError($e);
                }

        } else {
            return $this->respond(['status' => 400, 'message' => 'Invalid User ID'], 400);
        }

    }

    public function login() {

        $post = $this->request->getJSON();

        $user = $this->userModel->where('email', $post->email)->first();

        if (!$user || !password_verify($post->password, $user->password)) {
            return $this->failUnauthorized('Invalid Credentials.');
        }

        if ($user->access_level == 2) { // If Access level is user level
            return $this->failUnauthorized('Access level not allowed.');
        }

        $token = generateJWT($user);

        return $this->respond([
            'message' => 'Logged in',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => getenv('JWT_EXPIRATION_TIME')
        ]);

    }

    public function logout() {

        $authHeader = $this->request->getHeaderLine('Authorization');
        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            return $this->fail('JWT Token not provided', 401);
        }

        $token = explode(' ', $authHeader)[1];
        $payload = validateJWT($token);

        if (!$payload) {
            return $this->fail('Invalid JWT Token', 401);
        }

        // Salva na blacklist (use seu próprio model)
        $db = \Config\Database::connect();
        $db->table('token_blacklist')->insert([
            'token' => $token,
            'expires_at' => date('Y-m-d H:i:s', $payload->exp)
        ]);

        return $this->respond(['message' => 'Logged out.']);
    }
    
}
