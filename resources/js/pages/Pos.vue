<template>
    <div class="row warnjai-regular">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <input type="text" class="form-control" placeholder="ຄົ້ນຫາຂໍ້ມູນ...." v-model="search">
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-3 mb-4" v-for="list in StoreData.data" :key="list.id" style="position: relative;">
                    <div class="card h-100" @click="add_product(list.id)">
                        <span v-for="i in listOrder" :key="i.id">
                            <span class="img-product" v-if="list.id == i.id">{{ i.order_amount }}</span>
                        </span>
                        <img class="card-img-top img-cover" :src="'asset/img/' + list.image" v-if="list.image"
                            alt="Card image cap">
                        <img class="card-img-top img-cover" :src="'assets/img/no-image.png'" v-if="!list.image"
                            alt="Card image cap">
                        <div class="card-body p-1 text-center">
                            <strong>{{ list.name }}</strong>
                            <p>{{ formatPrice(list.price_sell) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="height: 80vh; overflow: auto;">
                <div class="card-body">
                    <div class="mb-2">
                        <input v-model="customer_name" type="text" name="" class="form-control" id="customer_name" placeholder="ຊື່ລກຄ້າ">
                    </div>
                    <div class="mb-2">
                        <input v-model="customer_tel" type="text" name="" class="form-control" id="customer_tel" placeholder="ເບີໂທລູກຄ້າ">
                    </div>
                    <div class="d-flex justify-content-between fs-5 text-primary">
                        <span>ລວມຍອດເງິນ</span>
                        <span>{{ formatPrice(TotalAmount) }} ກີບ</span>
                    </div>
                    <div>
                        <button type="button" class="btn btn-info w-100 mt-2" @click="confirm_to_pay()"
                            :disabled="!TotalAmount > 0">ຊຳລະເງິນ</button>
                    </div>
                    <div class="table-responsive text-nowrap mt-2">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ລາຍການ</th>
                                    <th>ລາຄາ</th>
                                    <th>ລວມຍອດ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="list in listOrder" :key="list.id">
                                    <td>{{ list.name }} </td>
                                    <td> {{ formatPrice(list.price_sell) }} <br>
                                        <i class="bx bxs-minus-circle text-danger cursor"
                                            @click="remove_product(list.id)"></i>
                                        {{ formatPrice(list.order_amount) }}
                                        <i class="bx bxs-plus-circle text-info cursor" @click="add_product(list.id)"></i>
                                    </td>
                                    <td>{{ formatPrice(list.price_sell * list.order_amount) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade warnjai-regular" id="confirm_pay_modal" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">ຊຳລະເງິນ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row text-info mt-2">
                        <div class="col-md-6 text-start">
                            ລວມຍອດເງີນ:
                        </div>
                        <div class="col-md-6 text-end">
                            {{ formatPrice(TotalAmount) }} ກີບ
                        </div>
                    </div>
                    <div class="row text-info mt-2">
                        <div class="col-md-6 text-start">
                            ຮັບເງີນຈາກລູກຄ້າ:
                        </div>
                        <div class="col-md-6 text-end">
                            {{ formatPrice(cashAmount) }} ກີບ
                        </div>
                    </div>
                    <div class="row text-danger mt-2" v-if="cashAmount - TotalAmount > 0">
                        <div class="col-md-6 text-start">
                            ເງີນທອນ:
                        </div>
                        <div class="col-md-6 text-end">
                            {{ formatPrice(cashAmount - TotalAmount) }} ກີບ
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        <input type="text" class="form-control" v-model="cashAmount"
                            style="width: 150px; text-align: right;" >
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        <div class="row" style="width: 250px;">
                            <div class="col-4 mt-2">
                                <button type="button" style="width: 60px;" class="btn btn-primary"
                                    @click="AddNum(1)">1</button>
                            </div>
                            <div class="col-4 mt-2">
                                <button type="button" style="width: 60px;" class="btn btn-primary"
                                    @click="AddNum(2)">2</button>
                            </div>
                            <div class="col-4 mt-2">
                                <button type="button" style="width: 60px;" class="btn btn-primary"
                                    @click="AddNum(3)">3</button>
                            </div>
                            <div class="col-4 mt-2">
                                <button type="button" style="width: 60px;" class="btn btn-primary"
                                    @click="AddNum(4)">4</button>
                            </div>
                            <div class="col-4 mt-2">
                                <button type="button" style="width: 60px;" class="btn btn-primary"
                                    @click="AddNum(5)">5</button>
                            </div>
                            <div class="col-4 mt-2">
                                <button type="button" style="width: 60px;" class="btn btn-primary"
                                    @click="AddNum(6)">6</button>
                            </div>
                            <div class="col-4 mt-2">
                                <button type="button" style="width: 60px;" class="btn btn-primary"
                                    @click="AddNum(7)">7</button>
                            </div>
                            <div class="col-4 mt-2">
                                <button type="button" style="width: 60px;" class="btn btn-primary"
                                    @click="AddNum(8)">8</button>
                            </div>
                            <div class="col-4 mt-2">
                                <button type="button" style="width: 60px;" class="btn btn-primary"
                                    @click="AddNum(9)">9</button>
                            </div>
                            <div class="col-4 mt-2">
                                <button type="button" style="width: 60px;" class="btn btn-primary"
                                    @click="AddNum('00')">00</button>

                            </div>
                            <div class="col-4 mt-2">
                                <button type="button" style="width: 60px;" class="btn btn-primary"
                                    @click="AddNum(0)">0</button>
                            </div>
                            <div class="col-4 mt-2">
                                <button type="button" style="width: 60px;" class="btn btn-danger" @click="AddNum('-')"><i
                                        class='bx bx-arrow-back'></i></button>
                            </div>
                            <div class="col-12 text-center pt-4">
                                <button class="btn btn-success" :disabled="!(cashAmount >= TotalAmount)"
                                    @click="Pay()">ຢືນຢັນການຊຳລະເງີນ</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">ປີດ</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'DGBWebsiteHome',

    data() {
        return {
            cashAmount: '',
            search: '',
            customer_name: '',
            customer_tel: '',
            StoreData: [],
            listOrder: [],
            // options: {
            //     prefix: '₭ ',
            //     numeral: true,
            //     numeralPositiveOnly: true,
            //     noImmediatePrefix: true,
            //     rawValueTrimPrefix: true,
            //     numeralIntegerScale: 10,
            //     numeralDecimalScale: 2,
            //     numeralDecimalMark: '.',
            //     delimiter: ','
            // }
        };
    },

    computed: {
        TotalAmount() {
            return this.listOrder.reduce((num, item) => num + item.price_sell * item.order_amount, 0)
        }
    },

    mounted() {

    },

    methods: {
        Pay() {
            if (this.cashAmount >= this.TotalAmount) {
                this.$axios.get("/sanctum/csrf-cookie").then((response) => {
                    this.$axios.post("api/transection/add", {
                        acc_type: 'income',
                        listOrder: this.listOrder,
                        customer_name: this.customer_name,
                        customer_tel: this.customer_tel
                    }).then((response) => {
                        console.log(response.data);
                        if (response.data.success) {

                            $('#confirm_pay_modal').modal('hide')
                            this.listOrder = []

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
                    });
                })
            }
        },
        AddNum(num) {
            if (num == '-') {
                this.cashAmount = this.cashAmount.slice(0, -1)
            } else {
                this.cashAmount = this.cashAmount + - num
            }
        },
        confirm_to_pay() {
            $('#confirm_pay_modal').modal('show')
        },
        formatPrice(value) {
            let val = (value / 1).toFixed(0).replace(",", ".");
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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
        add_product(id) {
            // console.log(id)
            let item = this.StoreData.data.find((i) => i.id == id)

            //ກວດສອບຈຳນວນສິນຄ້າ 
            if (item.amount > 0) {
                let list_order = this.listOrder.find((i) => i.id == id)
                if (list_order) {
                    let old_order = list_order.order_amount
                    if (item.amount - old_order > 0) {
                        //ອັບເດດ
                        list_order.order_amount++
                    } else {
                        this.$swal('ສິນຄ້ານີ້', 'ໝົດແລ້ວ', 'error')
                    }
                } else {
                    //ເພີ່ມໃຫມ່
                    this.listOrder.push({
                        id: item.id,
                        name: item.name,
                        price_sell: item.price_sell,
                        order_amount: 1
                    })
                }
            } else {
                this.$swal('ສິນຄ້ານີ້', 'ໝົດແລ້ວ', 'error')
            }

        },
        remove_product(id) {
            let list_order = this.listOrder.find((i) => i.id == id)
            if (list_order) {
                list_order.order_amount--
                if (list_order.order_amount < 1) {
                    this.listOrder.splice(this.listOrder.map((i) => i.id).indexOf(id), 1)
                }
            }
        }
    },
    created() {
        this.getStore();
    }
};
</script>

<style scoped>
.img-cover {
    widows: 100%;
    height: 220px;
    object-fit: cover;
    object-position: center;
    cursor: pointer;
}

.img-product {
    position: absolute;
    color: white;
    right: 0px;
    background-color: blue;
    padding: 5px;
    border-radius: 0 10px 0 10px;
}

.cursor {
    cursor: pointer;
}</style>