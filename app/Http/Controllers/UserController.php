<?php

namespace App\Http\Controllers;

use App\Factories\ViewFactory\UserCreateViewFactory\UserCreateViewFactory;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\LayoutMessageService;
use Faker\Generator;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct(private LayoutMessageService $layoutMessageService) {}
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $users = User::accordingToRolePermission()
            ->with('role')
            ->paginate(10)
            ->withQueryString();

        return view('pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param UserCreateViewFactory $userCreateViewFactory
     * @return View
     */
    public function create(UserCreateViewFactory $userCreateViewFactory): View
    {
        return $userCreateViewFactory->make();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserStoreRequest $request
     * @param Generator $generator
     * @return RedirectResponse
     */
    public function store(UserStoreRequest $request, Generator $generator): RedirectResponse
    {
        $password = empty($request->password) ? $generator->password() : $request->password;

        $userData = array_merge(
            $request->all(['name', 'email', 'cpf', 'role_id']),
            ['password' => Hash::make($password)]
        );

        $addressData = $request->all(
            ['cep', 'street', 'neighborhood', 'city', 'state', 'address_number', 'complement']
        );

        DB::transaction(function () use ($userData, $addressData, $request) {
            /** @var User $user */
            $user = User::create($userData);
            $user->address()->create($addressData);

            $request->whenFilled(
                'customer_address_id',
                fn ($customerAddressId) => $user->customerAddresses()->attach($customerAddressId),
            );

            $user->dispatchRegistered(!empty($request->password));
        });

        $this->layoutMessageService->flashSuccessMessage();
        return redirect(route('usuarios.index'));
    }

    public function edit(User $user): View|RedirectResponse
    {
        try {
            $roles = Role::getRolesAvailableToChanges($user);
            return view('pages.users.edit', compact('user', 'roles'));
        } catch (\Exception $e) {
            logger()->error($e->getMessage(), ['Edit User View', $e]);
            $this->layoutMessageService->flashErrorMessage();
            return redirect(route('usuarios.index'));
        }
    }

    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        $userData = $request->all(['name', 'cpf', 'role_id']);
        $request->whenFilled('password', fn($password) => $userData['password'] = Hash::make($password));

        $addressData = $request->all(['cep', 'street', 'neighborhood', 'city', 'state', 'address_number', 'complement']);

        DB::transaction(function () use ($user, $userData, $addressData) {
            $user->update($userData);
            $user->address()->update($addressData);
        });

        $this->layoutMessageService->flashSuccessMessage();
        return redirect(route('usuarios.index'));
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->isAdministrator() && User::where('role_id', $user->role_id)->count() === 1) {
            $this->layoutMessageService->flashErrorMessage('É necessário ter pelo menos 1 usuário com função Administrador');
            return redirect(route('usuarios.index'));
        }

        if ($user->id === Auth::user()->id) {
            $this->layoutMessageService->flashErrorMessage('Não é possível remover o usuário logado.');
            return redirect(route('usuarios.index'));
        }

        $user->delete();

        $this->layoutMessageService->flashSuccessMessage();
        return redirect(route('usuarios.index'));
    }
}
