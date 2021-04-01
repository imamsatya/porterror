<template>
    <div>


        <div class="hidden sm:block" aria-hidden="true">
            <div class="py-5">
                <div class="border-t border-gray-200"></div>
            </div>
        </div>

        <div class="mt-10 sm:mt-0">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Bidang</h3>
                        <p class="mt-1 text-sm text-gray-600">
                            Silakan isi Bidang dan Kegiatannya
                        </p>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form action="#" method="POST">
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">


                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="country"
                                            class="block text-sm font-medium text-gray-700">Bidang  {{selectedBidang}}</label>
                                            <!--  -->
                                        <select  autocomplete="country" v-model="selectedBidang"  @change="pilihBidang()"
                                             class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <!-- <option >Tata Usaha</option>
                                            <option>Statistik Sosial</option>
                                            <option>Statistik Produksi</option>
                                            <option>Statistik Distribusi</option>
                                            <option>Neraca Wilayah dan Analisis Statistik</option>
                                            <option>Integrasi Pengolahan dan Diseminasi Statistik</option> -->

                                              <option v-for="option in bidang" v-bind:key='option.bidang'>
                                                  {{ option }}
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="country"
                                            class="block text-sm font-medium text-gray-700">Kegiatan {{selectedKegiatan}}</label>
                                        <select id="country" name="country" autocomplete="country" v-model="selectedKegiatan"
                                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" @change="pilihKegiatan()">
                                            <option v-for="option in kegiatanOptions" v-bind:key='option.bidang' >
                                                  {{ option }}
                                            </option>
                                        </select>
                                    </div>


                                </div>
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>




        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div>
                <!-- <jet-application-logo class="block h-12 w-auto" /> -->
            </div>

            <div class="mt-8 text-2xl">
                Porterror
            </div>

            <div>
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Form</h3>
                            <p class="mt-1 text-sm text-gray-600">
                                Silakan isi formnya
                            </p>
                        </div>
                    </div>
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <form @submit.prevent="postForm">
                            <div class="shadow sm:rounded-md sm:overflow-hidden">
                                <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                    <div class="grid grid-cols-3 gap-6">
                                        <div class="col-span-3 sm:col-span-2">
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="country"
                                                    class="block text-sm font-medium text-gray-700">Kabupaten /
                                                    Kota</label>
                                                <select id="country" name="country" autocomplete="country"
                                                    class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                                    v-model="form.kabupaten">
                                                    <option>Banggai</option>
                                                    <option>Banggai Kepulauan</option>
                                                    <option>Banggai Laut</option>
                                                    <option>Buol</option>
                                                    <option>Donggala</option>
                                                    <option>Morowali</option>
                                                    <option>Morowali Utara</option>
                                                    <option>Parigi Moutong</option>
                                                    <option>Poso</option>
                                                    <option>Sigi</option>
                                                    <option>Tojo Una - una</option>
                                                    <option>Tolitoli</option>
                                                    <option>Palu</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-3 gap-6">
                                        <div class="col-span-3 sm:col-span-2">
                                            <label for="company_website"
                                                class="block text-sm font-medium text-gray-700">
                                                Kecamatan
                                            </label>
                                            <div class="mt-1 flex rounded-md shadow-sm">

                                                <input v-model="form.kecamatan" type="text" name="company_website"
                                                    id="company_website"
                                                    class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"
                                                    placeholder="Kecamatan">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-3 gap-6">
                                        <div class="col-span-3 sm:col-span-2">
                                            <label for="company_website"
                                                class="block text-sm font-medium text-gray-700">
                                                Desa
                                            </label>
                                            <div class="mt-1 flex rounded-md shadow-sm">

                                                <input v-model="form.desa" type="text" name="company_website"
                                                    id="company_website"
                                                    class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"
                                                    placeholder="Desa">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-3 gap-6">
                                        <div class="col-span-3 sm:col-span-2">
                                            <label for="company_website"
                                                class="block text-sm font-medium text-gray-700">
                                                SLS
                                            </label>
                                            <div class="mt-1 flex rounded-md shadow-sm">

                                                <input v-model="form.sls" type="text" name="company_website"
                                                    id="company_website"
                                                    class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"
                                                    placeholder="SLS">
                                            </div>
                                        </div>
                                    </div>


                                    <form v-on:submit.prevent="addNewImage">
                                        <v-row dense>

                                            <v-col cols="12" md="8">
                                                <v-file-input label="File input" id="" name="" dense
                                                    prepend-icon="mdi-camera" @change="onFileChange"></v-file-input>
                                            </v-col>

                                            <v-col cols="12" md="4">
                                                <button
                                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    Tambah
                                                </button>
                                            </v-col>

                                        </v-row>
                                    </form>

                                    <li v-for="(foto, index) in this.form.foto" :key="foto.id">{{foto.foto.name}}

                                        <button
                                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                            @click="removeImage(index)">
                                            Hapus
                                        </button>
                                    </li>


                                    <div v-if="countImage > 0">
                                        <v-row dense v-for="(foto, index) in this.form.foto" :key="foto.name"
                                            v-on:remove="this.form.foto.splice(index, 1)">
                                            <v-col cols="12" md="8">
                                                <v-file-input label="File input" id="" name="" dense
                                                    prepend-icon="mdi-camera" @change="onFileChange"></v-file-input>
                                            </v-col>

                                            <v-col cols="12" md="4">
                                                <button
                                                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                    @click="reducecountImage(n)">
                                                    Hapus
                                                </button>
                                            </v-col>
                                        </v-row>
                                    </div>
                                    <!-- <input type="file" multiple name="" id="" @change="onFileChange"> -->

                                    <div>
                                        <label for="about" class="block text-sm font-medium text-gray-700">
                                            Catatan Error
                                        </label>
                                        <div class="mt-1">
                                            <textarea v-model="form.catatanError" id="about" name="about" rows="3"
                                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md"
                                                placeholder="Catatan Error"></textarea>
                                        </div>
                                        <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                            {{ form.progress.percentage }}%
                                        </progress>
                                    </div>
                                </div>
                                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                    <button type="submit"
                                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                        :disabled="form.processing">
                                        Save {{this.progressBar}}
                                    </button>
                                    <!-- <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">
          <loading-button :loading="sending" class="btn-indigo" type="submit">Create User</loading-button>
        </div> -->
                                </div>

                                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                    {{ form.progress.percentage }}%
                                </progress>

                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="hidden sm:block" aria-hidden="true">
                <div class="py-5">
                    <div class="border-t border-gray-200"></div>
                </div>
            </div>



            <div cass="mt-6 text-gray-500">
                <!-- Porterror provides a beautiful, robust starting point for your error problems. Porterror
                is designed
                to help you build your application using a development environment that is simple, powerful, and
                enjoyable. -->
                We believe you should love expressing your creativity through programming, so we have spent time
                carefully crafting
                the Porterror
                ecosystem to be a breath of fresh air. We hope you love it.
            </div>
        </div>


    </div>
</template>

<script>
    import JetApplicationLogo from '@/Jetstream/ApplicationLogo'
    // import FileInput from '@/Pages/Sharedx/FileInput'
    export default {
        components: {
            JetApplicationLogo,
            // FileInput,
        },
        props: {
            errors: Object,
            kegiatans: Array,
            bidang: Object
            
        },
        data() {
            return {
                selectedBidang: '',
                selectedKegiatan: '',
                kegiatanOptions:[],




                fotoTemp: '',
                nextImageId: 0,
                countImage: 0,
                sending: false,
                editMode: false,
                isOpen: false,

                form: this.$inertia.form({
                    kegiatan: null,
                    kabupaten: null,
                    kecamatan: null,
                    desa: null,
                    sls: null,
                    foto: [],
                    catatanError: null,
                    _method: 'post'

                }),
                progressBar: 0,
            }
        },
        methods: {
            async pilihKegiatan(){
                console.log('selectedkegiatan', this.selectedKegiatan)
            },
             async pilihBidang(){
                 console.log('selected', this.selectedBidang)
               await this.kegiatans.forEach(element => {
                    console.log(element.bidang)
                    if (element.bidang == this.selectedBidang) {
                        this.kegiatanOptions.push(element.kegiatan)
                        console.log('a')
                    }
                });
                console.log('ko', this.kegiatanOptions)
                console.log(this.kegiatans[0]['bidang'])
                
            },
            removeImage(index) {
                this.form.foto.splice(index, 1)
                console.log(this.form.foto)
            },
            addNewImage: function (e) {
                this.form.foto.push({
                    id: this.nextImageId++,
                    foto: this.fotoTemp
                })
                console.log('addFoto', this.form.foto)
            },
            reducecountImage(i) {

                this.form.foto.splice(i, 1)
                console.log('reduce', this.form.foto)
                this.countImage = this.countImage - 1
            },
            onFileChange(e) {
                console.log('vuetify', e)
                // console.log('normal', e.target.files[0]);
                this.fotoTemp = e
                // this.form.foto.push( e);
                console.log('e', e)
                console.log('form forto', this.form.foto)


            },
            async postForm(e) {
                e.preventDefault();
                let currentObj = this;
                const configx = {
                    headers: {
                        'content-type': 'multipart/form-data',
                        // 'x-csrf-token': document.querySelectorAll('meta[name=csrf-token]')[0].getAttributeNode('content').value,
                        //  Authorization: 'Bearer ' + localStorage.getItem('token')
                    }

                }
                let formData = new FormData();

                formData.append('file', this.form.foto);
                formData.append('bidang', this.selectedBidang);
                formData.append('kegiatan', this.selectedKegiatan);
                if (

                    this.form.kabupaten === null ||

                    this.form.kecamatan === null ||
                    this.form.desa === null ||
                    this.form.sls === null ||
                    this.form.foto === null ||
                    this.form.catatanError === null ||
                    this.selectedKegiatan === null
                ) {
                    // this.snackbar = true

                } else {
                    console.log('formdata sebelum submit', formData)

                    let timeout = null


                    await this.$inertia.post('/submitform', [this.form, this.selectedBidang, this.selectedKegiatan], {

                        onStart: () => this.sending = true,
                        onProgress: (progressEvent) => {
                            //DATA TERSEBUT AKAN DI ASSIGN KE VARIABLE progressBar
                            this.progressBar = parseInt(Math.round((progressEvent.loaded * 100) /
                                progressEvent.total))
                            console.log(progressEvent.loaded)
                            console.log('Upload Progress: ', this.progressBar)
                        },

                        onSuccess: (response) => {
                            // Handle success event
                            console.log('onSuccess', response)
                        },
                        onError: (errors) => {
                            // Handle validation errors
                            console.log('onError', errors)
                        },
                        onFinish: () => this.sending = false,
                    })
                }
            },
        }
    }

</script>
