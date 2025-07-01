<?php

namespace App\Controllers\Api;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class UsersController extends ResourceController {
     
    protected $request;
    protected $helpers = [];

    protected $select_fields = ['id', 'name', 'email', 'access_level'];
    
    protected $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
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
            return $this->respond(['status' => false, 'message' => 'Invalid User ID'], 400);
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
            return $this->respond(['status' => false, 'message' => 'Invalid User ID'], 400);
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
            return $this->respond(['status' => false, 'message' => 'Invalid User ID'], 400);
        }

    }
    
}
