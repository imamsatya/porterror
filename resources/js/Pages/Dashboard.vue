<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Form 
            </h2>
        </template>

        <div class="">
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <welcome2 :kegiatans="kegiatans" :bidang="bidang"/>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome2 from '@/Pages/Edcod/Welcome2'

    export default {
        components: {
            AppLayout,
            Welcome2,
        },
        props:{
            kegiatans: Array,
            bidang: Object
        }
    }
</script>
