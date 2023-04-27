<template>
    <div class="d-flex justify-content-center">
        <div class="col-md-6 col-sm-6 col-lg-3">
            <div class="authentication-wrapper authentication-basic container-p-y">
                <div class="authentication-inner">
                    <!-- Register -->
                    <div class="card">
                        <div class="card-body warnjai-regular">
                            <!-- Logo -->
                            <div class="app-brand justify-content-center">
                                <a href="#"
                                    class="app-brand-link gap-2 mb-3 mt-3">
                                    <span class="app-brand-text demo text-body fw-bolder">ສະບາຍດີ</span>
                                </a>
                            </div>
                            <!-- /Logo -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">ອີເມວ</label>
                                    <input v-model="email" type="text" class="form-control" id="email" name="email-username"
                                        placeholder="ປ້ອນອີເມວ..." autofocus="">
                                </div>
                                <div class="mb-3 form-password-toggle">
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label" for="password">ລະຫັດຜ່ານ</label>
                                    </div>
                                    <div class="input-group input-group-merge">
                                        <input v-model="password"  :type="vpass" id="password" class="form-control" name="password"
                                            placeholder="············" aria-describedby="password">
                                        <span class="input-group-text cursor-pointer" @click="shpass()"><i class="bx bx-hide" v-if="vpass=='password'"></i> <i class="bx bx-show" v-if="vpass=='text'"></i></span>
                                    </div>
                                </div>
                                <div class="alert alert-danger" role="alert" v-if="show_error">
                                {{ error_mgs }}
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary d-grid w-100" @click="login()" :disabled="check_bt_login">ເຂົ້າສູ່ລະບົບ</button>
                                </div>

                            <p class="text-center">
                                <span>ຍັງບໍ່ມີບັນຊີ?</span>
                                <router-link to="/register">
                                    <span> ລົງທະບຽນ</span>
                                </router-link>
                            </p>
                        </div>
                    </div>
                </div>
                <!-- /Register -->
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'DGBWebsiteLogin',

    data() {
        return {
            show_error: false,
            error_mgs: '',
            vpass:'password',
            email:'',
            password:''
        };
    },

    computed: {
        check_bt_login() {
            if(this.email == '' || this.password == '') {
                return true
            }else{
                return false
            }
        }
    },

    mounted() {

    },

    methods: {
        shpass() {
            if (this.vpass == 'password') {
                this.vpass = 'text'
            }else{
                this.vpass = 'password'
            }
        },
        login() {
            this.$axios.post("api/login", {
                    email: this.email,
                    password: this.password
                }).then((response) => {
                    // console.log(response.data)
                    if (response.data.success) {
                        this.show_error = false
                        this.error_mgs = ''
                        // this.$swal.fire({
                        //     toast: true,
                        //     position: 'top-end',
                        //     icon: 'success',
                        //     title: response.data.message,
                        //     showConfirmButton: false,
                        //     timer: 5000
                        // });
                        // ໄປທີ່ໜ້າ Login
                        this.$storage.setStorageSync("vue-isLoggin", true)
                        // this.$router.push('store');
                        window.location.reload()
                    } else {
                        this.show_error = true
                        this.error_mgs = response.data.message
                        // this.$swal.fire({
                        //     toast: true,
                        //     position: 'top-end',
                        //     icon: 'error',
                        //     title: response.data.message,
                        //     showConfirmButton: false,
                        //     timer: 5000
                        // });
                    }
                }).catch((error) => {
                    console.log(error)
                    if(error.response.status==401) {
                        this.$storage.setStorageSync("vue-isLoggin", false)
                        window.location.reload()
                    }
                });
        }
    },
};
</script>

<style lang="scss" scoped></style>