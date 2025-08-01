<script setup>
    import { useForm, usePage  } from '@inertiajs/vue3'

    import { Link } from '@inertiajs/vue3'
    import { route } from 'ziggy-js'

    const flash = usePage().props.flash

    const form = useForm({
      email: '',
      password: ''
    })

    function submit() {
    form.post('/signin')
    }

</script>

<template>

    <div class="h-screen flex justify-center items-center">
      <div class="h-[80%] w-[40%] shadow-lg outline rounded-2xl px-20 py-3 flex flex-col">
          <div class="flex-flex-col mt-10">
            <span class="text-center">
              <h3 class="text-4xl">Sign In</h3>
              <p class="text-gray-700">Sign In to continue</p>
            </span>
          </div>

          <div v-if="flash">
            <p class="text-green-600 text-center">{{ flash.success }}</p>
          </div>

          <div class="flex flex-col justify-center h-full">

            <form @submit.prevent="submit">

              <div class="flex flex-col gap-y-15">                
                <div class="flex flex-col space-y-2.5">
                  <div class="flex space-x-3">
                    <div class="flex space-x-2">
                      <span v-if="form.errors.email" class="rounded-full px-2.5 bg-red-600 text-white">!</span>
                      <label>Email</label>
                    </div>
                    <input v-model="form.email" type="text" class="outline-0 w-[100%] font-semibold"/>
                  </div>
                  <div class="bg-gray-500 p-[0.5px]"></div>
                </div>
                <div class="flex flex-col space-y-2.5">
                  <div class="flex space-x-3">
                    <div class="flex space-x-2">
                      <span v-if="form.errors.password" class="rounded-full px-2.5 bg-red-600 text-white">!</span>
                      <label>Password</label>
                    </div>
                    <input v-model="form.password" type="text" class="outline-0 w-[100%] font-semibold"/>
                  </div>
                  <div class="bg-gray-500 p-[0.5px]"></div>
                </div>
            
                <button type="submit" :disabled="form.processing" 
                class="bg-blue-600 py-2 rounded text-white hover:bg-blue-900 transition-colors duration-400"
                >Sign In</button>

                <div class="text-center">
                  <p>Doesn't have an account? <span>
                    <Link :href="route('signup')" class="text-blue-500 hover:underline">Signup</Link>
                    </span>
                  </p>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

</template>