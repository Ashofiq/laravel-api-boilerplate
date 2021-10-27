<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserInterface;
use App\Repositories\User\UserTypes\UserTypeInterface;
use Hash;
use App\Helper\RespondsWithHttpStatus;
use Helper;
use App\Models\User;
use App\Models\UserTypes\UserTypes;

/**
 * Class AuthController
 *
 * @author Ahmad shafik <ahmadshofiq3@gmail.com>
 *//**
 */
class AuthController extends Controller
{   
    use RespondsWithHttpStatus;
    private $user;
    private $userType;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(UserInterface $user, UserTypeInterface $userType)
    {   
        $this->user = $user;
        $this->userType = $userType;
        $this->middleware('auth:api', ['except' => ['login', 'reg', 'me']]);
    }

     /** @OA\Info(title="DoyalBaba ecommerce", version="1.0") */


    /**
     * Doyalbaba login
     * 
     * @OA\Post(
     *     path="/api/auth/v1/login",
     *     tags={"Auth"},
     *     @OA\Response(
     *         response=201,
     *         description="success"
     *     ),
    * @OA\RequestBody(
    *    required=true,
    *    description="Pass user credentials",
    *    @OA\JsonContent(
    *       required={"email","password"},
    *       @OA\Property(property="email", type="string", format="email", example="user1@mail.com"),
    *       @OA\Property(property="password", type="string", format="password", example="PassWord12345"),
    *    ),
    * ),
     *   
     *     
     * )
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return $this->failure("Wrong email Or password", 401);
        }

        return $this->success('success', $this->respondWithToken($token));
    }

    /**
     * Doyalbaba Registration
     * 
     * @OA\Post(
     *     path="/api/auth/v1/registration",
     *     tags={"Auth"},
     *     @OA\Response(
     *         response=201,
     *         description="success"
     *     ),
     *   @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Enter Name",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *      @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="Enter Email",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *      @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="Enter Password",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *      @OA\Parameter(
     *         name="type",
     *         in="query",
     *         description="Enter user type",
     *         required=true,
     *         @OA\Schema(
     *             type="array",
     *             default="customer",
     *             @OA\Items(
     *                 type="string",
     *                 enum = {"customer", "vendor", "admin"},
     *             )
     *         )
     *     ),
     *     
     * )
     */

    public function reg(Request $request)
    {   
        // check user valid type
        $type_array =array(null, User::VENDOR, User::ADMIN, User::CUSTOMER);
        if(!array_search($request->type, $type_array)){
            return $this->failure('Type not match, please enter valid type');
        }

        if(!$this->user->checkUserWithEmail($request->email)){
            return $this->failure('Email Already Axist');
        }
        
        $data = array(
            'name' =>  Helper::removeDanger($request->name),
            'email' => Helper::removeDanger($request->email),
            'password' => Helper::makeHash($request->password)
        );

        $final = $this->user->reg($data);
 
        if($final){
            $createUserType = $this->createUserType($final->id, $request->type);

            if($createUserType){
                return $this->success('success', $final);
            }else{
                // delete this user 
            } 
        }
        
    }

    /**
     * Create User Type
     *
     * @return UserTypes
     */
    public function createUserType($userId, $type){

        $userTypeData = array(
            'user_id' => $userId,
            'type' => $type,
            'status' => UserTypes::ACTIVE
        );
        return $this->userType->addType($userTypeData);
    }

     /**
     * Auth Check
     * 
     * @OA\Get(
     *     path="/api/v1/me",
     *     tags={"Auth"},
     *     @OA\Response(
     *         response=201,
     *         description="success"
     *     ),
     *   security={{"bearer_token":{}}}
     *     
     * )
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
