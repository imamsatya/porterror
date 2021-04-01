<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tabel
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <!-- {{this.edcod[0]['fotos'][0]['fotoname']}} -->
                    <tabel-view :edcod="edcod" ></tabel-view>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import TabelView from '@/Pages/Edcod/TabelView'

    export default {
        components: {
            AppLayout,
            TabelView,
        },

        props:{
            edcod: Array,
        }
    }
</script>
