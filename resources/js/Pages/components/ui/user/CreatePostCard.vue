<script setup>
import { usePage, useForm } from '@inertiajs/vue3'

const form = useForm({
  body: '',
  image: null,
  visibility: '',
})

const auth = usePage().props.auth.user

function handleImageUpload(e) {
  form.image = e.target.files[0]
}

function submit() {
  form.post('/uploadPost', {
    forceFormData: true,
  })
}
</script>



<template>
    <div class="flex flex-col px-2 pt-5">

        <form @submit.prevent="submit">
            <!--Card head-->
            <div class="flex flex-col">
                <div class="flex justify-between py-2">
                    <span class="flex space-x-4 items-center">
                        <span>back</span>
                        <span>Create Post</span>
                    </span>
                    <span>
                        <button type="submit" :disabled="form.processing" class="py-2 px-3 bg-blue-700 text-white rounded-md cursor-pointer">Upload</button>
                    </span>
                </div>

                <!--Sub Head card-->
                <div class="flex space-x-2.5 items-center">
                    <span>
                        <img :src="`/storage/${auth.image}`" :alt="auth.image" class="w-12 h-12 rounded-full object-cover" />
                    </span>
                    <div class="flex flex-col">
                        <span class="font-bold">{{ auth.name }}</span>
                        <select v-model="form.visibility" class="px-1 py-1 bg-blue-200 text-blue-800 rounded">
                            <option disabled value="">Select visibility</option>
                            <option value="private">Private</option>
                            <option value="followers">Follewers</option>
                            <option value="public">Public</option>
                        </select>
                    </div>
                </div>
                <!--End of Sub head-->

                <!--Body card-->
                <div>
                    <textarea
                        v-model="form.body"
                        class="w-full p-2 mt-2 rounded resize-none"
                        rows="6"
                        placeholder="What's on your mind?"
                    ></textarea>
                </div>
                <!--ENd of body Card-->

                <!--Footer Card-->

                <!--Just Horizontal line-->
                <div class="h-[1px] bg-gray-400"></div>
                <div class="flex space-x-2.5 py-3">
                    <span>
                        <label for="picture-upload" class="cursor-pointer flex items-center space-x-1">
                            <span>icon</span>
                            <p>Photo</p>
                        </label>
                        <input
                            id="picture-upload"
                            type="file"
                            class="hidden"
                            @change="handleImageUpload"
                        />
                    </span>
                </div>
            </div>
        </form>
    </div>
</template>