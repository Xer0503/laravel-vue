<script setup>
import AdminLayout from '../Layouts/AdminLayout.vue';
import { reactive, ref } from 'vue';
import { usePage, useForm } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';

const { users } = usePage().props;
const auth = usePage().props.auth.user;

const modalToggle = ref(false);

const selectedUser = reactive({
  id: null,
  name: '',
  email: ''
});

// Use Inertia form helper for update and delete
const form = useForm({
  name: '',
  email: '',
  password: ''
});

function passUser(user) {
  selectedUser.id = user.id;
  selectedUser.name = user.name;
  selectedUser.email = user.email;

  form.name = user.name;
  form.email = user.email;
  form.password = '';
}

function openModal() {
  modalToggle.value = true;
}

function closeModal() {
  modalToggle.value = false;
}

function del(id) {
  form.delete(`/admin/user/${id}`, {
    onSuccess: () => {
      Inertia.reload({ only: ['users'] });
    }
  });
}

function submit() {
  form.patch(`/admin/user/${selectedUser.id}`, {
    onSuccess: () => {
      closeModal();
      Inertia.reload({ only: ['users'] });
    }
  });
}

defineOptions({
  layout: AdminLayout
});
</script>

<template>
  <section class="relative overflow-hidden px-2">
    <table class="w-full text-center rounded shadow-md z-10">
      <thead class="bg-gray-600 text-white font-bold">
        <td>id</td>
        <td>name</td>
        <td>email</td>
        <td>role</td>
        <td>status</td>
        <td>action</td>
      </thead>
      <tbody>
        <tr
          v-for="user in users"
          :key="user.id"
          :class="{ 'bg-gray-200': user.id == auth.id }"
        >
          <td>{{ user.id }}</td>
          <td>{{ user.name }}</td>
          <td>{{ user.email }}</td>
          <td>{{ user.role }}</td>
          <td v-if="user.status" class="text-green-600">Active</td>
          <td v-else class="text-red-600">Inactive</td>
          <td class="space-x-2 py-2">
            <button
              @click="del(user.id)"
              class="bg-red-600 rounded-2xl px-3 py-1.5 text-white cursor-pointer"
            >
              Delete
            </button>
            <button
              @click="() => { passUser(user); openModal() }"
              class="bg-amber-400 rounded-2xl py-1.5 px-3 text-white cursor-pointer"
            >
              Edit
            </button>
          </td>
        </tr>
      </tbody>
    </table>
    <!-- Overlay -->
    <div
      v-if="modalToggle"
      class="fixed inset-0 z-15 bg-black/30 backdrop-blur-sm"
      @click="closeModal"
    ></div>

    <!-- Modal -->
    <div
      v-if="modalToggle"
      class="fixed z-20 inset-0 bg-gray-800 rounded-2xl text-white p-6 max-w-lg my-auto mx-auto h-[85vh] md:h-[65vh]"
      @click.stop
    >
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Edit User</h2>
        <button
          @click="closeModal"
          class="rounded-full bg-white/50 h-8 w-8 hover:bg-red-600 transition"
        >
          ×
        </button>
      </div>
      
      <form @submit.prevent="submit" class="flex flex-col space-y-4">
        <div>
          <label class="block mb-1" for="name">Name</label>
          <input
            id="name"
            type="text"
            v-model="form.name"
            class="w-full px-3 py-2 rounded text-gray-900 bg-gray-400"
            required
          />
        </div>

        <div>
          <label class="block mb-1" for="email">Email</label>
          <input
            id="email"
            type="email"
            v-model="form.email"
            class="w-full px-3 py-2 rounded text-gray-900 bg-gray-400"
            required
          />
        </div>

        <div>
          <label class="block mb-1" for="password">Password</label>
          <input
            id="password"
            type="password"
            v-model="form.password"
            class="w-full px-3 py-2 rounded text-gray-900 bg-gray-400"
            placeholder="Leave blank to keep unchanged"
          />
        </div>

        <button
          type="submit"
          class="bg-green-600 rounded-2xl py-2 px-3 text-white font-semibold mx-auto my-auto"
        >
          Update User
        </button>
      </form>
    </div>
  </section>
</template>
