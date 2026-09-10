<?php

namespace App\Policies;

use App\Models\Produk;
use App\Models\User;

class ProdukPolicy
{
    /**
     * Create a new policy instance.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role->name, ['Admin', 'Kasir'], true);
    }

    public function view(User $user, Produk $produk): bool
    {
        return in_array($user->role->name, ['Admin', 'Kasir'], true);
    }

    public function create(User $user): bool
    {
        // Kasir dan Admin bisa tambah produk
        return in_array($user->role->name, ['Admin', 'Kasir'], true);
    }

    public function update(User $user, Produk $produk): bool
    {
        // Kasir dan Admin bisa edit produk
        return in_array($user->role->name, ['Admin', 'Kasir'], true);
    }

    public function delete(User $user, Produk $produk): bool
    {
        // Kasir dan Admin bisa hapus produk
        return in_array($user->role->name, ['Admin', 'Kasir'], true);
    }
}
