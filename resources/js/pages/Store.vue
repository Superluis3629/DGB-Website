<template>
    <div class="warnjai-regular">
        <div class="card">
            <div class="d-flex justify-content-between">
                <h5 class="card-header warnjai-regular">ລາຍການສະຕ໊ອກສິນຄ້າ</h5>
                <div class="pt-3 pe-3">
                    <button type="button" class="btn btn-success me-2 warnjai-regular" :disabled="check_input"
                        @click="save_store()" v-if="FormShow">ບັນທຶກ</button>
                    <button type="button" class="btn btn-danger warnjai-regular" v-if="FormShow"
                        @click="cancel()">ຍົກເລີກ</button>
                    <button type="button" class="btn btn-info warnjai-regular" @click="add()"
                        v-if="!FormShow">ເພີ່ມ</button>
                </div>
            </div>
            <div class="card-body">
                <div class="row" v-if="FormShow">
                    <div class="col-md-4 text-center" style="position: relative">
                        <div style="position: absolute; right: 20px;">
                            <button type="button" class="btn rounded-pill btn-icon btn-danger fs-4" @click="remove_img()">
                                <i class="bx bx-x-circle"></i>
                            </button>
                        </div>
                        <img :src="imagePreview" style="width: 80%;" alt="">
                        <input type="file" class="form-control mt-2" @change="onSelected" name="" id="">
                    </div>
                    <div class="col-md-8">
                        <label class="warnjai-regular" for="">ຊື່ສິນຄ້າ</label>
                        <input type="text" class="form-control warnjai-regular mb-2" placeholder="ກະລຸນາປ້ອນຊື້ສິນຄ້າ..."
                            v-model="FormStore.name">
                        <label class="warnjai-regular" for="">ຈຳນວນ</label>
                        <cleave class="form-control warnjai-regular mb-2" :options="options"
                            placeholder="ກະລຸນາປ້ອນຈຳນວນ..." v-model="FormStore.amount" />
                        <div class="row">
                            <div class="col-md-6">
                                <label class="warnjai-regular" for="">ລາຄາຊື້</label>
                                <cleave class="form-control warnjai-regular mb-2" :options="options"
                                    placeholder="ກະລຸນາປ້ອນລາຄາຊື້..." v-model="FormStore.price_buy" />
                            </div>
                            <div class="col-md-6">
                                <label class="warnjai-regular" for="">ລາຄາຂາຍ</label>
                                <cleave class="form-control warnjai-regular mb-2" :options="options"
                                    placeholder="ກະລຸນາປ້ອນລາຄາຂາຍ..." v-model="FormStore.price_sell" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive text-nowrap" v-if="!FormShow">
                    <div class="d-flex justify-content-end">
                        <input type="text" class="form-control warnjai-regular mb-2" style="width: 350px;"
                            placeholder="ຄົ້ນຫາ..." v-model="search" @keyup.enter="getStore()">
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="warnjai-regular">ຮູບພາບ</th>
                                <th class="warnjai-regular">ຊື່ສິນຄ້າ</th>
                                <th class="warnjai-regular">ຈຳນວນ</th>
                                <th class="warnjai-regular">ລາຄາຊື່</th>
                                <th class="warnjai-regular text-center" width="80">ຈັດການ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="list in StoreData.data" :key="list.id">
                                <td style="width: 60px;"> {{ list.id }} </td>
                                <td style="width: 120px;">
                                    <img :src="'asset/img/' + list.image" v-if="list.image" class="img-cover" alt="">
                                    <img :src="'assets/img/no-image.png'" v-if="!list.image" class="img-cover" alt="">
                                </td>
                                <td> {{ list.name }} </td>
                                <td> {{ formatPrice(list.amount) }} </td>
                                <td> {{ formatPrice(list.price_buy) }} </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu warnjai-regular">
                                            <a class="dropdown-item" href="javascript:void(0);"
                                                @click="edit_store(list.id)"><i class="bx bx-edit-alt me-1"></i> ແກ້ໄຂ</a>
                                            <a class="dropdown-item" href="javascript:void(0);"
                                                @click="del_store(list.id)"><i class="bx bx-trash me-1"></i> ລົບ</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <pagination :pagination="StoreData" :offset="4" @paginate="getStore($event)" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Pagination from '../components/Pagination.vue';
export default {
    components: { Pagination },
    name: 'DGBWebsiteStore',

    data() {
        return {
            imagePreview: window.location.origin + '/assets/img/no-image.png',
            image_Product: '',
            search: '',
            editID: '',
            FormType: false,
            FormShow: false,
            FormStore: {
                name: '',
                amount: '',
                price_buy: '',
                price_sell: '',
            },
            StoreData: [],
            options: {
                prefix: '₭ ',
                numeral: true,
                numeralPositiveOnly: true,
                noImmediatePrefix: true,
                rawValueTrimPrefix: true,
                numeralIntegerScale: 10,
                numeralDecimalScale: 2,
                numeralDecimalMark: '.',
                delimiter: ','
            }
        };
    },

    mounted() {

    },
    computed: {
        check_input() {
            if (this.FormStore.name == '' || this.FormStore.amount == '' || this.FormStore.price_buy == '' || this.FormStore.price_sell == '') {
                return true;
            } else {
                return false;
            }
        }
    },
    methods: {
        remove_img() {
          this.image_Product = ''
          this.imagePreview = window.location.origin + '/assets/img/no-image.png'
        },
        onSelected(event) {
            this.image_Product = event.target.files[0]
            let reader = new FileReader();
            reader.readAsDataURL(this.image_Product);
            reader.addEventListener("load", function () {
                this.imagePreview = reader.result;
            }.bind(this), false)
        },
        formatPrice(value) {
            let val = (value / 1).toFixed(0).replace(",", ".");
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        },
        add() {
            this.FormShow = true
            this.FormType = false
        },
        cancel() {
            this.FormShow = false
        },
        save_store() {
            if (this.FormType) {
                //Update
                let forDataStore = new FormData();
                forDataStore.append("name", this.FormStore.name);
                forDataStore.append("amount", this.FormStore.amount);
                forDataStore.append("price_buy", this.FormStore.price_buy);
                forDataStore.append("price_sell", this.FormStore.price_sell);
                forDataStore.append("file", this.image_Product);
                this.$axios.get("/sanctum/csrf-cookie").then((response) => {
                    this.$axios.post(`api/store/update/${this.editID}`, forDataStore).then((response) => {
                        console.log(response.data);
                        if (response.data.success) {
                            this.FormStore.name = '';
                            this.FormStore.amount = '';
                            this.FormStore.price_buy = '';
                            this.FormStore.price_sell = '';
                            this.image_Product = '';

                            this.FormShow = false

                            this.getStore();

                            this.$swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: 'ອັບເດດຂໍ້ມູນສຳເລັດ!',
                                showConfirmButton: false,
                                timer: 5000,
                            })
                        } else {
                            this.$swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                title: 'ອັບເດດບໍ່ຂໍ້ມູນສຳເລັດ!',
                                showConfirmButton: false,
                                timer: 5000,
                            })
                        }
                    }).catch((error) => {
                        console.log(error);
                        if (error.response.status == 401) {
                            this.$storage.setStorageSync("vue-isLoggin", false)
                            window.location.reload()
                        }
                    });
                })
            } else {
                //Add
                let forDataStore = new FormData();
                forDataStore.append("name", this.FormStore.name);
                forDataStore.append("amount", this.FormStore.amount);
                forDataStore.append("price_buy", this.FormStore.price_buy);
                forDataStore.append("price_sell", this.FormStore.price_sell);
                forDataStore.append("file", this.image_Product);
                this.$axios.get("/sanctum/csrf-cookie").then((response) => {
                    this.$axios.post("api/store/add", forDataStore).then((response) => {
                        console.log(response.data);
                        if (response.data.success) {
                            this.FormStore.name = '';
                            this.FormStore.amount = '';
                            this.FormStore.price_buy = '';
                            this.FormStore.price_sell = '';
                            this.image_Product = '';
                            this.imagePreview = window.location.origin + '/assets/img/no-image.png';

                            this.FormShow = false

                            this.getStore();

                            this.$swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: 'ບັນທຶກຂໍ້ມູນສຳເລັດ!',
                                showConfirmButton: false,
                                timer: 5000,
                            })
                        } else {
                            this.$swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                title: 'ບັນທຶກຂໍ້ມູນບໍ່ສຳເລັດ!',
                                showConfirmButton: false,
                                timer: 5000,
                            })
                        }
                    }).catch((error) => {
                        console.log(error);
                        if (error.response.status == 401) {
                            this.$storage.setStorageSync("vue-isLoggin", false)
                            window.location.reload()
                        }
                    });
                })
            }
        },
        edit_store(id) {
            console.log(id);
            this.FormType = true;
            this.editID = id;
            this.$axios.get("/sanctum/csrf-cookie").then((response) => {
                this.$axios.get(`api/store/edit/${id}`).then((response) => {
                    console.log(response.data);

                    this.FormShow = true

                    this.FormStore.name = response.data.name;
                    this.FormStore.amount = response.data.amount;
                    this.FormStore.price_buy = response.data.price_buy;
                    this.FormStore.price_sell = response.data.price_sell;
                    this.image_Product = response.data.image;
                    if (response.data.image) {
                        this.imagePreview = window.location.origin + '/asset/img/' + response.data.image
                    } else {
                        this.imagePreview = window.location.origin + '/assets/img/no-image.png'
                    }
                }).catch((error) => {
                    console.log(error);
                    if (error.response.status == 401) {
                        this.$storage.setStorageSync("vue-isLoggin", false)
                        window.location.reload()
                    }
                });
            })
        },
        del_store(id) {
            this.$swal.fire({
                title: 'ທ່ານແນ່ໃຈບໍ່',
                text: 'ທີ່ຈະລົບຂໍ້ມູນນີ້!',
                icon: 'warning',
                showCancelButton: true,
                confirmButonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ຕ້ອງການລົບ!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$axios.get("/sanctum/csrf-cookie").then((response) => {
                        this.$axios.delete(`api/store/delete/${id}`).then((response) => {
                            if (response.data.success) {
                                this.getStore();

                                // this.$swal.fire(
                                //     'ການລົບຂໍ້ມູນ!',
                                //     'ຂໍ້ມູນຖືກລົບແລ້ວ.',
                                //     response.data.message,
                                //     'success'
                                // );
                                this.$swal.fire({
                                    toast: true,
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'ລົບຂໍ້ມູນສຳເລັດ!',
                                    showConfirmButton: false,
                                    timer: 5000,
                                });
                            }
                        }).catch((error) => {
                            console.log(error);
                            if (error.response.status == 401) {
                                this.$storage.setStorageSync("vue-isLoggin", false)
                                window.location.reload()
                            }
                        });
                    })
                }
            });
        },
        getStore(page) {
            this.$axios.get("/sanctum/csrf-cookie").then((response) => {
                this.$axios.get(`api/store?page=${page}&s=${this.search}`).then((response) => {
                    this.StoreData = response.data;
                }).catch((error) => {
                    console.log(error);
                    if (error.response.status == 401) {
                        this.$storage.setStorageSync("vue-isLoggin", false)
                        window.location.reload()
                    }
                });
            })
        },
    },
    created() {
        this.getStore();
    },
};
</script>

<style scoped>
.img-cover {
    width: 80px;
    height: 80px;
    object-fit: cover;
    object-position: center;
}
</style>