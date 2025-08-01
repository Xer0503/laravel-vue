<script setup>
    import { useForm } from '@inertiajs/vue3'
    import { route } from 'ziggy-js'
    import { Link } from '@inertiajs/vue3'
    

    const form = useForm({
      name: '',
      email: '',
      password: ''
    })

    function submit() {
      form.post('/signup')
    }

</script>

<template>

    <div class="h-screen flex justify-center items-center">
      <div class="h-[80%] w-[40%] shadow-lg outline rounded-2xl px-20 py-3 flex flex-col">
          <div class="flex-flex-col mt-10">
            <span class="text-center">
              <h3 class="text-4xl">Sign Up</h3>
              <p class="text-gray-700">Sign up to continue</p>
            </span>
          </div>

          <div class="flex flex-col justify-center h-full">

            <form @submit.prevent="submit">

              <div class="flex flex-col gap-y-12">
                <div class="flex flex-col space-y-2.5">
                  <div class="flex space-x-3">
                    <label>Name</label>
                    <input v-model="form.name" type="text" class="outline-0 w-[100%] font-semibold"
                    :class="{'outline-1 outline-red-600' : form.errors.name}"
                    />
                    <div v-if="form.errors.name">{{ form.errors.name }}</div>
                  </div>
                  <div class="bg-gray-500 p-[0.5px]"></div>
                </div>
                
                <div class="flex flex-col space-y-2.5">
                  <div class="flex space-x-3">
                    <label>Email</label>
                    <input v-model="form.email" type="text" class="outline-0 w-[100%] font-semibold" 
                    :class="{'outline-1 outline-red-600' : form.errors.email}"
                    />
                    <div v-if="form.errors.email">{{ form.errors.email }}</div>
                  </div>
                  <div class="bg-gray-500 p-[0.5px]"></div>
                </div>
  
                <div class="flex flex-col space-y-2.5">
                  <div class="flex space-x-3">
                    <label>Password</label>
                    <input v-model="form.password" type="text" class="outline-0 w-[100%] font-semibold" 
                    :class="{'outline-1 outline-red-600' : form.errors.password}"/>
                    <div v-if="form.errors.password">{{ form.errors.password }}</div>
                  </div>
                  <div class="bg-gray-500 p-[0.5px]"></div>
                </div>
            
                <button type="submit" :disabled="form.processing" 
                class="bg-blue-600 py-2 rounded text-white hover:bg-blue-800 transition-colors duration-400"
                >Sign up</button>

                <div class="text-center">
                  <p>Already have an account? <span>
                    <Link :href="route('signin')" class="text-blue-500">Signin</Link>
                    </span>
                  </p>
                </div>

              </div>
            </form>
          </div>
        </div>
      </div>

</template>