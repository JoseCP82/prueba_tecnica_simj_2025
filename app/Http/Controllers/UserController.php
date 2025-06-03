<?php

namespace App\Http\Controllers;

use App\Contracts\JsonResponseInterface;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
 
    /**
     * Inject UserService and JsonResponseInterface via constructor.
     */
    public function __construct(
        private readonly UserService $userService, 
        private readonly JsonResponseInterface $apiResponse
    ) {}

    /**
     * Display a listing of users.
     * GET /users
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $users = $this->userService->getAllUsers();
            return $this->apiResponse->success($users, 'Users retrieved successfully');
        } catch (\Throwable $e) {
            Log::error('Error fetching users: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
            return $this->apiResponse->error('Failed to retrieve users', 500);
        }
    }

    /**
     * Store a newly created user.
     * POST /users
     *
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function store(UserRequest $request): JsonResponse
    {
        try {
            $payload = array_merge($request->validated(), [
                'is_admin' => $request->has('is_admin'),
            ]);

            $user = $this->userService->createUser($payload);

            return $this->apiResponse->success($user, 'User created successfully', 201);
        } catch (\Throwable $e) {
            Log::error('Error creating user: ' . $e->getMessage(), [
                'input' => $request->all(),
                'trace' => $e->getTraceAsString(),
            ]);
            return $this->apiResponse->error('Failed to create user', 500);
        }
    }

    /**
     * Display the specified user.
     * GET /users/{user}
     *
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        try {
            return $this->apiResponse->success($user, 'User retrieved successfully');
        } catch (\Throwable $e) {
            Log::error('Error fetching user: ' . $e->getMessage(), [
                'user_id' => $user->id,
                'trace'   => $e->getTraceAsString(),
            ]);
            return $this->apiResponse->error('Failed to retrieve user', 500);
        }
    }

    /**
     * Update the specified user.
     * PUT/PATCH /users/{user}
     *
     * @param UserRequest $request
     * @param User        $user
     * @return JsonResponse
     */
    public function update(UserRequest $request, User $user): JsonResponse
    {
        try {
            $payload = array_merge($request->validated(), [
                'is_admin' => $request->has('is_admin'),
            ]);

            $updatedUser = $this->userService->updateUser($user, $payload);

            return $this->apiResponse->success($updatedUser, 'User updated successfully');
        } catch (\Throwable $e) {
            Log::error('Error updating user: ' . $e->getMessage(), [
                'user_id' => $user->id,
                'input'   => $request->all(),
                'trace'   => $e->getTraceAsString(),
            ]);
            return $this->apiResponse->error('Failed to update user', 500);
        }
    }

    /**
     * Remove the specified user from storage.
     * DELETE /users/{user}
     *
     * @param User $user
     * @return JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        try {
            $this->userService->deleteUser($user);
            return $this->apiResponse->success(null, 'User deleted successfully', 204);
        } catch (\Throwable $e) {
            Log::error('Error deleting user: ' . $e->getMessage(), [
                'user_id' => $user->id,
                'trace'   => $e->getTraceAsString(),
            ]);
            return $this->apiResponse->error('Failed to delete user', 500);
        }
    }
}
