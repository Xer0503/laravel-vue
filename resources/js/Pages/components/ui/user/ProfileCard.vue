<script setup>
    import { usePage,useForm } from '@inertiajs/vue3';
    import OwnPost from './OwnPost.vue';
    import { ref } from 'vue';
    import { Inertia } from '@inertiajs/inertia';
    const modal = ref(false)

    const viewModal = () => {
        modal.value = true; 
    }
    const closeModal = () => {
        modal.value = false;
    }

    const form = useForm({
        image : null,
    })

    function handleFileUpload(e) {
        form.image = e.target.files[0];
    }

    function submit() {
        form.post('/profile/changeProfile', {
            forceFormData: true,
            onSuccess: () => {
                closeModal();
                Inertia.reload({
                preserveScroll: true,
                only: ['auth']
                });
            }
        });
    }

    const auth = usePage().props.auth.user 
</script>

<template>
    <div class="relative h-screen">
        <section class="flex flex-col z-10">
            <div>
                <img :src="`storage/${auth.image}`" loading="lazy" :alt=auth.image class="w-1/2 rounded-full mx-auto" />
            </div>
            <div class="mx-auto mt-5">
                <span class="font-bold text-3xl">{{ auth.name }}</span>
            </div>
            <div @click="viewModal" class="mx-auto cursor-pointer mb-5">
                <a href="#top">chnage profile</a>
            </div>
        </section>
    
        <div class="py-[0.5px] bg-gray-200 z-20"></div>
    
        <!--Your Post-->
        <section class="z-10">
            <OwnPost />
        </section>
        
        <!--Overlay-->
        <div v-if="modal" class="z-15 inset-0 backdrop-blur-sm fixed"></div>
        <!--File Upload Modal-->
        <div v-if="modal" class="z-20 absolute inset-0">
            <div class="flex justify-center">
                <form @submit.prevent="submit" >
                    <input type="file" 
                    @change="handleFileUpload"
                    class="bg-gray-300 px-2 py-2 text-black rounded-l-2xl cursor-pointer w-[50%]"/>
                    <button @click="closeModal" class="py-2 px-2 bg-red-600 text-white cursor-pointer">close</button>
                    <button type="submit" :disabled="form.processing" class="bg-blue-600 px-2 py-2 rounded-r-2xl shadow text-white cursor-pointer"
                    >Change Profile</button>
                </form>
            </div>
        </div>
    </div>

    
</template>