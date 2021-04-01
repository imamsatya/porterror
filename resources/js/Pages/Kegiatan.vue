<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Bidang dan Kegiatan
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <!-- {{this.edcod[0]['fotos'][0]['fotoname']}} -->

                    <template>
                        <v-app>

                            <v-data-table :headers="headers" :search="search" :items="kegiatans" sort-by="bidang"
                                class="elevation-1">
                                <template v-slot:top>
                                    <v-toolbar flat>
                                        <v-toolbar-title>Daftar Kegiatan </v-toolbar-title>

                                        <v-divider class="mx-4" inset vertical></v-divider>
                                        <v-text-field v-model="search" append-icon="mdi-magnify" label="Search"
                                            single-line hide-details></v-text-field>
                                        <v-spacer></v-spacer>
                                        <v-dialog v-model="dialog" max-width="500px">
                                            <template v-slot:activator="{ on, attrs }">
                                                <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
                                                    Tambah Kegiatan
                                                </v-btn>
                                            </template>
                                            <v-card>
                                                <v-card-title>
                                                    <span class="headline">{{ formTitle }}</span>
                                                </v-card-title>

                                                <v-card-text>
                                                    <v-container>
                                                        <v-row>
                                                            <v-col cols="12">
                                                                <v-select :items="pilihanBidang" label="Bidang" dense
                                                                    v-model="editedItem.bidang"></v-select>
                                                            </v-col>
                                                            <v-col cols="12">
                                                                <v-text-field v-model="editedItem.kegiatan"
                                                                    label="Kegiatan"></v-text-field>
                                                            </v-col>
                                                        </v-row>
                                                    </v-container>
                                                </v-card-text>

                                                <v-card-actions>
                                                    <v-spacer></v-spacer>
                                                    <v-btn color="blue darken-1" text @click="close">
                                                        Cancel
                                                    </v-btn>
                                                    <v-btn color="blue darken-1" text @click="save">
                                                        Save
                                                    </v-btn>
                                                </v-card-actions>
                                            </v-card>
                                        </v-dialog>
                                        <v-dialog v-model="dialogDelete" max-width="500px">
                                            <v-card>
                                                <v-card-title class="headline">Are you sure you want to delete this
                                                    item?
                                                </v-card-title>
                                                <v-card-actions>
                                                    <v-spacer></v-spacer>
                                                    <v-btn color="blue darken-1" text @click="closeDelete">Cancel
                                                    </v-btn>
                                                    <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK
                                                    </v-btn>
                                                    <v-spacer></v-spacer>
                                                </v-card-actions>
                                            </v-card>
                                        </v-dialog>
                                    </v-toolbar>
                                </template>
                                <template v-slot:item.actions="{ item }">
                                    <v-icon small class="mr-2" @click="editItem(item)">
                                        mdi-pencil
                                    </v-icon>
                                    <v-icon small @click="deleteItem(item)">
                                        mdi-delete
                                    </v-icon>
                                </template>
                                <template v-slot:no-data>
                                    <v-btn color="primary" @click="initialize">
                                        Reset
                                    </v-btn>
                                </template>
                            </v-data-table>
                        </v-app>
                    </template>


                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'


    export default {
        components: {
            AppLayout,

        },
        props: {
            kegiatans: Array,
        },

        data: () => ({
            pilihanBidang: [
                'Tata Usaha',
                'Statistik Sosial',
                'Statistik Produksi',
                'Neraca Wilayah dan Analisis Statistik',
                'Integrasi Pengolahan dan Diseminasi Statistik'
            ],
            search: '',
            dialog: false,
            dialogDelete: false,
            headers: [{
                    text: 'Bidang',
                    align: 'start',
                    sortable: false,
                    value: 'bidang',
                },
                {
                    text: 'Kegiatan',
                    value: 'kegiatan'
                },

                {
                    text: 'Actions',
                    value: 'actions',
                    sortable: false
                },
            ],
            kegiatansView: [],
            editedIndex: -1,
            editedItem: {
                pilihanBidang: '',
                kegiatan: '',
            },
            defaultItem: {
                pilihanBidang: '',
                kegiatan: '',
            },
        }),

        computed: {
            formTitle() {
                return this.editedIndex === -1 ? 'Tambah Kegiatan' : 'Edit Kegiatan'
            },
        },

        watch: {
            dialog(val) {
                val || this.close()
            },
            dialogDelete(val) {
                val || this.closeDelete()
            },
        },

        created() {
            this.initialize()
        },

        methods: {
            initialize() {
                this.kegiatansView = this.kegiatans
            },

            editItem(item) {
                this.editedIndex = this.kegiatans.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialog = true
            },

            deleteItem(item) {
                this.editedIndex = this.kegiatans.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialogDelete = true
            },

            async deleteItemConfirm() {
                this.kegiatans.splice(this.editedIndex, 1)

                await this.$inertia.post('/deletekegiatan', this.editedItem, {
                    onProgress: (progressEvent) => {
                        //DATA TERSEBUT AKAN DI ASSIGN KE VARIABLE progressBar
                        this.progressBar = parseInt(Math.round((progressEvent.loaded * 100) /
                            progressEvent.total))
                        console.log(progressEvent.loaded)
                        console.log('Upload Progress: ', this.progressBar)
                    },

                    onSuccess: (response) => {
                        // Handle success event
                        this.deleteDialog = false
                        alert('onSuccess', response)
                    },
                    onError: (errors) => {
                        // Handle validation errors
                        console.log('onError', errors)
                    },
                })
                this.closeDelete()
            },

            close() {
                this.dialog = false
                this.$nextTick(() => {
                    this.editedItem = Object.assign({}, this.defaultItem)
                    this.editedIndex = -1
                })
            },

            closeDelete() {
                this.dialogDelete = false
                this.$nextTick(() => {
                    this.editedItem = Object.assign({}, this.defaultItem)
                    this.editedIndex = -1
                })
            },

            async save() {
                if (this.editedIndex > -1) {
                    Object.assign(this.kegiatans[this.editedIndex], this.editedItem)

                    await this.$inertia.post('/editkegiatan', this.editedItem, {
                        onProgress: (progressEvent) => {
                            //DATA TERSEBUT AKAN DI ASSIGN KE VARIABLE progressBar
                            this.progressBar = parseInt(Math.round((progressEvent.loaded * 100) /
                                progressEvent.total))
                            console.log(progressEvent.loaded)
                            console.log('Upload Progress: ', this.progressBar)
                        },

                        onSuccess: (response) => {
                            // Handle success event
                            // this.dialog = false
                            alert('onSuccess', response)
                        },
                        onError: (errors) => {
                            // Handle validation errors
                            console.log('onError', errors)
                        },



                    })
                

                    
                } else {
                    // this.desserts.push(this.editedItem)

                    await this.$inertia.post('/savekegiatan', this.editedItem, {
                        onProgress: (progressEvent) => {
                            //DATA TERSEBUT AKAN DI ASSIGN KE VARIABLE progressBar
                            this.progressBar = parseInt(Math.round((progressEvent.loaded * 100) /
                                progressEvent.total))
                            console.log(progressEvent.loaded)
                            console.log('Upload Progress: ', this.progressBar)
                        },

                        onSuccess: (response) => {
                            // Handle success event
                            // this.dialog = false
                            alert('onSuccess', response)
                        },
                        onError: (errors) => {
                            // Handle validation errors
                            console.log('onError', errors)
                        },



                    })
                }
                this.close()
            },
        },
    }

</script>
