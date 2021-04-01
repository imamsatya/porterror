<template>
    <v-app>
        <v-container fluid>
            <v-data-iterator :items="edcod" :items-per-page.sync="itemsPerPage" :page.sync="page" :search="search"
                :sort-by="sortBy.toLowerCase()" :sort-desc="sortDesc" hide-default-footer>
                <template v-slot:header>
                    <v-toolbar dark color="blue darken-3" class="mb-1">
                        <v-text-field v-model="search" clearable flat solo-inverted hide-details
                            prepend-inner-icon="mdi-magnify" label="Search"></v-text-field>
                        <template v-if="$vuetify.breakpoint.mdAndUp">
                            <v-spacer></v-spacer>
                            <v-select v-model="sortBy" flat solo-inverted hide-details :items="keys"
                                prepend-inner-icon="mdi-magnify" label="Sort by"></v-select>
                            <v-spacer></v-spacer>
                            <v-btn-toggle v-model="sortDesc" mandatory>
                                <v-btn large depressed color="blue" :value="false">
                                    <v-icon>mdi-arrow-up</v-icon>
                                </v-btn>
                                <v-btn large depressed color="blue" :value="true">
                                    <v-icon>mdi-arrow-down</v-icon>
                                </v-btn>
                            </v-btn-toggle>
                        </template>
                    </v-toolbar>
                </template>

                <template v-slot:default="props">
                    <br>
                    <v-row>
                        <v-col v-for="(item, index) in props.items" :key="item.id" cols="12" sm="6" md="6" lg="6">
                            <v-card class="rounded-card" elevation="10">
                                <br>


                                <div class="d-flex justify-end mb-6" v-if="$page.props.user.id == 1">
                                    <!-- <v-btn class="mx-2"  dark small color="blue">
                                    <v-icon>
                                        mdi-pencil
                                    </v-icon>
                                </v-btn> -->
                                    <v-btn class="mx-2" dark small color="red" @click="deleteDialogf(item)">
                                        <v-icon>
                                            mdi-delete
                                        </v-icon>
                                    </v-btn>



                                </div>
                                <v-card-subtitle>
                                    <v-btn v-if="item.status == 'closed'" depressed color="green" small>
                                        {{item.status}}
                                    </v-btn>

                                    <v-btn v-if="item.status == 'open'" depressed color="amber" small>
                                        {{item.status}}
                                    </v-btn>
                                    {{item.kabupaten}}
                                </v-card-subtitle>
                                <v-chip class="ma-2" color="indigo" text-color="white" small>
                                    <v-avatar left>
                                        <v-icon>mdi-account-circle</v-icon>
                                    </v-avatar>
                                    {{ item.kabupaten }}
                                </v-chip>

                                <v-chip class="mr-2" color="red" text-color="white" small>
                                    <v-avatar left>
                                        <v-icon>mdi-map</v-icon>
                                    </v-avatar>
                                    <div class="align-end">
                                        {{item.kecamatan}}
                                    </div>
                                </v-chip>
                                <v-chip class="mr-2" color="red" text-color="white" small>
                                    <v-avatar left>
                                        <v-icon>mdi-map</v-icon>
                                    </v-avatar>
                                    <div class="align-end">
                                        {{item.desa}}
                                    </div>
                                </v-chip>
                                <v-chip class="mr-2" color="red" text-color="white" small>
                                    <v-avatar left>
                                        <v-icon>mdi-map</v-icon>
                                    </v-avatar>
                                    <div class="align-end">
                                        {{item.sls}}
                                    </div>
                                </v-chip>
                                <v-chip class="mr-2">

                                    {{item.updated_at.substring( 0, 10)}}
                                </v-chip>



                                <v-divider></v-divider>

                                <v-card-subtitle>Catatan Error : <br>{{item.catatan_error}}</v-card-subtitle>

                                <v-expansion-panels inset>
                                    <v-expansion-panel>
                                        <v-expansion-panel-header>Foto</v-expansion-panel-header>
                                        <v-expansion-panel-content>
                                            <v-carousel height="400">
                                                <v-carousel-item v-for="(foto, i) in item['fotos']" :key="i"
                                                    reverse-transition="fade-transition" transition="fade-transition"
                                                    :src="'/foto/'+ item['fotos'][i]['fotoname']">
                                                </v-carousel-item>
                                            </v-carousel>
                                        </v-expansion-panel-content>
                                    </v-expansion-panel>
                                </v-expansion-panels>


                                <v-card-subtitle>Jawaban : <br>{{item.jawaban}} <div v-if="item.jawaban !== null"
                                        color="primary" @click="dialogBalasanf(item, index)"> <a>.. selebihnya</a>
                                    </div>
                                </v-card-subtitle>
                                <v-list-item>
                                    <v-list-item-content class="align-center">

                                        <v-btn v-if="item.jawaban == null && item.status== 'open'" color="primary"
                                            @click="dialogJawabanf(item, index)">
                                            <div> Jawab</div>

                                        </v-btn>
                                        <v-btn v-if="item.jawaban !== null && item.status== 'open'" color="primary"
                                            @click="dialogBalasanf(item, index)">
                                            <div> Balas</div>
                                        </v-btn>

                                        <v-btn v-if="$page.props.user.id == 1 && item.status== 'open'" color="success"
                                            @click="dialogStatusf(item, index)">
                                            <div> Close ?</div>
                                        </v-btn>

                                         <v-btn v-if="$page.props.user.id == 1 && item.status== 'closed'" color="amber"
                                            @click="dialogOpenf(item, index)">
                                            <div> Open ?</div>
                                        </v-btn>



                                    </v-list-item-content>
                                </v-list-item>

                            </v-card>

                        </v-col>

                        <!-- Dialog Balasan -->
                        <v-dialog v-model="dialogBalas" fullscreen hide-overlay transition="dialog-bottom-transition"
                            scrollable>
                            <v-card tile>
                                <v-toolbar flat dark color="primary">
                                    <v-btn icon dark @click="dialogBalas = false">
                                        <v-icon>mdi-close</v-icon>
                                    </v-btn>
                                    <v-toolbar-title>Dialog</v-toolbar-title>
                                    <v-spacer></v-spacer>
                                    <v-toolbar-items>
                                        <v-btn dark text @click="dialogBalas = false">
                                            Save
                                        </v-btn>
                                    </v-toolbar-items>
                                    <v-menu bottom right offset-y>
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-btn dark icon v-bind="attrs" v-on="on">
                                                <v-icon>mdi-dots-vertical</v-icon>
                                            </v-btn>
                                        </template>

                                    </v-menu>
                                </v-toolbar>
                                <v-card-text>
                                    <v-container>
                                        <v-chip class="ma-2" color="indigo" text-color="white" small>
                                            <v-avatar left>
                                                <v-icon>mdi-account-circle</v-icon>
                                            </v-avatar>
                                            {{ itemTemp.kabupaten }}
                                        </v-chip>

                                        <v-chip class="mr-2" color="red" text-color="white" small>
                                            <v-avatar left>
                                                <v-icon>mdi-map</v-icon>
                                            </v-avatar>
                                            <div class="align-end">
                                                {{itemTemp.kecamatan}}
                                            </div>
                                        </v-chip>


                                        <v-chip class="mr-2">

                                            {{itemTemp.updated_at.substring( 0, 10)}}

                                        </v-chip>
                                        <v-divider></v-divider>

                                        <v-row>
                                            <v-col cols="12">
                                                <div class="d-flex flex-column justify-space-between align-center">

                                                    <v-card-text>
                                                        <div>Catatan Error</div>


                                                        <div class="text--primary">
                                                            {{itemTemp.catatan_error}}

                                                        </div>
                                                    </v-card-text>

                                                    <v-carousel height="400">
                                                        <v-carousel-item v-for="(foto, i) in itemTemp['fotos']" :key="i"
                                                            reverse-transition="fade-transition"
                                                            transition="fade-transition"
                                                            :src="'/foto/'+ itemTemp['fotos'][i]['fotoname']"
                                                            :aspect-ratio="16/9">



                                                        </v-carousel-item>
                                                    </v-carousel>
                                                </div>
                                                <br>

                                                <v-card-text>
                                                    <div>Jawaban</div>


                                                    <div class="text--primary">
                                                        {{itemTemp.jawaban}}

                                                    </div>
                                                </v-card-text>

                                                <div v-if="itemTemp.balasans != null">
                                                    <div v-for="(balas, i) in itemTemp.balasans" :key="i">
                                                        <div class="d-flex justify-end "
                                                            v-if="balas.user_id == $page.props.user.id">

                                                            <v-card color="green lighten-4" max-width="800">
                                                                {{balas.balasan}}
                                                            </v-card>

                                                        </div>

                                                        <div class="d-flex justify-start" v-else>

                                                            <v-card color="white" max-width="800">
                                                                {{balas.balasan}}
                                                            </v-card>
                                                        </div>
                                                        <br>
                                                    </div>


                                                </div>


                                                <v-textarea filled name="input-7-4" label="Ketik Pesan" v-model="balas">
                                                </v-textarea>
                                            </v-col>

                                        </v-row>
                                    </v-container>

                                </v-card-text>
                                <div class="d-flex justify-center mb-6">


                                    <v-card-actions>

                                        <v-col>
                                            <v-btn color="blue darken-1" text @click="dialogBalas = false">
                                                Close
                                            </v-btn>

                                            <v-btn color="blue darken-1" text @click="saveBalasan(itemTemp, balas)">
                                                Save
                                            </v-btn>
                                        </v-col>
                                    </v-card-actions>
                                </div>

                            </v-card>
                        </v-dialog>

                        <!-- Dialog Jawaban -->
                        <v-dialog v-model="dialog" fullscreen hide-overlay transition="dialog-bottom-transition"
                            scrollable>
                            <v-card>
                                <v-toolbar flat dark color="primary">
                                    <v-btn icon dark @click="dialog = false">
                                        <v-icon>mdi-close</v-icon>
                                    </v-btn>
                                    <v-toolbar-title>Dialog</v-toolbar-title>
                                    <v-spacer></v-spacer>
                                    <v-toolbar-items>
                                        <v-btn dark text @click="dialog = false">
                                            Save
                                        </v-btn>
                                    </v-toolbar-items>
                                    <v-menu bottom right offset-y>
                                        <template v-slot:activator="{ on, attrs }">
                                            <v-btn dark icon v-bind="attrs" v-on="on">
                                                <v-icon>mdi-dots-vertical</v-icon>
                                            </v-btn>
                                        </template>
                                    </v-menu>
                                </v-toolbar>
                                <v-card-text>
                                    <v-container>
                                        <v-chip class="ma-2" color="indigo" text-color="white" small>
                                            <v-avatar left>
                                                <v-icon>mdi-account-circle</v-icon>
                                            </v-avatar>
                                            {{ itemTemp.kabupaten }}
                                        </v-chip>

                                        <v-chip class="mr-2" color="red" text-color="white" small>
                                            <v-avatar left>
                                                <v-icon>mdi-map</v-icon>
                                            </v-avatar>
                                            <div class="align-end">
                                                {{itemTemp.kecamatan}}
                                            </div>
                                        </v-chip>


                                        <v-chip class="mr-2">

                                            {{itemTemp.updated_at.substring( 0, 10)}}

                                        </v-chip>

                                        <v-divider></v-divider>

                                        <v-card-text>
                                            <div>Catatan Error</div>


                                            <div class="text--primary">
                                                {{itemTemp.catatan_error}}

                                            </div>
                                        </v-card-text>

                                        <v-row>
                                            <v-col cols="12">
                                                <div class="d-flex flex-column justify-space-between align-center">

                                                    <v-carousel height="400">
                                                        <v-carousel-item v-for="(foto, i) in itemTemp['fotos']" :key="i"
                                                            reverse-transition="fade-transition"
                                                            transition="fade-transition"
                                                            :src="'/foto/'+ itemTemp['fotos'][i]['fotoname']"
                                                            :aspect-ratio="16/9">



                                                        </v-carousel-item>
                                                    </v-carousel>
                                                </div>

                                                <br>
                                                <v-textarea filled name="input-7-4" label="Jawaban"
                                                    v-model="itemTemp.jawaban">
                                                </v-textarea>
                                            </v-col>

                                        </v-row>
                                    </v-container>

                                </v-card-text>

                                <div class="d-flex justify-center mb-6">
                                    <v-card-actions>

                                        <v-col>
                                            <v-btn color="blue darken-1" text @click="dialog = false">
                                                Close
                                            </v-btn>

                                            <v-btn color="blue darken-1" text @click="saveJawaban(itemTemp)">
                                                Save
                                            </v-btn>
                                        </v-col>
                                    </v-card-actions>
                                </div>
                            </v-card>
                        </v-dialog>

                        <!-- Delete Dialog -->
                        <v-dialog transition="dialog-bottom-transition" max-width="600" v-model="deleteDialog">


                            <v-card>
                                <v-toolbar color="red" dark>Menghapus Data ??</v-toolbar>
                                <v-card-text>
                                    <div class="text-h2 pa-12">Yakin ?</div>
                                </v-card-text>
                                <v-card-actions class="justify-end">
                                    <v-btn text @click="deleteDialog = false">Close</v-btn>
                                    <v-btn text @click="deleteFinal()">iya</v-btn>
                                </v-card-actions>
                            </v-card>

                        </v-dialog>

                        <!-- Close Dialog -->
                        <v-dialog transition="dialog-bottom-transition" max-width="600" v-model="statusDialog">


                            <v-card>
                                <v-toolbar color="primary" dark>Close the Thread ??</v-toolbar>
                                <v-card-text>
                                    <div class="text-h2 pa-12">Yakin ?</div>
                                </v-card-text>
                                <v-card-actions class="justify-end">
                                    <v-btn text @click="statusDialog = false">Close</v-btn>
                                    <v-btn text @click="closeFinal()">iya</v-btn>
                                </v-card-actions>
                            </v-card>

                        </v-dialog>

                        <!-- Open Dialog -->
                        <v-dialog transition="dialog-bottom-transition" max-width="600" v-model="openDialog">
                            <v-card>
                                <v-toolbar color="amber" dark>Open the Thread ??</v-toolbar>
                                <v-card-text>
                                    <div class="text-h2 pa-12">Yakin ?</div>
                                </v-card-text>
                                <v-card-actions class="justify-end">
                                    <v-btn text @click="openDialog = false">Close</v-btn>
                                    <v-btn text @click="openFinal()">iya</v-btn>
                                </v-card-actions>
                            </v-card>

                        </v-dialog>



                    </v-row>
                </template>

                <template v-slot:footer>
                    <v-row class="mt-2" align="center" justify="center">
                        <span class="grey--text"> Items per page </span>
                        <v-menu offset-y>
                            <template v-slot:activator="{ on, attrs }">
                                <v-btn dark text color="primary" class="ml-2" v-bind="attrs" v-on="on">
                                    {{ itemsPerPage }}
                                    <v-icon>mdi-chevron-down</v-icon>
                                </v-btn>
                            </template>
                            <v-list>
                                <v-list-item v-for="(number, index) in itemsPerPageArray" :key="index"
                                    @click="updateItemsPerPage(number)">
                                    <v-list-item-title>{{ number }}</v-list-item-title>
                                </v-list-item>
                            </v-list>
                        </v-menu>

                        <v-spacer></v-spacer>

                        <span class="mr-4 grey--text">
                            Page {{ page }} of {{ numberOfPages }}
                        </span>
                        <v-btn fab dark color="blue darken-3" class="mr-1" @click="formerPage">
                            <v-icon>mdi-chevron-left</v-icon>
                        </v-btn>
                        <v-btn fab dark color="blue darken-3" class="ml-1" @click="nextPage">
                            <v-icon>mdi-chevron-right</v-icon>
                        </v-btn>
                    </v-row>
                </template>
            </v-data-iterator>
        </v-container>
    </v-app>
</template>

<script>
    export default {
        props: {
            edcod: {
                type: Array
            }
        },
        data() {
            return {
                openDialog: false,
                statusDialog: false,
                id: null,
                deleteDialog: false,
                dialogBalas: null,
                balas: null,
                itemTemp: {
                    catatan_error: null,
                    created_at: null,
                    desa: null,
                    status: null,
                    fotos: null,
                    id: null,
                    jawaban: null,
                    kab_id: null,
                    kabupaten: null,
                    kecamatan: null,
                    sls: null,
                    updated_at: 'aaaaaaaaaaaaaaaaaaaaaaaaaa',
                    user_id: null

                },
                jawaban: null,
                dialog: null,
                width: 300,
                itemsPerPageArray: [4, 8, 12],
                search: '',
                filter: {},
                sortDesc: false,
                page: 1,
                itemsPerPage: 4,
                sortBy: 'name',
                keys: [
                    'Kabupaten',
                    'Kecamatan',
                    'Desa',
                    'Sls',
                    'Foto',
                    'Catatan_error'
                ],

            }
        },
        // mounted(){
        //     this.itemTemp = this.edcod[0]
        // },
        computed: {
            numberOfPages() {
                return Math.ceil(this.edcod.length / this.itemsPerPage)
            },
            filteredKeys() {
                return this.keys.filter(key => key !== 'Name')
            },
        },
        methods: {
            async openFinal(){


             await this.$inertia.post('/openthread/'+this.id.id, this.id.id, {
                    onProgress: (progressEvent) => {
                        //DATA TERSEBUT AKAN DI ASSIGN KE VARIABLE progressBar
                        this.progressBar = parseInt(Math.round((progressEvent.loaded * 100) /
                            progressEvent.total))
                        console.log(progressEvent.loaded)
                        console.log('Upload Progress: ', this.progressBar)
                    },

                    onSuccess: (response) => {
                        // Handle success event
                        this.openDialog = false
                        alert('onSuccess', response)
                    },
                    onError: (errors) => {
                        // Handle validation errors
                        console.log('onError', errors)
                    },



                })
        },

            dialogOpenf(item){
                this.id = item
                console.log('this id.id', this.id.id)
                this.openDialog = true
            },
            async closeFinal(){


             await this.$inertia.post('/closethread/'+this.id.id, this.id.id, {
                    onProgress: (progressEvent) => {
                        //DATA TERSEBUT AKAN DI ASSIGN KE VARIABLE progressBar
                        this.progressBar = parseInt(Math.round((progressEvent.loaded * 100) /
                            progressEvent.total))
                        console.log(progressEvent.loaded)
                        console.log('Upload Progress: ', this.progressBar)
                    },

                    onSuccess: (response) => {
                        // Handle success event
                        this.statusDialog = false
                        alert('onSuccess', response)
                    },
                    onError: (errors) => {
                        // Handle validation errors
                        console.log('onError', errors)
                    },



                })
        },

            dialogStatusf(item){
                this.id = item
                console.log('this id.id', this.id.id)
                this.statusDialog = true
            },
            async deleteFinal() {
                await this.$inertia.post('/deletedata/' + this.id.id + '/delete', this.id.id, {
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

            },
            deleteDialogf(item) {
                this.id = item
                console.log('this id.id', this.id.id)
                this.deleteDialog = true
            },
            async saveBalasan(item, balas) {

                await this.$inertia.post('/submitbalasan', [item, balas], {
                    onProgress: (progressEvent) => {
                        //DATA TERSEBUT AKAN DI ASSIGN KE VARIABLE progressBar
                        this.progressBar = parseInt(Math.round((progressEvent.loaded * 100) /
                            progressEvent.total))
                        console.log(progressEvent.loaded)
                        console.log('Upload Progress: ', this.progressBar)
                    },

                    onSuccess: (response) => {
                        // Handle success event
                        this.dialogBalas = false
                        alert('onSuccess', response)
                    },
                    onError: (errors) => {
                        // Handle validation errors
                        console.log('onError', errors)
                    },



                })

            },
            async saveJawaban(item) {

                await this.$inertia.post('/submitjawaban', item, {
                    onProgress: (progressEvent) => {
                        //DATA TERSEBUT AKAN DI ASSIGN KE VARIABLE progressBar
                        this.progressBar = parseInt(Math.round((progressEvent.loaded * 100) /
                            progressEvent.total))
                        console.log(progressEvent.loaded)
                        console.log('Upload Progress: ', this.progressBar)
                    },

                    onSuccess: (response) => {
                        // Handle success event
                        this.dialog = false
                        alert('onSuccess', response)
                    },
                    onError: (errors) => {
                        // Handle validation errors
                        console.log('onError', errors)
                    },



                })
            },
            dialogBalasanf(item, index) {

                this.itemTemp = item
                console.log('item', item)
                console.log('index', index)
                console.log('itemTemp', this.itemTemp)
                this.dialogBalas = true
            },
            dialogJawabanf(item, index) {

                this.itemTemp = item
                console.log('item', item)
                console.log('index', index)
                console.log('itemTemp', this.itemTemp)
                this.dialog = true
            },
            nextPage() {
                if (this.page + 1 <= this.numberOfPages) this.page += 1
            },
            formerPage() {
                if (this.page - 1 >= 1) this.page -= 1
            },
            updateItemsPerPage(number) {
                this.itemsPerPage = number
            },
        },
    }

</script>

<style lang="css" scoped>
    .rounded-card {
        border-radius: 30px;
    }

</style>
