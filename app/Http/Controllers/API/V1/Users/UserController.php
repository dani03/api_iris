<?php

namespace App\Http\Controllers\API\V1\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Services\Users\UserService;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function __construct(private readonly UserService $userService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->userService->getAllUsers();
        return response()->json(UserResource::collection($users), Response::HTTP_OK);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = $this->userService->getUser($id);
        if($user) {
            return response()->json(new UserResource($user), Response::HTTP_OK);
        }
        return \response()->json(['message' => 'cet utilisateur n\'existe pas.'], Response::HTTP_NOT_FOUND);


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //recuperation du user
        $user = $this->userService->getUser($id);
        if(!$user) {
            return \response()->json(['message' => 'cet utilisateur n\'existe pas.'], Response::HTTP_NOT_FOUND);
        }
        $datas = $request->all();
        $this->userService->updateUserNameAndEmail($user, $datas);
        if($user->wasChanged()) {
            return \response()->json(['message' => 'utilisateur mis à jour.'], Response::HTTP_OK);

        }

        return \response()->json(['message' => 'aucune mise à jour faites.'], Response::HTTP_OK);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       if(User::destroy($id)) {
        return \response()->json(['message' => 'utilisateur supprimé.'], Response::HTTP_NO_CONTENT);

       }
        return \response()->json(['message' => 'impossible de supprimer une erreur est survenue.'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
